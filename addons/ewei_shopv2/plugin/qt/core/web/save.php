<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

//写留言
class Save_EweiShopV2Page extends  PluginWebPage
{
    public function main()
    {
        $this->add();
    }

    public  function  add()
    {

        global $_W;
        global $_GPC;

        //接受参数
        if (!empty($_GPC['message'])) {
             $content = $_GPC['message'];
        }
        if (!empty($_GPC['email'])) {
            $email = $_GPC['email'];
        }

       //插入留言信息
        $data = array
        (
            "name"=>$_W['username'],
            "time"=> date('Y-m-d h:i:s', time()),
            "content"=>$content,
            "email"=>$email
        );

        $result = pdo_insert("test_ewei_qt",$data);
        if($result>0){
           //跳转到主页面

            header('location: ' . webUrl('qt/question'));
        }

   }




}


