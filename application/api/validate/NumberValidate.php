<?php


namespace app\api\validate;


class NumberValidate extends BaseValidate
{
    protected $rule =   [
        'longitude'  => 'require|number',
        'latitude'  => 'require|number',
    ];
}