<?php

namespace app\admin\model\series;

use think\Model;
use think\Db;

class SeriesBrandList extends Model
{
	// 表名
    protected $name = 'series_brand_list';

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    // protected $createTime = true;
    // protected $updateTime = true;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];

    public function getFind($Ids)
    {
        return  Db::table('be_series_brand')
                ->alias('a')
                ->join('be_series_brand_list l','a.l_id = l.id','left')
                ->where(['a.id'=>$Ids])
                ->find();
    }

    public function InsertList($params)
    {	

    	$this->allowField(true)->data($params)->save();
    	return $this->id;
    }

    public function PutList($params,$Lds)
    {   
        return $this->allowField(true)->save($params, ['id' => $Lds]);
    }
}