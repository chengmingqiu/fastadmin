<?php

namespace app\admin\model;

use think\Model;

use think\Db;
class Rota extends Model
{   

    // 表名
    protected $name = 'rota';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
    ];

    public function seriesBrand()
    {
        return $this->belongsTo('app\admin\model\series\SeriesBrand', 'serbrand_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function gettype()
    {
        $series =  Db::table('be_series')->field(['id,title'])->select();
        // var_dump($series);die;
        $data[''] = '请选择关联系列';
        foreach ($series as $k => $v) {
            $data[$v['id']] =$v['title'];
        }
        return $data;
    }
}
