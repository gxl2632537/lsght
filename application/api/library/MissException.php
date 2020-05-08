<?php


namespace app\api\library;


class MissException extends BaseException
{
    //重写基类中的错误code 和提示在实例中展现

    public $code = 404;
    public $msg = 'global: your required resource are not found';
    public $errorCode = 10004;
}