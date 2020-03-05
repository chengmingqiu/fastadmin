<?php 
namespace app\api\controller;

use think\Config;
use app\common\controller\Api;
use app\api\model\Rele as Re_M;
use app\api\model\Contact;
use app\api\model\Acti;
use think\Request;

/**
 * Class Rele
 * @title APP官网---》关于我们
 * @package app\api\controller\AppRele
 */

class AppRele  extends  Api
{
	/**
     * @title 关于我们
     * @desc  {"0":"/getSeleA","1":"请求方式：GET"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 2}
     * @return {"name":"time","type":"string","required":true,"desc":"时间","level": 2}
     * @return {"name":"cotent","type":"array","required":true,"desc":"内容","level": 2}
     * @return {"name":"type","type":"char","required":true,"desc":"类型","level": 3}
     * @return {"name":"content","type":"text","required":true,"desc":"内容","level": 3}
     */
	public function getSeleA()
	{
		$request = (Request::instance())->param();
		$SeleList = (new Re_M)->getSeleA();
		$this->success(__('成功'),$SeleList);
	}

     /**
     * @title 联系我们
     * @desc  {"0":"/getContA","1":"请求方式：GET"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 2}
     * @return {"name":"time","type":"string","required":true,"desc":"时间","level": 2}
     * @return {"name":"cotent","type":"array","required":true,"desc":"内容","level": 2}
     * @return {"name":"key","type":"char","required":true,"desc":"键名","level": 3}
     * @return {"name":"val","type":"text","required":true,"desc":"值","level": 3}
     */ 
     public function getContA()
     {
          $request = (Request::instance())->param();
          $getContA = (new Contact)->getContA();
          $this->success(__('成功'),$getContA);
     }

     /**
     * @title 联系我们
     * @desc  {"0":"/getActiA","1":"请求方式：GET"}
     * @return {"name":"msg","type":"string","required":true,"desc":"成功","level": 1}
     * @return {"name":"time","type":"int","required":true,"desc":"返回时间戳","level": 1}
     * @return {"name":"data","type":"array","required":true,"desc":"数据data","level": 1}
     * @return {"name":"title","type":"string","required":true,"desc":"标题","level": 2}
     * @return {"name":"time","type":"string","required":true,"desc":"时间","level": 2}
     * @return {"name":"desc","type":"array","required":true,"desc":"内容","level": 2}
     */ 
     public function getActiA()
     {
          $request = (Request::instance())->param();
          $getActiA = (new Acti)->getActiA();
          $this->success(__('成功'),$getActiA);
     }
}