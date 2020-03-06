<?php

namespace app\api\model;

use think\Model;
use think\Config;
use think\Db;
class Rele extends Model
{   

    // 表名
    protected $name = 'rele';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
    ];

    public function SeleList()
    {
        $data = [];
        $SeleList =  Db::table('be_rele')->order('update_time','desc')->find();
        if(!empty($SeleList)){
            $data = [
                'image' => Config('ip'). $SeleList['image'],
                'list'  => [
                               [
                                  'con'   =>$SeleList['con1'],
                                  'image' =>Config('ip'). $SeleList['con1_img'],
                               ],
                               [
                                  'con'   =>$SeleList['con2'],
                                  'image' =>Config('ip'). $SeleList['con2_img'],
                               ],
                               [
                                  'con'   =>$SeleList['con3'],
                                  'image' =>Config('ip'). $SeleList['con3_img'],
                               ],
                               [
                                  'con'   =>$SeleList['con4'],
                                  'image' =>Config('ip'). $SeleList['con4_img'],
                               ],
                       ],
                'brief_img' =>explode(',',$SeleList['brief_img']),
            ];
            if(!empty($data['brief_img'])){
                foreach ($data['brief_img'] as $k => $v) {
                    $data['brief_img'][$k] = Config('ip').$v;
                }
            }
        }
        return $data;
    }

    public function getSeleA()
    {
        $data = [];
        $SeleList =  Db::table('be_rele')->field(['title','date_format(update_time,"%Y-%m-%d") as time','con1','con1_img','con2'])->order('update_time','desc')->find();
        if(!empty($SeleList)){
             $data = [
                'title'  => $SeleList['title'],
                'time'   => $SeleList['time'],
                'content' =>[
                      [
                          'type'=>'text',
                          'content' => $SeleList['con1'],
                      ],
                      [
                          'type'=>'pic',
                          'content' => Config('ip').$SeleList['con1_img'],
                      ],
                      [
                          'type'=>'text',
                          'content' => $SeleList['con2'],
                      ],
                ],
            ];
        }
        return $data;
    }
}
