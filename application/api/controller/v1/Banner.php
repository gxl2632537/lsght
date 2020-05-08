<?php


namespace app\api\controller\v1;


use app\common\controller\Api;

/**
 * Class Banner接口
 * @package app\api\controller
 */
class Banner extends Api
{
    //无需登录 无需鉴权
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 获取Banner信息
     * @url /banner/:id
     * @http get
     * @param  int $id banner id
     * return array of banner item ,code 200
     * @throws MissException
     *
     */
    public function getBanner($id){

    }
}

