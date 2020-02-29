<?php 
namespace app\api\controller;

use think\Config;
use app\common\controller\Api;
use app\api\model\Rele as Re_M;
use think\Request;

/**
 * Class Rele
 * @title 关于我们
 * @package app\api\controller\Rele
 */

class Rele  extends  Api
{
	/**
     * @title 关于我们
     * @desc  {"0":"/getSele","1":"请求方式：GET"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"image","type":"string","required":true,"desc":"封面","level": 2}
     * @return {"name":"list","type":"array","required":true,"desc":"数据列表","level": 2}
     * @return {"name":"con","type":"string","required":true,"desc":"文本","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"图片","level": 3}
     * @return {"name":"brief_img","type":"array","required":true,"desc":"简介图片","level": 2}
     */
	public function SeleList()
	{
		$request = (Request::instance())->param();
		$SeleList = (new Re_M)->SeleList();
		$this->success(__('成功'),$SeleList);
	}

	
}