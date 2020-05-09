<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\library\MissException;
use app\api\validate\IDMustBePositivelnt;
use app\admin\model\Banner as BannerModel;

/**
 * Class Banner接口
 * @package app\api\controller
 */
class Banner extends BaseController
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
    public function getBanner($id)
    {

       $validate = new IDMustBePositivelnt();
       $validate->goCheck();
       //id 为1 是首页置顶 这里是查找为首页置顶的即id为1的所有baneritem ，img的关联写在模型方法里面 // api 地址 http://www.lsgxcx.com/api/v1/banner/getBanner/id/1
        $banner = BannerModel::getBannerById($id);
        if (!$banner ) {
            throw new MissException([
                'msg' => '请求banner不存在',
                'errorCode' => 40000
            ]);
        }
        return $banner;
    }
}

