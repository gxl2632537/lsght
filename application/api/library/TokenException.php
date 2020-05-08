<?php


namespace app\api\library;

/**
 * Class TokenException
 * token 验证失败时抛出的异常
 * @package app\api\library
 */
class TokenException extends BaseException
{
    public $code = 401 ;
    public $msg = 'Token 已过期或无效Token';
    public $errorCode = 10001;
}