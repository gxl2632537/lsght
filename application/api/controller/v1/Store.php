<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\library\MissException;
use app\api\validate\IDMustBePositivelnt;
use app\admin\model\Store as StoreModel;
use app\api\validate\NumberValidate;

class Store extends BaseController
{
    //无需登录 无需鉴权
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 获取门店列表
     * @return \think\response\Json
     * @throws MissException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getStoreLists(){
        config('crossDomainRequest.header');
        $store = new StoreModel();
        $response = $store->where(['status'=>1,'deletetime'=> null])->field(['deletetime,createtime,updatetime','manage_contacts','manage_tel','head_contacts','head_tel','status'],true)
            ->select();
        if (!$response ) {
            throw new MissException([
                'msg' => '请求门店列表不存在',
                'errorCode' => 40000,
            ]);
        }
        return json($response);
    }

    /**
     * 根据门店列表返回的id值更新首页门店的api
     * @param $id
     * @return \think\response\Json
     * @throws MissException
     * @throws \app\api\library\ParameterException
     */
    public function getStoreById($id,$longitude,$latitude){
        config('crossDomainRequest.header');
        $validate = new IDMustBePositivelnt();
        $validate->goCheck();
        $store = new StoreModel();
        $response = $store->where(['status'=>1, 'deletetime'=>null, 'id' =>$id
        ])
         ->field(['deletetime,createtime,updatetime','manage_contacts','manage_tel','head_contacts','head_tel','status'],true)->find();
        if(!$response){
            throw new MissException([
               'msg'=>'请求门店不存在',
               'errorCode'=>40000
            ]);
        }
        $response['scope']= $this->getdistance($longitude,$latitude,$response['longitude'],$response['dimension']);
        $result = array($response);
        return json($result);
    }

    /**
     * 根据传来的经纬度返回距离最近的门店
     * @param $longitude
     * @param $latitude
     * @return mixed
     * @throws \app\api\library\ParameterException
     */
    public function storeCardGet($longitude,$latitude){
        config('crossDomainRequest.header');
        $validate = new NumberValidate();
        $validate->goCheck();
        $store = new StoreModel();
        $response = $store->where(['status'=>1, 'deletetime'=>null])->field(['deletetime,createtime,updatetime','manage_contacts','manage_tel','head_contacts','head_tel','status'],true)->select();
        if(!$response){
            throw new MissException([
                'msg'=>'请求门店不存在',
                'errorCode'=>40000
            ]);
        }

        $num = count($response);
        for($i=0;$i<$num;$i++){
           $response[$i]['scope']= $this->getdistance($longitude,$latitude,$response[$i]['longitude'],$response[$i]['dimension']);
        }
        //根据对象的某个属性的值大小进行排序
          usort($response, function($a, $b){
            return strcmp($a->scope, $b->scope);});
    //    $response= current($response);
        if(!$response){
            throw new MissException([
                'msg'=>'请求门店不存在',
                'errorCode'=>40000
            ]);
        }
        //转成数组
        $result =array($response[0]);
        return json($result);
//        $this->getdistance($longitude,$latitude) ;
    }

    /**
     * 根据2个经纬度之间算距离
     * @param $lng1 用户经度
     * @param $lat1 用户纬度
     * @param $lng2 门店经度
     * @param $lat2 门店纬度
     * @return float|int 单位千米
     */
    public function getdistance($lng1, $lat1, $lng2, $lat2) {
        // 将角度转为狐度
        $radLat1 = deg2rad($lat1); //deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
//        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000;
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137;
        $format_num = sprintf("%.2f",floatval($s));
        return $format_num;
    }

}