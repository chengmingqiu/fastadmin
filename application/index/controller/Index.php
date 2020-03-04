<?php

namespace app\index\controller;

use app\common\controller\Frontend;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return $this->view->fetch('isapp');
        }
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        $is_mac = (strpos($agent, 'mac os')) ? true : false;
        $is_iphone = (strpos($agent, 'iphone')) ? true : false;
        $is_android = (strpos($agent, 'android')) ? true : false;
        $is_ipad = (strpos($agent, 'ipad')) ? true : false;
        if($is_pc  == true){
             return $this->view->fetch('ispc');
        }
        
        if($is_mac  == true){
              return $this->view->fetch('ispc');
        }
        
        if($is_iphone  == true){
              return $this->view->fetch('isapp');
        }
        
        if($is_android == true){
              return $this->view->fetch('isapp');
        }
        
        if($is_ipad == true){
              return $this->view->fetch('ispc');
        }
    }

    public function news()
    {
        $newslist = [];
        return jsonp(['newslist' => $newslist, 'new' => count($newslist), 'url' => 'https://www.fastadmin.net?ref=news']);
    }
}
