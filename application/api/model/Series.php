<?php

namespace app\api\model;

use think\Model;
use think\Db;
use think\Config;
use fast\Tree;

class Series extends Model
{    
    // 表名
    protected $name = 'series';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = true;
    protected $updateTime = true;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];

    public function getSeries()
    {
      $series =   Db::table('be_series')->field(['id','title','content as  brief','image'])->order('update_time','desc')->limit(0,3)->select();
      foreach ($series as $k => $v) {
           $series[$k]['story_id'] = Db::table('be_series_brand')->field(['id'])->where(['s_id'=>$v['id']])->find()['id'];
           $series[$k]['image'] = !empty($v['image']) ? explode(',', $v['image']) : '';
           if(!empty($series[$k]['image']))
           {
            foreach ($series[$k]['image'] as $ke => $va) {
                $series[$k]['image'][$ke] = Config('ip').$va;
            }
           }
      }
      return $series;
    }

    public function SeriesList()
    {
      $dataList  = [];
      $dataChild = [];
      $list = Db::table('be_series')->field(['id','type as title','pid'])->select();
      $listdata = $this->digui($list);
      foreach ($listdata as $k => $v) {
          if(!empty($v['child'])){
              $dataChild[] = $v;
          }else{
              $dataList[]  =  [
                    'id'   => $v['id'],
                    'title'=> $v['title'],
                    'pid'  => $v['pid'],
              ];
          }
      }
      return ['list'=>$dataList,'list2'=>$dataChild];
    }


     function digui($arr,$pid=0){
          $list = [];
          foreach ($arr as $k => $v) {
            if($v['pid'] == $pid){
              $v['child'] = $this->digui($arr,$v['id']);
              $list[] = $v; 
            }
          }
          return $list;
      }

    /*
    *新增app
    */
    public function getSeriesA()
    {
      $data = Db::table('be_series')
              ->field(['id','title','image'])
              ->order('update_time','desc')
              ->limit(0,3)
              ->select();
      foreach ($data as $k => $v) {
           $data[$k]['story_id'] = Db::table('be_series_brand')->field(['id'])->where(['s_id'=>$v['id']])->find()['id'];
           if(!empty($data[$k]['image']))
           {
              $data[$k]['image'] = !empty($v['image']) ? explode(',', $v['image']) : '';
              $data[$k]['image'] = Config('ip').$data[$k]['image'][0];
           }
      }
       return $data;
    }

    //系列列表
    public function SerDataList($param)
    {
      $current     = isset($param['current'])     ? intval($param['current'])    : 1;
      $pagesize = isset($param['pageSize']) ? intval($param['pageSize']): 10;
      $where = [];
      $count  = Db::table('be_series')->count();
      $data = Db::table('be_series')
             ->field(['id','image','title','brief','date_format(update_time,"%Y-%m-%d") as time'])
             ->order('update_time','desc')
             ->limit(($current - 1) * $pagesize ,$pagesize)
             ->select();
      foreach ($data as $k => $v) {
        $data[$k]['story_id'] = Db::table('be_series_brand')->field(['id'])->where(['s_id'=>$v['id']])->find()['id'];
        if(!empty($v['image'])){
            $image = explode(',', $v['image']);
            $data[$k]['image'] = Config('ip').$image[0];
        }
      }

       return ['list'=>$data,'pagination'=>['count'=>$count,'current'=>$current,'pageSize'=>$pagesize]];
    }

    //系列分类
    public function SeriesListA($param)
    {
      $list = Db::table('be_series')->field(['id','type as name','pid'])->select();
      $dgdata = $this->digui($list);
      $plist=[];
      $Alllist= [];
      if(!empty($dgdata)){
        foreach ($dgdata as $key => $val) {
          //全部
          $Alllist[$key]['id']   = $val['id'];
          $Alllist[$key]['name'] = $val['name'];
          if(!empty($dgdata[$key]['child'])){
             foreach ($dgdata[$key]['child'] as $k1 => $v1) {
               $Alllist[$key]['childNodes'][$k1]['id']     = $v1['id'];
               $Alllist[$key]['childNodes'][$k1]['name']   = $v1['name'];
               $Alllist[$key]['childNodes'][$k1]['childNodes']   = [];
             }
          }else{
            $Alllist[$key]['childNodes']= [];
          }
         } 
         //全部里添加内容
         $InChild = [['id'=>0,'name'=>'全部','childNodes'=>[]]];
         $AlllistData = array_merge($InChild,$Alllist);
         //判断当前推荐模块是否为空
         if(isset($param['id']) && !empty($param['id'])){
            foreach ($Alllist as $k => $v) {
                if($param['id'] == $v['id']){
                  $plist = $v;
                }
                if(!empty($v['childNodes'])){
                    foreach ($v['childNodes'] as $key => $val) {
                        if($param['id'] == $val['id']){
                          $plist = $v;
                        }
                    }
                }
            }
         }
         if(empty($plist)){
            $plist = ['id'=>0,'name'=>'全部','rightNodes'=>$Alllist];
         }
      }
      // var_dump($plist);die;
      return ['Nodes'=>$plist,'allNodes'=>$AlllistData];
    }

    public function SerFiA($id)
    {
       $find = Db::table('be_series')->field(['id','title','image','date_format(update_time,"%Y-%m-%d") as time','content','content1'])->where(['id'=>$id])->find();
       $find['image'] =Config('ip'). explode(',', $find['image'])[1];
       $ReturnData = [
              'id'   =>    $find['id'],
              'title'=>    $find['title'],
              'time' =>    $find['time'],
              'content' => [
                    [
                      'type'=>'text',
                      'content' =>$find['content'],
                    ],
                    [
                      'type'=>'pic',
                      'content' =>$find['image'],
                    ],
                    [
                      'type'=>'text',
                      'content' =>$find['content1'],
                    ],
              ],
       ];
       $ProReco  = Db::table('be_product')->field(['id','name as title','image','price'])->where(['series_id'=>$id])->order('update_time','desc')->limit(0,3)->select();
        foreach ($ProReco as $k => $v) {
            $ProReco[$k]['image'] = Config('ip')  . $v['image'];
        }
       
       return ['list'=>$ReturnData,'pReco'=>$ProReco];
    }
}
