<?php

namespace app\api\model;

use think\Model;
use think\Config;
use think\Db;
class Acti extends Model
{   
	// 表名
    protected $name = 'acti';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    public function getActiA()
    {
    	$ActiData=[];
    	$data = Db::table('be_acti')->field(['title','desc','date_format(update_time,"%Y-%m-%d") as time'])->order('update_time','desc')->find();
    	if(!empty($data)){
    		$ActiData = [
    			'title'  => $data['title'],
    			'time'   => $data['time'],
    			'desc'   => $data['desc'],
    		];
    	}
    	return $ActiData;
    }
}