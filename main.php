<?php
if(!session_id()) session_start();
    class YZM{
         private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';//随机因子
         private $code_len=4;//验证码长度
         private $code;//验证码
         private $width=150;//长度
         private $height=50;//宽度
         private $img;//预存img
         private $font;//字体
         private $font_size=20;//字体大小
         private $font_color;//字体颜色

         public function __construct(){//构造方法
             $this->start();
             //生成       
             //eturn "a";

         }
         //字体
         private function fontfamily(){
             $ran=rand(0,2);
             $this->font=dirname(__FILE__).'\font-family'.$ran.'.ttf';
         }

         //随机码
         private function createcode(){
            $_len = strlen($this->charset)-1;
            for($i=0;$i<$this->code_len;$i++){
                $this->code.=$this->charset[rand(0,$_len)];//随机
            }
         }
         //背景生成
         private function createback(){
             $this->img=imagecreatetruecolor($this->width,$this->height);////创建真彩图像资源
             $color=imagecolorallocate($this->img,rand(157,255),rand(157,255),rand(157,255)); //分配颜色 随机颜色吧
             imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color); //生成
         }
         //生成文字
         private function createfont(){
             $_x=$this->width/$this->code_len;//每个字符的长度
             for($i=0;$i<$this->code_len;$i++){
                 $this->font_color=imagecolorallocate($this->img,rand(0,150),rand(157,180),rand(157,255));//字体颜色
                 imagettftext($this->img,$this->font_size,rand(-30,30),$_x*$i+rand(5,10),$this->height/1.4,$this->font_color,$this->font,$this->code[$i]);//背景中添加文字  参数 图片，字体大小，字体旋转角度，文字x坐标，文字y坐标
             }
         }
         //阻碍观看
         private function createLine(){
             //线条
             for($i=0;$i<4;$i++){
                 $color=imagecolorallocate($this->img,rand(150,157),rand(150,157),rand(150,157));
                 imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
             }
             //雪花
            for ($i=0;$i<20;$i++) {
                $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
                imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
            }
         }
         //排序
         private function start(){
             $this->fontfamily(); //字体加载 1
             $this->createcode(); //随机码生成 2
             $this->createback(); //背景创建 3
             $this->createLine(); //加入线条雪花 4
             $this->createfont(); //加入文字 5
			 session_unset();
             $_SESSION['code']=strtolower($this->code);
         }
         //返回
         public function returnz(){
             return $this->img;
         }
    }
?>