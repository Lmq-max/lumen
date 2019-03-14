<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class IndexController
{
    public  $redis_h_u_key='api:h:u';  //用户个人信息
   public function index(){
       $arr=[
           'name'=>'lmq',
           'age'=>'18',
           'email'=>'lmq@qq.com'
       ];
       return($arr);
   }
   public function info(){
       phpinfo();
   }
   public function aaa(){
       echo '<pre>';print_r($_POST);echo '</pre>';
   }
   /*用户登录*/
    public function login(Request $request){
        $user_name=$request->post('u');
        $pwd=$request->post('p');
        //echo "<pre>";print_r($_POST);echo "</pre>";
        //验证用户信息
        if(1){ //登录成功
            $uid=1000;
            $str=time()+$uid+mt_rand(1111,9999);
            $token=substr(md5($str),10,20);
            //保存token至redis
            $key='api:h:u'.$uid;
            Redis::hSet($this->redis_h_u_key.$uid,'token',$token);
            Redis::expire($key,3600*24*7);  //过期时间
            echo $token;
        }else{
            //TODO登录失败
        }
    }
    //个人中心
    public function uCenter(){
        $uid=$_GET['uid'];
        if(empty($_SERVER['HTTP_TOKEN'])){
            $response=[
                'error'=>50000,
                'msg'=>'Token Require!!'
            ];
        }else{
            //验证token有效 是否过期 是否伪造
            $key=$this->redis_h_u_key.$uid;
            $token=Redis::hGet($key,'token');
            if($token==$_SERVER['HTTP_TOKEN']){
                $response=[
                    'error'=>0,
                    'msg'=>'ok',
                    'data'=>[
                        'aaa'=>'bbbbb',
                        'ccc'=>'ccccc'
                    ]
                ];
            }else{
                $response=[
                    'error'=>50001,
                    'msg'=>'Invalid Token!!!'
                ];
            }
            return $response;
        }
    }
}
