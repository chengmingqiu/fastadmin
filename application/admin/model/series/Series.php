<?php

namespace app\admin\model\series;

use think\Model;
use think\Db;

class Series extends Model
{    
    // 表名
    protected $name = 'series';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = true;
    protected $updateTime = true;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];

    public function getSeries()
    {
        $Series =  Db::table('be_series')->field(['id','type'])->select();
        $data[''] = '请选择系列';
        foreach ($Series as $k => $v) {
            $data[$v['id']] =$v['type'];
        }
        return $data;
    }

    public function gettype($where=[])
    {
        $data = Db::table('be_series')->field(['id as value','type as name'])->where($where)->select();
        if(!empty($data))
        {
            return $data;
        }else{
            return [['value'=>0,'name'=>'无']];
        }
    }

}
