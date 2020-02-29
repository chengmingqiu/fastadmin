<?php

namespace app\api\model;

use think\Model;
use think\Config;
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

    protected function getimageAttr( $value ) {
        return Config('ip')  . $value;
    }

    public function getRotaHopa()
    {
        $data =  $this->field(['series_id','image'])->select();
        return $data;
    }

    public function GetBra()
    {
        $data =  $this->field(['serbrand_id as id','image'])->select();
        return $data;
    }
    
}
