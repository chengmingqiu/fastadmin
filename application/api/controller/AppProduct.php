<?php 
namespace app\api\controller;

use think\Config;
use app\common\controller\Api;
use app\api\model\Rota;
use app\api\model\Product as pro_m;
use app\api\model\Series;
use app\api\model\SeriesBrand;
use think\Request;

/**
 * Class Product
 * @title APP官网---》产品类
 * @package app\api\controller\Product
 */

class AppProduct  extends  Api
{
	/**
     * @title 商品列表
     * @desc  {"0":"/getproLiA","1":"请求方式：GET"}
     * @param {"name":"id","type":"int","required":true,"desc":"系列ID"}
     * @param {"name":"current","type":"int","required":false,"desc":"分页(默认第一页)"}
     * @param {"name":"pagesize","type":"int","required":false,"desc":"展示条数（默认10条）"}
     * @param {"name":"sort","type":"int","required":false,"desc":"1(时间正序)，2（时间倒序）（默认为2）"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"count","type":"int","required":true,"desc":"查询数量","level": 2}
     * @return {"name":"list","type":"array","required":true,"desc":"数据列表","level": 2}
     * @return {"name":"id","type":"string","required":true,"desc":"商品id","level": 3}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 3}
     * @return {"name":"price","type":"string","required":true,"desc":"价格","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"封面","level": 3}
     * @return {"name":"pagination","type":"array","required":true,"desc":"分页数据","level": 2}
     * @return {"name":"count","type":"int","required":true,"desc":"分页总数","level": 3}
     * @return {"name":"current","type":"int","required":true,"desc":"当前页","level": 3}
     * @return {"name":"pageSize","type":"int","required":true,"desc":"展示条数","level": 3}
     */
	public function PorductList()
	{
		$request = (Request::instance())->param();
          if(empty($request['id'])){
               $this->error(__('失败'),'系列ID不能为空');
          }
		$PorductList = (new pro_m)->PorductListA($request);
		$this->success(__('成功'),$PorductList);
	}

	/**
     * @title 商品详情
     * @desc  {"0":"/getproFiA","1":"请求方式：GET"}
     * @param {"name":"id","type":"int","required":true,"desc":"商品ID"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"list","type":"array","required":true,"desc":"数据","level": 2}
     * @return {"name":"id","type":"string","required":true,"desc":"商品id","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"标题","level": 3}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 3}
     * @return {"name":"price","type":"string","required":true,"desc":"价格","level": 3}
      * @return {"name":"content","type":"array","required":true,"desc":"详情数据","level": 3}
     * @return {"name":"type","type":"char","required":true,"desc":"类型","level": 4}
     * @return {"name":"content","type":"char","required":true,"desc":"内容","level": 4}
     * @return {"name":"pReco","type":"array","required":true,"desc":"相关产品","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"产品ID","level": 3}
     * @return {"name":"title","type":"char","required":true,"desc":"产品标题","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"图片","level": 3}
     * @return {"name":"price","type":"int","required":true,"desc":"价格","level": 3}
     */
	public function ProductFind()
	{
		$request = (Request::instance())->param();
          if(empty($request['id'])){
               $this->error(__('失败'),'商品ID不能为空');
          }
		$ProductFind = (new pro_m)->ProductFindA($request['id']);
		$this->success(__('成功'),$ProductFind);
	}

     /**
     * @title 搜索名称
     * @desc  {"0":"/getproSeA","1":"请求方式：POST"}
     * @param {"name":"name","type":"string","required":true,"desc":"产品名称"}
     * @param {"name":"current","type":"int","required":false,"desc":"分页(默认第一页)"}
     * @param {"name":"pagesize","type":"int","required":false,"desc":"展示条数（默认10条）"}
     * @param {"name":"sort","type":"int","required":false,"desc":"1(时间正序)，2（时间倒序）（默认为2）"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"list","type":"array","required":true,"desc":"产品数据","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"产品ID","level": 3}
     * @return {"name":"title","type":"string","required":true,"desc":"产品名称","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"封面图片","level": 3}
     * @return {"name":"price","type":"string","required":true,"desc":"价格","level": 3}
     * @return {"name":"pagination","type":"array","required":true,"desc":"分页数据","level": 2}
     * @return {"name":"count","type":"int","required":true,"desc":"分页总数","level": 3}
     * @return {"name":"current","type":"int","required":true,"desc":"当前页","level": 3}
     * @return {"name":"pageSize","type":"int","required":true,"desc":"展示条数","level": 3}
     * @return {"name":"series_id","type":"int","required":true,"desc":"查看更多（系列ID）","level": 2}
     */

     public function ProductSear()
     {
          $request = (Request::instance())->param();
          if(empty($request['name'])){
               $this->error(__('失败'),'产品名称不能为空');
          }
          $ProductSear = (new pro_m)->ProductSearA($request);
          $this->success(__('成功'),$ProductSear);
     }

     /**
     * @title 搜索下推荐商品
     * @desc  {"0":"/getpseHoA","1":"请求方式：GET"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"id","type":"int","required":true,"desc":"产品ID","level": 2}
     * @return {"name":"title","type":"char","required":true,"desc":"产品标题","level": 2}
     * @return {"name":"image","type":"string","required":true,"desc":"图片","level": 2}
     * @return {"name":"price","type":"int","required":true,"desc":"价格","level": 2}
     */
     public function getpseHoA()
     {
          $ProductSearHo = (new pro_m)->ProductSearHoA();
          $this->success(__('成功'),$ProductSearHo);
     }
}