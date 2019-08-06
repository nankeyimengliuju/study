<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Delete_EweiShopV2Page extends PluginWebPage
{


    public function main()
    {

    }

    public function testdelete(){
        global $_W;
        global $_GPC;
        $id = intval($_GPC['id']);

        if (empty($id))
        {
            $id = ((is_array($_GPC['ids']) ? implode(',', $_GPC['ids']) : 0));
        }



        $qts = pdo_fetchall('SELECT * FROM ' . tablename('test_ewei_qt') . ' WHERE id in( ' . $id . ' ) ');

        foreach ($qts as $qt )
        {

             pdo_delete('test_ewei_qt', array('id' => $qt['id']));

        }
            show_json(1, array( "url" => referer() ));


    }

}

?>