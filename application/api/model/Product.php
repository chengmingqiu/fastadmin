<?php

namespace app\api\model;

use think\Model;
use think\Db;
use think\Config;

class Product extends Model
{

    // 表名
    protected $name = 'product';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $deleteTime = false;
    
    protected function getimageAttr( $value ) {
        return Config('ip')  . $value;
    }

    /**
    *首页推荐商品（8）$IsItem : 1(pc)/2(app)
    */
    public function getProrecom($IsItem)
    {
      $list = [];
      $list1 = [];
      $list2 = [];
      $list3 = [];
      //新增判断
      if($IsItem == 1){
          $limit = 8;
      }else if($IsItem == 2){
          $limit = 4;
      }
      $data =    $this->field(['id','image'])->where(['is_recom'=>1])->order('update_time','desc')->limit(0,$limit)->select();
      if(!empty($data) && $IsItem == 1){
        $list['list1'] = array_slice($data, 0,3);
        $list['list2'] = array_slice($data, 3,2);
        $list['list3'] = array_slice($data, 5,3);
      }else if ($IsItem == 2) {
        $list['list']  = $data;
      }
      $series_id =Db::table('be_series')->field(['id'])->order('update_time','desc')->limit(0,1)->find()['id'];
      if(!empty($series_id)){
        $list['series_id'] =  $series_id;
      }
      
      return $list;
    }

    //系列下产品array[]
    public function PorductList($param)
    {
        $current     = isset($param['current'])     ? intval($param['current'])    : 1;
        $pagesize = isset($param['pagesize']) ? intval($param['pagesize']): 10;
        $sort     = isset($param['sort']) && !empty($param['sort'])    ? $param['sort']    : 2;
        if($sort == 1){
          $sort   = 'asc';
        }else if($sort == 2){
          $sort   = 'desc';
        }
        $where    = [];
        $where    = 'a.big_type='.$param['id'].' OR '. 'a.small_type='.$param['id'];
        $PorductCount = Db::table('be_product')
                       ->alias('a')
                       ->join('be_series s','a.series_id = s.id','left')
                       ->where($where)
                       ->count();
        $PorductList = Db::table('be_product')
                       ->alias('a')
                       ->field(['a.id','a.name as title','a.brief','a.image','s.id as s_id','s.type','a.small_type'])
                       ->join('be_series s','a.series_id = s.id','left')
                       ->order('a.update_time',$sort)
                       ->where($where)
                       ->limit(($current  - 1) * $pagesize ,$pagesize)
                       ->select();
        if(!empty($PorductList)){
          foreach ($PorductList as $k => $v) {
            $type = [];
            $PorductList[$k]['image'] =Config('ip').$v['image']; 
            $type[0] = [
                    'id' => $v['s_id'],
                    'type' => $v['type']
            ];
            if(!empty($v['small_type'])   &&   $v['small_type'] != 0){
                $smallType = Db::table('be_series')->field(['id','type'])->where(['id'=>$v['small_type']])->find();
                $type[1] = [
                  'id' => $smallType['id'],
                  'type' => $smallType['type'],
                ];
            }
            $PorductList[$k]['type'] = $type;
            unset($PorductList[$k]['small_type']);
            unset($PorductList[$k]['s_id']);
          }
        }
        return ['count'=>$PorductCount,'list'=>$PorductList,'pagination'=>['count'=>$PorductCount,'current'=>$current,'pageSize'=>$pagesize]];
    }

    //商品详情
    public function ProductFind($Id)
    {
        $ProductFind = Db::table('be_product')
                       ->alias('a')
                       ->field(['a.id','a.name as title','a.brief','a.details_image as d_image','a.specs','a.brief_image as b_image','a.goods_specs','a.con_image as c_image','a.con_title as c_title','a.con as content',
                        'a.small_type','s.id as s_id','s.type as type'])
                       ->join('be_series s','a.big_type = s.id','left')
                       // ->join('be_product_type pt','a.type = pt.id','left')
                       ->where(['a.id'=>$Id])
                       ->find();
        if(!empty($ProductFind['d_image'])){
            $ProductFind['d_image'] = explode(',', $ProductFind['d_image']);
        

            foreach ($ProductFind['d_image'] as $k => $v) {
               $ProductFind['de_image']['list1'][$k] = ['key'=>$k,'image'=>Config('ip') . $v];
               $ProductFind['de_image']['list2'][$k] = ['image'=>Config('ip') . $v];
            }
            unset($ProductFind['d_image']);
        }
        

        if(!empty($ProductFind['specs'])){
            $specs = json_decode($ProductFind['specs'],true);
            $Sp_array = [];
            $SpChild_array = [];
            $i = 1;
            foreach ($specs as $k => $v) {
                $Sp_array[] = [ 'key'=>$i ,'value'=>$k]; 
                $SpChild_array[$i] = explode(',', $v);
                $i++;
            }
            $ProductFind['specs']  = ['a-level'=>$Sp_array,'b-level'=>$SpChild_array];
        }


        if(!empty($ProductFind)){
            $ProductFind['b_image']=explode(',',$ProductFind['b_image']);
            foreach ($ProductFind['b_image'] as $k => $v) {
               $ProductFind['b_image'][$k] = Config('ip') . $v;
            }
        }
        


        if(!empty($ProductFind['goods_specs'])){
            $goods_specs = json_decode($ProductFind['goods_specs'],true);
            $GoodsSpecs = [];
            foreach ($goods_specs as $k => $v) {
                $GoodsSpecs[]  = ['key'=>$k,'val'=>$v];
            }
            $ProductFind['goods_specs'] = $GoodsSpecs;
        }

        if(!empty($ProductFind['c_image'])){
            $ProductFind['c_image'] = explode(',',$ProductFind['c_image']);
            foreach ($ProductFind['c_image'] as $k => $v) {
               $ProductFind['c_image'][$k] = Config('ip') . $v;
            }
        }
      
        $type = [];
        if(!empty($ProductFind['s_id'])){
            $type[0]   = [ 
              'id'  =>$ProductFind['s_id'],
              'type'=>$ProductFind['type'],
            ];
        }
        
                   
        if(!empty($ProductFind['small_type']) && $ProductFind['small_type'] != 0){
            $smallType = Db::table('be_series')->field(['id','type'])->where(['id'=>$ProductFind['small_type']])->find();
            $type[1] = [
                            'id'  =>$smallType['id'],
                            'type'=>$smallType['type'],
            ];
        }
        if(!empty($type)){
          $ProductFind['type'] = $type;
        }
        unset($ProductFind['s_title']);
        unset($ProductFind['s_id']);
        unset($ProductFind['small_type']);
        
        return $ProductFind;
    }

    /*
    *商品搜索数据
    *$param['id'] 系列ID  / ['name'] 搜索内容
    **/
    public function ProductSear($param)
    {
        $data = [];
        $where = [];
        $current     = isset($param['current'])     ? intval($param['current'])    : 1;
        $pagesize    = isset($param['pagesize']) ? intval($param['pagesize']): 10;
        $sort        = isset($param['sort'])  && !empty($param['sort'])   ? $param['sort']    : 2;
        if($sort == 1){
          $sort   = 'asc';
        }else if($sort == 2){
          $sort   = 'desc';
        }
        if(isset($param['name']) && !empty($param['name'])){
           $where['name'] =['like','%'.$param['name'].'%'];
        }
        $ProCount = Db::table('be_product')->where($where)->count();
        $ProSear  = Db::table('be_product')->alias('a')
                    ->field(['a.id','a.name','a.image','a.brief','s.id as s_id','s.type','a.small_type'])
                    ->join('be_series s','a.series_id = s.id','left')
                    ->where($where)
                    ->order('a.update_time',$sort)
                    ->limit(($current  - 1) * $pagesize ,$pagesize)
                    ->select();
        if(!empty($ProSear)){
            foreach ($ProSear as $k => $v) {
                $ProSear[$k]['image'] = Config('ip')  . $v['image'];
                $type = [];
                $type[0] = [
                      'id' => $v['s_id'],
                      'type' => $v['type']
                ];
               if(!empty($v['small_type'])   &&   $v['small_type'] != 0){
                  $smallType = Db::table('be_series')->field(['id','type'])->where(['id'=>$v['small_type']])->find();
                  $type[1] = [
                    'id' => $smallType['id'],
                    'type' => $smallType['type'],
                  ];
               }
              $ProSear[$k]['type'] = $type;
              unset($ProSear[$k]['small_type']);
              unset($ProSear[$k]['s_id']);
            }
        }

        //推荐商品
        $whereReco = [];
        if(isset($param['name']) && !empty($param['name'])){
           $whereReco['name'] =['notlike','%'.$param['name'].'%'];
        }
        $ProReco  = Db::table('be_product')->field(['id','name','image','brief'])->where($whereReco)->order('update_time','desc')->limit(0,3)->select();
        foreach ($ProReco as $k => $v) {
            $ProReco[$k]['image'] = Config('ip')  . $v['image'];
        }

        //查看更多
        $series_id = Db::table('be_series')->field(['id'])->order('update_time','desc')->find()['id'];
        
        $data = [
              'pSear'=>[
                  'count'=>$ProCount,
                  'list' =>$ProSear,
                  'pagination'=>['count'=>$ProCount,'current'=>$current,'pageSize'=>$pagesize]
              ],
              'pReco'=>[
                  'count'=>count($ProReco),
                  'list' =>$ProReco,
              ],
              'series_id' =>$series_id,
        ];
        return $data;
    }


    /*
    * app新增
    */
    public function PorductListA($param)
    {
        $current     = isset($param['current'])     ? intval($param['current'])    : 1;
        $pagesize = isset($param['pagesize']) ? intval($param['pagesize']): 10;
        $sort     = isset($param['sort']) && !empty($param['sort'])    ? $param['sort']    : 2;
        if($sort == 1){
          $sort   = 'asc';
        }else if($sort == 2){
          $sort   = 'desc';
        }
        $where    = [];
        $where    = 'a.big_type='.$param['id'].' OR '. 'a.small_type='.$param['id'];
        $PorductCount = Db::table('be_product')
                       ->alias('a')
                       ->where($where)
                       ->count();
        $PorductList = Db::table('be_product')
                       ->alias('a')
                       ->field(['a.id','a.name as title','a.price','a.image'])
                       ->order('a.update_time',$sort)
                       ->where($where)
                       ->limit(($current  - 1) * $pagesize ,$pagesize)
                       ->select();
       foreach ($PorductList as $k => $v) {
           $PorductList[$k]['image'] = Config('ip')  .$v['image'];
       }
       return ['count'=>$PorductCount,'list'=>$PorductList,'pagination'=>['count'=>$PorductCount,'current'=>$current,'pageSize'=>$pagesize]];
    }

     /*
    *商品搜索数据App
    *$param['id'] 系列ID  / ['name'] 搜索内容
    **/
    public function ProductSearA($param)
    {
        $data = [];
        $where = [];
        $current     = isset($param['current'])     ? intval($param['current'])    : 1;
        $pagesize    = isset($param['pagesize']) ? intval($param['pagesize']): 10;
        $sort        = isset($param['sort'])  && !empty($param['sort'])   ? $param['sort']    : 2;
        if($sort == 1){
          $sort   = 'asc';
        }else if($sort == 2){
          $sort   = 'desc';
        }
        if(isset($param['name']) && !empty($param['name'])){
           $where['name'] =['like','%'.$param['name'].'%'];
        }
        $ProCount = Db::table('be_product')->where($where)->count();
        $ProSear  = Db::table('be_product')->alias('a')
                    ->field(['a.id','a.name','a.image','a.price'])
                    ->where($where)
                    ->order('a.update_time',$sort)
                    ->limit(($current  - 1) * $pagesize ,$pagesize)
                    ->select();
        if(!empty($ProSear)){
            foreach ($ProSear as $k => $v) {
                $ProSear[$k]['image'] = Config('ip')  . $v['image'];
            }
        }

        //推荐商品
        $whereReco = [];
        if(isset($param['name']) && !empty($param['name'])){
           $whereReco['name'] =['notlike','%'.$param['name'].'%'];
        }
        $ProReco  = Db::table('be_product')->field(['id','name','image','price'])->where($whereReco)->order('update_time','desc')->limit(0,3)->select();
        foreach ($ProReco as $k => $v) {
            $ProReco[$k]['image'] = Config('ip')  . $v['image'];
        }

        //查看更多
        $series_id = Db::table('be_series')->field(['id'])->order('update_time','desc')->find()['id'];
        
        $data = [
              'pSear'=>[
                  'count'=>$ProCount,
                  'list' =>$ProSear,
                  'pagination'=>['count'=>$ProCount,'current'=>$current,'pageSize'=>$pagesize]
              ],
              'pReco'=>[
                  'count'=>count($ProReco),
                  'list' =>$ProReco,
              ],
              'series_id' =>$series_id,
        ];
        return $data;
    }
}
