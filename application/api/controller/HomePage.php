<?php 
namespace app\api\controller;

use think\Config;
use app\common\controller\Api;
use app\api\model\Rota;
use app\api\model\Product;
use app\api\model\Series;
use app\api\model\SeriesBrand;

/**
 * Class HomePage
 * @title 官网---》首页接口
 * @package app\api\controller\HomePage
 */

class HomePage  extends  Api
{
	/**
     * @var int HTTP 状态码
     */
    public $code = 400;

    // 错误信息
    /**
     * @var string 错误信息描述
     */
    public $msg = 'Parameter error !';

    /**
     * @var int 自定义状态码
     */
    public $errorCode = 10000;

    /**
     * @var array 返回值
     */
    public $data = [];
	/**
     * @title 首页轮播图接口
     * @desc  {"0":"/getBra","1":"请求方式：GET"}
     * @return {"name":"code","type":"int","required":true,"desc":"返回状态（1:成功返回，500:系统内部错误）","level": 1}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"id","type":"int","required":true,"desc":"品牌故事ID","level": 2}
     * @return {"name":"image","type":"string","required":true,"desc":"轮播图","level": 2}
     */
	public function GetBra()
	{
	    $GetBra    = (new Rota)->GetBra();
	    $this->success(__('成功'),$GetBra);
	}

    /**
     * @title 首页推荐商品接口
     * @desc  {"0":"/getPro","1":"请求方式：GET"}
     * @return {"name":"code","type":"int","required":true,"desc":"返回状态（1:成功返回，500:系统内部错误）","level": 1}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"list1","type":"array","required":true,"desc":"3array","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"商品ID","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"商品图","level": 3}
     * @return {"name":"list2","type":"array","required":true,"desc":"2array","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"商品ID","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"商品图","level": 3}
     * @return {"name":"list3","type":"array","required":true,"desc":"3array","level": 2}
     * @return {"name":"id","type":"int","required":true,"desc":"商品ID","level": 3}
     * @return {"name":"image","type":"string","required":true,"desc":"商品图","level": 3}
     * @return {"name":"series_id","type":"int","required":true,"desc":"系列ID","level": 2}
     */
    public function GetPro()
    {
        $IsItem  = 1;
        $product = (new Product)->getProrecom($IsItem);
        $this->success(__('成功'),$product);
    }

    /**
     * @title 首页系列接口
     * @desc  {"0":"/getSeri","1":"请求方式：GET"}
     * @return {"name":"code","type":"int","required":true,"desc":"返回状态（1:成功返回，500:系统内部错误）","level": 1}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"id","type":"int","required":true,"desc":"系列ID","level": 2}
     * @return {"name":"story_id","type":"int","required":true,"desc":"故事ID","level": 2}
     * @return {"name":"title","type":"string","required":true,"desc":"系列标题","level": 2}
     * @return {"name":"brief","type":"string","required":true,"desc":"系列简介","level": 2}
     * @return {"name":"image","type":"array","required":true,"desc":"系列图（多）","level": 2}
     */
    public function GetSeri(){
        $series  = (new Series)->getSeries();
        $this->success(__('成功'),$series);
    }
}
