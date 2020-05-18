<?php

namespace app\admin\validate;

use think\Validate;

class Member extends Validate
{

    /**
     * 验证规则
     */
    protected $rule = [
        //unique:member  表示在哪一张表中
       'member_tel'  => 'require|max:11|/^1[3-8]{1}[0-9]{9}$/|unique:member',
    ];
    /**
     * 提示消息
     */
    protected $message = [
        'member_tel'  =>'请输入正确的手机号，且不能重复！'
    ];
    /**
     * 验证场景
     */
    protected $scene = [
        'edit'  =>  ['member_tel'=>'require|max:11|/^1[3-8]{1}[0-9]{9}$/'],
    ];

    protected function isMobile($value)
    {
        $rule = '/^0?(13|14|15|17|18)[0-9]{9}$/';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    
}
