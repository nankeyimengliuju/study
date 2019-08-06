<?php
if (!(defined('IN_IA')))
{
    exit('Access Denied');
}

class Index_EweiShopV2Page extends PluginMobilePage
{
   public function main(){
    global $_W;
    global $GPC;




       include $this->template();

   }
   public function add(){
       global $_W;
       global $GPC;


       include $this->template();

   }
   public function sent(){
       global $_W;
       global $GPC;

       header('Access-Control-Allow-Origin: http://www.server.com');
        //发送SSE应答
       header('X-Accel-Buffering: no');
       header('Content-Type: text/event-stream');
       header('Cache-Control: no-cache');

       $old_md5 = '';

       while (1){
           //保持一个长连接，每隔3秒钟回答客户端一次
           $o_data = date('r');


           $str_return = json_encode($o_data);
           $md5 = md5($str_return);
           if ($md5 != $old_md5) {
               //如果内容发生了变化，则推送，否则不必推送，以节省网络流量
               echo 'data: ' . $str_return . "\n\n";
               $old_md5 = $md5;
           }
           ob_flush();
           flush();
           //等待3秒钟，开始下一次查询
           sleep(2);

       }


   }

   public function tosent(){
       date_default_timezone_set("America/New_York");
       header("Content-Type: text/event-stream\n\n");

       $counter = rand(1, 100);
       while (1) {

           echo "event: foo\n";
           $curDate = date(DATE_ISO8601);
           echo 'data: {"time": "' . $curDate . '"}';
           echo "\n\n";

           // Send a simple message at random intervals.

           $counter--;

           if (!$counter) {
               echo 'data: This is a message at time ' . $curDate . "\n\n";
               $counter = rand(1, 10);
           }

           ob_flush();
           flush();
           sleep(1);
       }
   }


}


