<?php
namespace app\api\validate;



use app\api\library\ParameterException;
use think\Request;
use think\Validate;

/**
 * Class BaseValidate
 * 验证类基类
 * @package app\api\validate
 */
class BaseValidate extends Validate
{
    //进行验证
    public function goCheck(){
        //必须设置content-tpye:application/json
        $request = Request::instance();
        //获取请求的参数
        $params =$request->param();
        $params['token'] =$request->header('token');
        //数据自动验证
        if(!$this->check($params)){
           $exception =  new ParameterException(
               [
                   // $this->error有一个问题，并不是一定返回数组，需要判断 如果是数组则转成字符串
                   'msg'=>is_array($this->error) ? implode(';',$this->error) : $this->error,
               ]
           );
           throw $exception;
        }
        return true;
    }

    /**
     * 验证是不是正整数
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     */
    protected function isPositiveInteger($value,$rule = '',$data = '' ,$field='')
    {
        if(is_numeric($value)&& is_int($value + 0) && ($value + 0) > 0 ){
            return true;
        }
        return $field . '必须是正整数';
    }

    /**
     * 验证是不是空
     */
    protected function isNotEmpty($value,$rule='',$data='',$field){
        if(empty($value)){
            return $field .'不允许为空';
        }else{
            return true;
        }
    }
}