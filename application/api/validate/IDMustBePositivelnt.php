<?php


namespace app\api\validate;




class IDMustBePositivelnt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];
}