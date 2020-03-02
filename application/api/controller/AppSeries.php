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
 * @title APP官网---》系列类
 * @package app\api\controller\Series
 */

class AppSeries  extends  Api
{
	/**
     * @title 系列分类列表
     * @desc  {"0":"/getserLiA","1":"请求方式：GET"}
     * @return {"name":"code","type":"int","required":true,"desc":"返回状态（1:成功返回，500:系统内部错误）","level": 1}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"id","type":"int","required":true,"desc":"系列ID","level": 2}
     * @return {"name":"name","type":"string","required":true,"desc":"系列标题","level": 2}
     */
	public function SeriesList()
	{
		$request = (Request::instance())->param();
		$SeriesList  = (new Ser_m())->SeriesListA();
		$this->success(__('成功'),$SeriesList);
	}


     /**
     * @title 系列列表
     * @desc  {"0":"/getsDatliA","1":"请求方式：GET"}
     * @return {"name":"code","type":"int","required":true,"desc":"返回状态（1:成功返回，500:系统内部错误）","level": 1}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"image","type":"array","required":true,"desc":"图片","level": 2}
     * @return {"name":"title","type":"array","required":true,"desc":"标题","level": 2}
     * @return {"name":"brief","type":"array","required":true,"desc":"内容简介","level": 2}
     * @return {"name":"time","type":"array","required":true,"desc":"时间","level": 2}
     * @return {"name":"story_id","type":"array","required":true,"desc":"故事ID","level": 2}
     */
     public function SerDataLi()
     {
          $request = (Request::instance())->param();
          $SeriesList  = (new Ser_m())->SerDataList();
          $this->success(__('成功'),$SeriesList);
     }
}