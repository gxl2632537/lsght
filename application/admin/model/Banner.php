<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Banner extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'banner';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [

    ];

    public function items() {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

//    public static function getBannerByID($id)
//    {
//        $banner = self::with(['items', 'items.img'])->find($id); // with 接收一个数组
//        return $banner;
//    }

    public static function findAll(){
        $response =self::where(['deletetime'=>null])->select();
        if($response){
            return $response;
        }
    }

    /**
     * @param $id int banner所在位置
     * @return Banner
     */
    public static function getBannerById($id)
    {
        //关联items 方法 和banneritem下的img方法
        $banner = self::with(['items','items.img'])
            ->find($id);

//         $banner = BannerModel::relation('items,items.img')
//             ->find($id);
        return $banner;
    }

    







}
