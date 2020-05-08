<?php
namespace app\api\service;
/**
 * 令牌
 * Class Token
 */
use think\Request;
use think\Cache;
use app\api\library\TokenException;
use think\Exception;
use app\api\library\enum\ScopeEnum;
use app\api\library\ForbiddenException;
class Token
{
    // 生成令牌
    public static function generateToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config('site.token_salt');
        return md5($randChar . $timestamp . $tokenSalt);
    }

    //用户专有权限
    public static function needExclusiveScope(){
        //获取到token 对应的scope 数值
        $scope = self::getCurrentTokenVar('scope');
        if ($scope){
            //携带令牌的权限和用户的权限进行数值对比，如果数值相同则访问的是用户
            if ($scope == ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }
    //获取到token 对应的scope 数值 用来做用户还是管理员判断
    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()
            ->header('token');
        $vars = Cache::get($token);
        if (!$vars)
        {
            throw new TokenException();
        }
        else {
            if(!is_array($vars))
            {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            }
            else{
                throw new Exception('尝试获取的Token变量并不存在');
            }
        }
    }

    //验证token 是否合法或者是否过期
    //验证器验证只是token 验证的一种方式
    //另外一种是使用行为拦截token ，不让非法的token 进入控制器
    public static function needPrimaryScope(){
        $scope = self::getCurrentTokenVar('scope');
        if($scope){
            if($scope >= ScopeEnum::User){
                return true;
            }else{
                throw new ForbiddenException();
            }
        }else{
            throw new TokenException();
        }
    }
    //管理员权限
    public static function needSuperScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope){
            if ($scope == ScopeEnum::Super) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }
}