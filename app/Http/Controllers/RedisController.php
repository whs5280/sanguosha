<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use App\Entity\Product;

class RedisController extends Controller
{
    public function testRedis()
    {
        $result = Product::all();
        Redis::set('product_key',$result);
        if(Redis::exists('product_key')){
            $values = Redis::get('product_key');
        }else{
            $values = Product::all();
        }
        dump($values);
    }
}