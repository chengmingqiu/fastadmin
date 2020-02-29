<?php 
namespace app\api\controller;

use think\Config;
use app\common\controller\Api;
use app\api\model\Rota;
use app\api\model\Product as Pro_m;
use app\api\model\Series  as Ser_m;
use app\api\model\SeriesBrand as Ser_b;
use think\Request;
/**
 * Class SeriesBrand
 * @title 故事类
 * @package app\api\controller\SeriesBrand
 */

class SeriesBrand  extends  Api
{
	/**
     * @title 故事列表
     * @desc  {"0":"/getserbLi","1":"请求方式：GET"}
     * @param {"name":"id","type":"int","required":false,"desc":"系列ID（）"}
     * @param {"name":"current","type":"int","required":false,"desc":"分页(默认第一页)"}
     * @param {"name":"pagesize","type":"int","required":false,"desc":"展示条数（默认10条）"}
     * @return {"name":"code","type":"int","required":true,"desc":"返回状态（1:成功返回，500:系统内部错误）","level": 1}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"count","type":"int","required":true,"desc":"数量","level": 2}
     * @return {"name":"list","type":"array","required":true,"desc":"数据数组","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"故事ID","level": 3}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"封面","level": 3}
     * @return {"name":"time","type":"string","required":true,"desc":"时间","level": 3}
     * @return {"name":"pagination","type":"array","required":true,"desc":"分页数据","level": 2}
     * @return {"name":"count","type":"int","required":true,"desc":"分页总数","level": 3}
     * @return {"name":"current","type":"int","required":true,"desc":"当前页","level": 3}
     * @return {"name":"pageSize","type":"int","required":true,"desc":"展示条数","level": 3}
     */
	public function SeriesBrandList()
	{
		$request = (Request::instance())->param();
    if(empty($request['id'])){
         $this->error(__('失败'),'系列ID不能为空');
    }
		$SeriesBrandList  = (new Ser_b())->SeriesBrandList($request);
		$this->success(__('成功'),$SeriesBrandList);
	}

     /**
     * @title 故事详情
     * @desc  {"0":"/getserbFi","1":"请求方式：GET"}
     * @param {"name":"id","type":"int","required":true,"desc":"故事ID"}
     * @return {"name":"code","type":"int","required":true,"desc":"返回状态（1:成功返回，500:系统内部错误）","level": 1}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"series_id","type":"int","required":true,"desc":"系列ID","level": 2}
     * @return {"name":"image","type":"string","required":true,"desc":"故事封面图","level": 2}
     * @return {"name":"origin","type":"array","required":true,"desc":"品牌起源","level": 2}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 3}
     * @return {"name":"brief","type":"string","required":true,"desc":"简介","level": 3}
     * @return {"name":"desc","type":"array","required":true,"desc":"详情","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"图片","level": 4}
      * @return {"name":"cont","type":"string","required":true,"desc":"文本","level": 4}
      * @return {"name":"idea","type":"array","required":true,"desc":"品牌理念","level": 2}
      * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 3}
     * @return {"name":"brief","type":"string","required":true,"desc":"简介","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"图片","level": 3}
     * @return {"name":"con","type":"string","required":true,"desc":"文本","level": 3}
     * @return {"name":"story","type":"array","required":true,"desc":"品牌故事","level": 2}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 3}
     * @return {"name":"brief","type":"string","required":true,"desc":"简介","level": 3}
      * @return {"name":"image","type":"array","required":true,"desc":"图片","level": 3}
      * @return {"name":"con1","type":"string","required":true,"desc":"文本","level": 3}
      * @return {"name":"con2","type":"string","required":true,"desc":"文本2","level": 3}
       * @return {"name":"vide","type":"string","required":true,"desc":"视频","level": 3}
       * @return {"name":"con3","type":"string","required":true,"desc":"视频文本","level": 3}
       * @return {"name":"advant","type":"array","required":true,"desc":"品牌优势","level": 2}
       * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 3}
       * @return {"name":"brief","type":"string","required":true,"desc":"简介","level": 3}
       * @return {"name":"desc","type":"array","required":true,"desc":"数组图名称","level": 3}
       * @return {"name":"image","type":"string","required":true,"desc":"图片","level": 4}
       * @return {"name":"name","type":"string","required":true,"desc":"名称","level": 4}
       * @return {"name":"con","type":"string","required":true,"desc":"文本","level": 3}
       * @return {"name":"reco","type":"array","required":true,"desc":"推荐商品","level": 2}
       * @return {"name":"id","type":"int","required":true,"desc":"商品ID","level": 3}
       * @return {"name":"image","type":"string","required":true,"desc":"商品图片D","level": 3}
       * @return {"name":"title","type":"string","required":true,"desc":"商品标题","level": 3}
     */
     public function SeriesBrandFind()
     {
          $request = (Request::instance())->param();
          if(empty($request['id'])){
             $this->error(__('失败'),'故事ID不能为空');
        }
          $SeriesBrandFind  = (new Ser_b())->SeriesBrandFind($request);
          $this->success(__('成功'),$SeriesBrandFind);
     }
}