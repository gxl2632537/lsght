<?php


namespace app\api\service;

use app\admin\model\Member;
use app\api\library\enum\ScopeEnum;
use app\api\library\TokenException;
use app\api\library\WeChatException;
use think\Db;
use think\Exception;

/**
 * Class UserToken
 * 微信登陆
 * 如果频繁被恶意调用，需要限制ip和访问频率
 * @package app\api\service
 */

class UserToken extends Token
{
    protected $code;
    protected $wxLoginUrl;
    protected $wxAppID;
    protected $wxAppSecret;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID= config('site.app_id');
        $this->wxAppSecret= config('site.app_secret');
        $this->wxLoginUrl = sprintf(config('site.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }

    /**
     * 登陆
     * 思路1：每次调用登陆接口都去微信刷新一次session_key,生成新的Token,不删除旧的token
     * 思路2：检查Token有没有过期，没有过期则直接返回当前Token
     * 思路3：重新去微信刷新session_key并删除当前Token，返回新的Token
     */
    public function get(){
        //通过凭证进而换取用户登录态信息，包括用户的唯一标识（openid）及本次登录的会话密钥（session_key）等
        $result = curl_get($this->wxLoginUrl);
        // 注意json_decode的第一个参数true
        // 这将使字符串被转化为数组而非对象
        //返回结果转化成数组
        $wxResult = json_decode($result,true);
        if(empty($wxResult)){
            // 为什么以empty判断是否错误，这是根据微信返回
            // 规则摸索出来的
            // 这种情况通常是由于传入不合法的code
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }else{
            // 建议用明确的变量来表示是否成功
            // 微信服务器并不会将错误标记为400，无论成功还是失败都标记成200
            // 这样非常不好判断，只能使用errcode是否存在来判断
            $loginFail =array_key_exists('errcode',$wxResult);
            if($loginFail){
                $this->processLoginError($wxResult);
            }else{
                //返回token 也就是令牌，是缓存中的key值 $wxResult里是含有oppenid 和session_key的方便小程序携带令牌过来请求拿到
                return $this->grantToken($wxResult);
            }
        }

    }
    // 处理微信登陆异常
    // 那些异常应该返回客户端，那些异常不应该返回客户端
    // 需要认真思考
    private function processLoginError($wxResult){
        throw new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode']
        ]);
    }

    // 颁发令牌
    // 只要调用登陆就颁发新令牌
    // 但旧的令牌依然可以使用
    // 所以通常令牌的有效时间比较短
    // 目前微信的express_in时间是7200秒
    // 在不设置刷新令牌（refresh_token）的情况下
    // 只能延迟自有token的过期时间超过7200秒（目前还无法确定，在express_in时间到期后
    // 还能否进行微信支付
    // 没有刷新令牌会有一个问题，就是用户的操作有可能会被突然中断

    private function grantToken($wxResult){
        // 此处生成令牌使用的是TP5自带的令牌
        // 如果想要更加安全可以考虑自己生成更复杂的令牌
        // 比如使用JWT并加入盐，如果不加入盐有一定的几率伪造令牌
        $openid = $wxResult['openid'];
        $memberUser = Member::getByOpenId($openid);
        if(!$memberUser){
            // 借助微信的openid作为用户标识
            // 但在系统中的相关查询还是使用自己的uid
            //如果不存在则创建新用户并返回id
            $uid = $this->nuwMemberUser($openid);
        }else{
            $uid = $memberUser->id;
        }

        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    //获取值并组成带有身份权限的数组
    private function prepareCachedValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::User;
        return $cachedValue;
    }

    //创建新用户
    private function nuwMemberUser($openid){
        // 有可能会有异常，如果没有特别处理
        // 这里不需要try——catch
        // 全局异常处理会记录日志
        // 并且这样的异常属于服务器异常
        // 也不应该定义BaseException返回到客户端
        $time = strtotime("next year");
        $member_card_validity = date("Y-m-d H:i:s",$time);
        $memberUser = Member::create([
           'openid'=>$openid,
            'member_card_validity'=>$member_card_validity
        ]);
        $memberUser_log = Db::name('member_card_log')->insert([
            'openid'=>$openid,
            'member_card_validity'=>$member_card_validity
        ]);


        return $memberUser->id;
    }

    //写入缓存
    private function saveToCache($wxResult){
        //调用父类的生成令牌 返回的值是令牌号
        $key = self::generateToken();
        //含有openid 以及权限的数组
        $value= json_encode($wxResult);
        //有效时间
        $expire_in = config('site.expire_in');
        //写入缓存，这里是tp5的缓存，后期可优化成redis
        $result = cache($key,$value,$expire_in);
        if(!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        //通过这个key也就是令牌 可以查到用户的openid 已经权限，方便判断用户对于一些权限接口的访问
        return $key;
    }

}