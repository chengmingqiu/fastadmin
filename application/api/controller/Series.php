<?php 
namespace app\api\controller;

use think\Config;
use app\common\controller\Api;
use app\api\model\Rota;
use app\api\model\Product as Pro_m;
use app\api\model\Series  as Ser_m;
use app\api\model\SeriesBrand;
use think\Request;
/**
 * Class Series
 * @title 系列类
 * @package app\api\controller\Series
 */

class Series  extends  Api
{
	/**
     * @title 系列列表
     * @desc  {"0":"/getserLi","1":"请求方式：GET"}
     * @return {"name":"code","type":"int","required":true,"desc":"返回状态（1:成功返回，500:系统内部错误）","level": 1}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"list","type":"array","required":true,"desc":"单条系列类型数组","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"系列ID","level": 3}
     * @return {"name":"title","type":"string","required":true,"desc":"系列标题","level": 3}
     * @return {"name":"pid","type":"int","required":true,"desc":"父级id","level": 3}
     * @return {"name":"list2","type":"array","required":true,"desc":"带有子级系列数组（只会出现二级）","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"系列ID","level": 3}
     * @return {"name":"title","type":"string","required":true,"desc":"系列标题","level": 3}
     * @return {"name":"pid","type":"int","required":true,"desc":"父级id","level": 3}
     * @return {"name":"child","type":"array","required":true,"desc":"子级数组","level": 3}
     * @return {"name":"id","type":"int","required":true,"desc":"系列ID","level": 4}
     * @return {"name":"title","type":"string","required":true,"desc":"系列标题","level": 4}
     * @return {"name":"pid","type":"int","required":true,"desc":"父级id","level": 4}
     */
	public function SeriesList()
	{
		$request = (Request::instance())->param();
		$SeriesList  = (new Ser_m())->SeriesList();
		$this->success(__('成功'),$SeriesList);
	}
}