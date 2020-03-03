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
     * @return {"name":"list","type":"array","required":true,"desc":"分页数据","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"系列id","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"图片","level": 3}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 3}
     * @return {"name":"brief","type":"string","required":true,"desc":"内容简介","level": 3}
     * @return {"name":"time","type":"string","required":true,"desc":"时间","level": 3}
     * @return {"name":"story_id","type":"int","required":true,"desc":"故事ID","level": 3}
     * @return {"name":"pagination","type":"array","required":true,"desc":"分页数据","level": 2}
     * @return {"name":"count","type":"int","required":true,"desc":"分页总数","level": 3}
     * @return {"name":"current","type":"int","required":true,"desc":"当前页","level": 3}
     * @return {"name":"pagesize","type":"int","required":true,"desc":"展示条数","level": 3}
     */
     public function SerDataLi()
     {
          $request = (Request::instance())->param();
          $SeriesList  = (new Ser_m())->SerDataList();
          $this->success(__('成功'),$SeriesList);
     }

     /**
     * @title 系列文章详情
     * @desc  {"0":"/getserFiA","1":"请求方式：GET"}
     * @param {"name":"id","type":"int","required":true,"desc":"系列ID"}
     * @return {"name":"code","type":"int","required":true,"desc":"返回状态（1:成功返回，500:系统内部错误）","level": 1}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"data","level": 1}
     * @return {"name":"list","type":"array","required":true,"desc":"数据","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"系列id","level": 3}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 3}
     * @return {"name":"time","type":"string","required":true,"desc":"时间","level": 3}
     * @return {"name":"content","type":"array","required":true,"desc":"详情数据","level": 3}
     * @return {"name":"type","type":"char","required":true,"desc":"类型（pic）图片，（text）文本","level": 4}
     * @return {"name":"content","type":"char","required":true,"desc":"内容","level": 4}
     * @return {"name":"pReco","type":"array","required":true,"desc":"相关产品","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"产品ID","level": 3}
     * @return {"name":"title","type":"char","required":true,"desc":"产品标题","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"图片","level": 3}
     * @return {"name":"price","type":"number","required":true,"desc":"价格","level": 3}
     */
     public function SerserFiA()
     {
          $request = (Request::instance())->param();
          if(empty($request['id'])){
             $this->error(__('失败'),'系列ID不能为空');
          }
          $SeriesList  = (new Ser_m())->SerFiA($request['id']);
          $this->success(__('成功'),$SeriesList);
     }
}