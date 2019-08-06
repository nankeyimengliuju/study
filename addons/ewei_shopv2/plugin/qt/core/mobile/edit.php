<?php
if (!(defined('IN_IA')))
{
    exit('Access Denied');
}

class Edit_EweiShopV2Page extends PluginMobilePage
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

}