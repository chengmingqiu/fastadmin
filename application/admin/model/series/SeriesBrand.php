<?php

namespace app\admin\model\series;

use think\Model;
use think\Db;

class SeriesBrand extends Model
{
    // 表名
    protected $name = 'series_brand';
    
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

    public function gettype()
    {
        $series_brand = Db::table('be_series_brand')->field(['id','title'])->select();
         $data[''] = '请选择';
        foreach ($series_brand as $k => $v) {
            $data[$v['id']] =$v['title'];
        }
        return $data;
    }
}
