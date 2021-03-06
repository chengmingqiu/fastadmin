<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

// api接口文档
Route::get('doc','reflection\Documents@run');

//首页接口
Route::get('getBra','api/HomePage/GetBra');
Route::get('getPro','api/HomePage/GetPro');
Route::get('getSeri','api/HomePage/GetSeri');

//系列接口
Route::get('getserLi','api/Series/SeriesList');

//产品接口
Route::get('getproLi','api/Product/PorductList');
Route::get('getproFi','api/Product/ProductFind');

//故事接口
Route::get('getserbLi','api/SeriesBrand/SeriesBrandList');
Route::get('getserbFi','api/SeriesBrand/SeriesBrandFind');

//关于我们
Route::get('getSele','api/Rele/SeleList');

//搜索产品
Route::post('getproSe','api/Product/ProductSear');

/*
* App端
*/
//首页接口
Route::get('getBraA','api/AppHomePage/GetBra');
Route::get('getProA','api/AppHomePage/GetPro');
Route::get('getBrStoA','api/AppHomePage/GetBrSto');
Route::get('getSeriA','api/AppHomePage/GetSeri');

//系列列表
Route::get('getserLiA','api/AppSeries/SeriesList');
Route::get('getsDatliA','api/AppSeries/SerDataLi');
Route::get('getserFiA','api/AppSeries/SerserFiA');


//产品接口
Route::get('getproLiA','api/AppProduct/PorductList');
Route::get('getproFiA','api/AppProduct/ProductFind');
Route::get('getSpecsA','api/AppProduct/getSpecsA');
Route::get('getServiA','api/AppProduct/getServiA');

//搜索产品
Route::get('getproSeA','api/AppProduct/ProductSear');
Route::get('getpseHoA','api/AppProduct/getpseHoA');


//故事接口
Route::get('getserbLiA','api/AppSeriesBrand/SeriesBrandList');
Route::get('getserbFiA','api/AppSeriesBrand/SeriesBrandFind');

//关于我们
Route::get('getSeleA','api/AppRele/getSeleA');
Route::get('getContA','api/AppRele/getContA');
Route::get('getActiA','api/AppRele/getActiA');
