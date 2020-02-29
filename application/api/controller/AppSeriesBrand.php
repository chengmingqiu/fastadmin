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
 * @title APP官网---》故事类
 * @package app\api\controller\SeriesBrand
 */

class AppSeriesBrand  extends  Api
{
	/**
     * @title 故事列表
     * @desc  {"0":"/getserbLiA","1":"请求方式：GET"}
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
     * @return {"name":"brief","type":"string","required":true,"desc":"内容简介","level": 3}
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
    $IsItem  = 2;
		$SeriesBrandList  = (new Ser_b())->SeriesBrandList($request, $IsItem);
		$this->success(__('成功'),$SeriesBrandList);
	}

    
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