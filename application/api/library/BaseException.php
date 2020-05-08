<?php


namespace app\api\library;


use think\Exception;


/**
 * Class BaseException
 * 自定义异常类的基类
 * @package app\api\library
 */
class BaseException extends Exception
{
    public $code = 400;
    public $msg = 'invalid parameters';
    public $errorCode = 999;
    public $shouldToClick = true;

    /**
     * BaseException constructor
     * 构造函数 实例创建时自动调用 接收一个关联数组.
     * @param array $params 关联数组只应该包含code mag 和errorCode ,且不是空值
     */
    public function __construct($params = [])
    {
        if(!is_array($params)){
            return ;
        }
        //如果参数中有code 参数则把当前实例的code 设置为传过来的code
        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode',$params)){
            $this->errorCode = $params['errorCode'];
        }
    }

}