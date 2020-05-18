<?php


namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;
use think\Request;

class Token
{

    /**
     *
     * 用户获取令牌（登陆）
     * @url /token
     * @POST code
     *  $posts = \request()->param();获取传来的参数
     * @note 虽然查询应该使用get，但为了稍微增强安全性，所以使用POST
     */

    public function getToken($code=''){

        if(\request()->isPost()){
//          $response = [
//              'openid'=>1,
//              'userId'=>2,
//              'errcode'=>0
//          ];
//          return json($response);
            (new TokenGet())->goCheck();
            $wx = new UserToken($code);
            $token = $wx->get();
            $response = [
              'errcode'=>0,
              'token'=>$token
            ];
            return json($response);
        }


    }


}