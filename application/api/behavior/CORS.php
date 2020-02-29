<?php


namespace app\api\behavior;
 
use think\Exception;
use think\Response;
 
class CORS
{
    public function appInit(&$params)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET,PATCH');
        if (request()->isOptions()) {
            exit();
        }
    }
}
