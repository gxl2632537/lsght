<?php


namespace app\api\controller;

use app\api\service\Token;
use think\Controller;

class BaseController extends Controller
{
    //用户访问的权限
     protected function  checkExclusiveScope(){
        Token::needExclusiveScope();
     }
     //检测token 是否合法，这里是管理员权限
    protected function checkPrimaryScope(){
        Token::needPrimaryScope();
    }
    //管理员权限
    protected function checkSuperScope()
    {
        Token::needSuperScope();
    }



}