<?php

namespace app\api\model;

use think\Model;
use think\Config;
use think\Db;
class Contact extends Model
{   
	// 表名
    protected $name = 'contact';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    public function getContA()
    {
    	$ConData =[];
    	$data = Db::table('be_contact')->field(['title','desc','date_format(update_time,"%Y-%m-%d") as time'])->order('update_time','desc')->find();
    	if(!empty($data)){
    		$data['desc']  = json_decode($data['desc'],true);
    		$desc = [];
    		foreach ($data['desc'] as $k => $v) {
    			$desc[] = [
    				'key' => $k,
    				'val' => $v,
    			];
    		}
    		$ConData =[
    			'title'  => $data['title'],
    			'time'	 => $data['time'],
    			'content'=>$desc,
    		];
    	}
    	return $ConData;
    }
}