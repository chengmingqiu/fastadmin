<?php

namespace app\admin\model\series;

use think\Model;


class SeriesType extends Model
{

    

    

    // 表名
    protected $name = 'series_type';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];
    

    







    public function series()
    {
        return $this->belongsTo('app\admin\model\Series', 's_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
