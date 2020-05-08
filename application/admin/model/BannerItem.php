<?php


namespace app\admin\model;


use think\Model;
use traits\model\SoftDelete;

class BannerItem extends Model
{
    // 表名
    protected $name = 'banner_item';
    use SoftDelete;
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

//    protected $hidden = ['deletetime', 'updatetime'];
    /**
     * 建立与 Image 表的关联模型（一对一）
     * @return \think\model\relation\BelongsTo
     */
    public function img() {
        return $this->belongsTo('Image', 'img_id', 'id'); //关联模型名，外键名，关联模型的主键
    }

   public function banner(){
       return $this->hasOne('Banner','id','banner_id');
   }


}