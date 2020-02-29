<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class ProductType extends Model
{

    

    

    // 表名
    protected $name = 'product_type';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'create_time_text',
        'update_time_text'
    ];
    

    



    public function getCreateTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['create_time']) ? $data['create_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getUpdateTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['update_time']) ? $data['update_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setCreateTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setUpdateTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    public function gettype($where=[])
    {
        return Db::table('be_product_type')->field(['id as value','name'])->where($where)->select();
    }

    public function typepid($where = []){
       return  Db::table('be_product_type')->field(['pid'])->where(['id'=>$where])->find();
    }

}
