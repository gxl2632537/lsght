<?php

namespace app\api\library;

use Exception;
use think\Config;
use think\exception\Handle;
use think\Log;
use think\Request;

/**
 * 自定义API模块的错误显示
 */
class ExceptionHandle extends Handle
{
    /**
     * 重写Handle 的render 方法，实现自定义异常消息
     * @param Exception $e
     * @return \think\Response
     */
    private $code;
    private $msg;
    private $errorCode;

    public function render(Exception $e)
    {
        if($e instanceof BaseException){
            //如果是自定义异常，则控制http状态码，不需要记录日志
            //因为这些同创是因为客户端传递错误或者是用户请求错误造成的异常,不需要记录日志

            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            //如果是服务器未处理的异常，则将http状态码设置为500，并记录日志
            if(Config::get('app_debug')){
                //调试状态下需要显示tp默认的异常页面，因为tp的默认页面很容易看出来问题
                return parent::render($e);
            }
            //生产环境下显示自定义异常并写入日志
            $this->code = 500;
            $this->msg = 'sorry ,we make a mistake please contact email 15195996961@163.com';
            $this->errorCode = 999;
            $this->recordErrorLog($e);
        }
        //获取请求的信息，并json 封装后返回 request_url 获取当前URL地址 不含域名
        $repuest = Request::instance();

        $repuest = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url'=>$repuest=$repuest->url()
        ];
        return json($repuest,$this->code);

    }

    /**
     * 将异常写入日志
     */
    private  function recordErrorLog(Exception $e){
        Log::init([
            'type'=> 'file',
            'path'=>LOG_PATH,
            'level'=>['error']
        ]);
        //写入日志，并记录信息类型为error
        Log::record($e->getMessage(),'error');
    }

}
