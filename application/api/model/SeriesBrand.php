<?php

namespace app\api\model;

use think\Model;
use think\Db;
use think\Config;

class SeriesBrand extends Model
{    
    // 表名
    protected $name = 'series_brand';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = true;
    protected $updateTime = true;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];

    protected function getimageAttr( $value ) {
        return Config('ip')  . $value;
    }

    public function SeriesBrandList($param, $IsItem)
    {
        $current     = isset($param['current'])     ? intval($param['current'])    : 1;
        $pagesize = isset($param['pagesize']) ? intval($param['pagesize']): 10;
        $where = [];
        if(isset($param['id']) && !empty($param['id'])){
            $where['s.id'] = $param['id'];
        }
        if( $IsItem == 1){
            $field = ['a.id','a.title','a.image','date_format(a.update_time,"%Y月%m日") as time'];
        }else if( $IsItem == 2){
            $field = ['a.id','a.title','a.brief','a.image','date_format(a.update_time,"%Y-%m-%d") as time'];
        }
        $count = $this
                ->alias('a')
                ->join('be_series s','a.s_id = s.id','left')
                // ->join('be_series_brand b','a.l_id = b.id','left')
                ->where($where)
                ->count();
        $list = $this
                ->alias('a')
                ->field($field)
                ->join('be_series s','a.s_id = s.id','left')
                // ->join('be_series_brand b','a.l_id = b.id','left')
                ->order('a.update_time','desc')
                ->where($where)
                ->limit(($current - 1) * $pagesize ,$pagesize)
                ->select();
                
        return ['count'=>$count,'list'=>$list,'pagination'=>['count'=>$count,'current'=>$current,'pageSize'=>$pagesize]];
    }

    public function SeriesBrandFind($param)
    {
        $data_list = [];
        $where = [];
        if(isset($param['id']) && !empty($param['id'])){
            $where['a.id'] = $param['id'];
        }
         $list = Db::table('be_series_brand')
                ->alias('a')
                ->field(['a.id','a.title','a.image','a.s_id','s.title as series_title','s.brief as series_brief','b.ori_title as o_title','b.ori_brief as o_brief','b.ori_image as o_image1','b.ori_con as o_con1','b.ori_image1 as o_image2','b.ori_con1 as o_con2','b.idea_title as i_title','b.idea_brief as i_brief','b.idea_image  as i_image','b.idea_con as i_con','b.stor_title as s_title','b.stor_brief as  s_brief','b.stor_image as s_image','b.stor_con as s_con1','b.stor_con1 as s_con2','b.stor_vide as s_vide','b.vide_con as v_con','b.adva_title as a_title','b.adva_brief as a_brief','b.adva_image as a_image','b.adva_name as a_name','b.adva_image1 as a_image1','b.adva_name1 as a_name1','b.adva_image2 as a_image2','b.adva_name2 as a_name2','b.adva_con as a_con'])
                ->join('be_series s','a.s_id = s.id','left')
                ->join('be_series_brand_list b','a.l_id = b.id','left')
                ->order('a.update_time','desc')
                ->where($where)
                ->find();

        $proData = Db::table('be_product')->field(['id','image','name as title'])->where(['series_id'=>$list['s_id']])->order('update_time','desc')->limit(0,3)->select();
        foreach ($proData as $k => $v) {
            $proData[$k]['image'] = Config('ip') .$v['image'];
        }

        if(!empty($list)){
            $data_list = [
                'image' =>  Config('ip') . $list['image'],
                'origin'  => [
                        'title' => $list['o_title'],
                        'brief' => $list['o_brief'],
                        'desc'  => [
                                [
                                    'image'  => Config('ip').$list['o_image1'],
                                    'cont'   =>$list['o_con1'],
                                ],
                                [
                                    'image'  => Config('ip').$list['o_image2'],
                                    'cont'   =>$list['o_con2'],
                                ],
                        ],
                ],
                'idea'    => [
                        'title' => $list['i_title'],
                        'brief' => $list['i_brief'],
                        'image' => Config('ip') . $list['i_image'],
                        'con'   => $list['i_con'],
                ],
                'story' => [
                        'title' => $list['s_title'],
                        'brief'   => $list['s_brief'],
                        'image' => explode(',',$list['s_image']),
                        'con1'  => $list['s_con1'],
                        'con2'  => $list['s_con2'],
                        'vide'  => Config('ip').$list['s_vide'],
                        'con3'  => $list['v_con'],
                ],
                'advant'=> [
                        'title' => $list['a_title'],
                        'brief'   => $list['s_brief'],
                        'desc'    => [
                                [
                                    'image' => Config('ip') . $list['a_image'],
                                    'name'  => $list['a_name'],
                                ],
                                [
                                    'image' => Config('ip') . $list['a_image1'],
                                    'name'  =>$list['a_name1'],
                                ],
                                [
                                    'image' => Config('ip') . $list['a_image2'],
                                    'name'  =>$list['a_name2'],
                                ]
                        ],
                        'con'   => $list['a_con'],
                ],
                'reco' =>$proData,
                'series_id'    => $list['s_id'],
            ];
            foreach ($data_list['story']['image'] as $k => $v) {
                $data_list['story']['image'][$k] = Config('ip').$v;
            }
        }
        
        return $data_list;
    }



    /**
    *新增app首页查询
    */
    public function getBrStoA()
    {
        $list = $this
                ->alias('a')
                ->field(['a.id','a.image','a.s_id'])
                ->order('a.update_time','desc')
                ->limit(0,3)
                ->select();
        $data = [];
        $series_id = '';
        foreach ($list as $k => $v) {
            $data['list'][$k]['id'] = $v->id;
            $data['list'][$k]['image'] = $v->image;
            $series_id = $v->s_id;
        }
        $data['series_id'] = $series_id;
        return $data;
    }

    //
    public function SeriesBrandFindA($id)
    {
        $where['a.id'] = $id;
        $list = Db::table('be_series_brand')
                ->alias('a')
                ->field(['a.id','a.title','a.image','a.s_id','s.title as series_title','s.brief as series_brief','b.ori_title as o_title','b.ori_brief as o_brief','b.ori_image as o_image1','b.ori_con as o_con1','b.ori_image1 as o_image2','b.ori_con1 as o_con2','b.idea_title as i_title','b.idea_brief as i_brief','b.idea_image  as i_image','b.idea_con as i_con','b.stor_title as s_title','b.stor_brief as  s_brief','b.stor_image as s_image','b.stor_con as s_con1','b.stor_con1 as s_con2','b.stor_vide as s_vide','b.vide_con as v_con','b.adva_title as a_title','b.adva_brief as a_brief','b.adva_image as a_image','b.adva_name as a_name','b.adva_image1 as a_image1','b.adva_name1 as a_name1','b.adva_image2 as a_image2','b.adva_name2 as a_name2','b.adva_con as a_con','date_format(a.update_time,"%Y-%m-%d") as time'])
                ->join('be_series s','a.s_id = s.id','left')
                ->join('be_series_brand_list b','a.l_id = b.id','left')
                ->order('a.update_time','desc')
                ->where($where)
                ->find();
        $ReData = [
                'id' => $list['id'],
                'title' => $list['title'],
                'time'  => $list['time'],
                'content'=>[
                    [
                      'type'=>'text',
                      'content' => $list['o_con1'],
                    ],
                    [
                      'type'=>'pic',
                      'content' => Config('ip') .$list['image'],
                    ],
                    [
                      'type'=>'text',
                      'content' => $list['v_con'],
                    ],
              ],  
        ];
        $ProReco = Db::table('be_product')->field(['id','name as title','image','price'])->where(['series_id'=>$list['s_id']])->limit(0,3)->select();
        foreach ($ProReco as $k => $v) {
            $ProReco[$k]['image'] = Config('ip')  . $v['image'];
        }
        return ['list'=>$ReData,'pReco'=>$ProReco];
    }
}
