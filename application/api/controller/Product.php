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
 * @title 产品类
 * @package app\api\controller\Product
 */

class Product  extends  Api
{
	/**
     * @title 商品列表
     * @desc  {"0":"/getproLi","1":"请求方式：GET"}
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
     * @return {"name":"brief","type":"string","required":true,"desc":"简介","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"封面","level": 3}
     * @return {"name":"type","type":"array","required":true,"desc":"类型数组","level": 3}
     * @return {"name":"0","type":"array","required":true,"desc":"0","level": 4}
     * @return {"name":"id","type":"int","required":true,"desc":"类型id","level": 5}
     * @return {"name":"type","type":"string","required":true,"desc":"类型名称","level": 5}
     * @return {"name":"1","type":"array","required":false,"desc":"1(非填)","level": 4}
     * @return {"name":"id","type":"int","required":false,"desc":"类型id","level": 5}
     * @return {"name":"type","type":"string","required":false,"desc":"类型名称","level": 5}
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
		$PorductList = (new pro_m)->PorductList($request);
		$this->success(__('成功'),$PorductList);
	}

	/**
     * @title 商品详情
     * @desc  {"0":"/getproFi","1":"请求方式：GET"}
     * @param {"name":"id","type":"int","required":true,"desc":"商品ID"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"id","type":"string","required":true,"desc":"商品id","level": 2}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 2}
     * @return {"name":"brief","type":"string","required":true,"desc":"简介","level": 2}
     * @return {"name":"de_image","type":"array","required":true,"desc":"详情图片系列","level": 2}
     * @return {"name":"list1","type":"array","required":true,"desc":"详情缩略图","level": 3}
     * @return {"name":"list2","type":"array","required":true,"desc":"详情缩略图","level": 3}
     * @return {"name":"specs","type":"array","required":true,"desc":"商品规格详情","level": 2}
     * @return {"name":"a-level","type":"array","required":true,"desc":"规格1","level": 3}
     * @return {"name":"key","type":"int","required":true,"desc":"键（对应规格键）","level": 4}
     * @return {"name":"value","type":"string","required":true,"desc":"名称","level": 4}
     * @return {"name":"b-level","type":"array","required":true,"desc":"规格2","level": 3}
     * @return {"name":"a-level-》key","type":"array","required":true,"desc":"a-level里的key键","level": 4}
     * @return {"name":"b_image","type":"array","required":true,"desc":"轮播图","level": 2}
     * @return {"name":"goods_specs","type":"array","required":true,"desc":"内容规格","level": 2}
     * @return {"name":"key","type":"string","required":true,"desc":"键","level": 3}
     * @return {"name":"val","type":"string","required":true,"desc":"键","level": 3}
     * @return {"name":"c_image","type":"array","required":true,"desc":"内容图片","level": 2}
     * @return {"name":"c_title","type":"string","required":true,"desc":"内容标题","level": 2}
     * @return {"name":"content","type":"string","required":true,"desc":"内容文本","level": 2}
     * @return {"name":"type","type":"array","required":true,"desc":"类型数组","level": 2}
     * @return {"name":"0","type":"array","required":true,"desc":"0","level": 3}
     * @return {"name":"id","type":"int","required":true,"desc":"类型id","level": 4}
     * @return {"name":"type","type":"string","required":true,"desc":"类型名称","level": 4}
     * @return {"name":"1","type":"array","required":false,"desc":"1(非填)","level": 3}
     * @return {"name":"id","type":"int","required":false,"desc":"类型id","level": 4}
     * @return {"name":"type","type":"string","required":false,"desc":"类型名称","level": 4}
     */
	public function ProductFind()
	{
		$request = (Request::instance())->param();
          if(empty($request['id'])){
               $this->error(__('失败'),'商品ID不能为空');
          }
		$ProductFind = (new pro_m)->ProductFind($request['id']);
		$this->success(__('成功'),$ProductFind);
	}

     /**
     * @title 搜索名称
     * @desc  {"0":"/getproSe","1":"请求方式：POST"}
     * @param {"name":"name","type":"string","required":true,"desc":"产品名称"}
     * @param {"name":"current","type":"int","required":false,"desc":"分页(默认第一页)"}
     * @param {"name":"pagesize","type":"int","required":false,"desc":"展示条数（默认10条）"}
     * @param {"name":"sort","type":"int","required":false,"desc":"1(时间正序)，2（时间倒序）（默认为2）"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"pSear","type":"array","required":true,"desc":"搜索结果","level": 2}
     * @return {"name":"count","type":"int","required":true,"desc":"查询数量","level": 3}
     * @return {"name":"list","type":"array","required":true,"desc":"产品数据","level": 3}
     * @return {"name":"id","type":"int","required":true,"desc":"产品ID","level": 4}
     * @return {"name":"name","type":"string","required":true,"desc":"产品名称","level": 4}
     * @return {"name":"image","type":"string","required":true,"desc":"封面图片","level": 4}
     * @return {"name":"brief","type":"string","required":true,"desc":"简介","level": 4}
     * @return {"name":"type","type":"array","required":true,"desc":"类型数组","level": 4}
     * @return {"name":"0","type":"array","required":true,"desc":"0","level": 5}
     * @return {"name":"id","type":"int","required":true,"desc":"类型id","level": 6}
     * @return {"name":"type","type":"string","required":true,"desc":"类型名称","level": 6}
     * @return {"name":"1","type":"array","required":false,"desc":"1(非填)","level": 5}
     * @return {"name":"id","type":"int","required":false,"desc":"类型id","level": 6}
     * @return {"name":"type","type":"string","required":false,"desc":"类型名称","level": 6}
     * @return {"name":"pagination","type":"array","required":true,"desc":"分页数据","level": 3}
     * @return {"name":"count","type":"int","required":true,"desc":"分页总数","level": 4}
     * @return {"name":"current","type":"int","required":true,"desc":"当前页","level": 4}
     * @return {"name":"pageSize","type":"int","required":true,"desc":"展示条数","level": 4}
     * @return {"name":"pReco","type":"array","required":true,"desc":"热门产品","level": 2}
     * @return {"name":"count","type":"int","required":true,"desc":"查询数量","level": 3}
     * @return {"name":"list","type":"array","required":true,"desc":"数据","level": 3}
     * @return {"name":"id","type":"int","required":true,"desc":"产品ID","level": 4}
     * @return {"name":"name","type":"string","required":true,"desc":"产品名称","level": 4}
     * @return {"name":"image","type":"string","required":true,"desc":"封面图片","level": 4}
     * @return {"name":"brief","type":"string","required":true,"desc":"简介","level": 4}
     * @return {"name":"series_id","type":"int","required":true,"desc":"查看更多（系列ID）","level": 2}
     */

     public function ProductSear()
     {
          $request = (Request::instance())->param();
          if(empty($request['name'])){
               $this->error(__('失败'),'产品名称不能为空');
          }
          $ProductSear = (new pro_m)->ProductSear($request);
          $this->success(__('成功'),$ProductSear);
     }
}