<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Question_EweiShopV2Page extends PluginWebPage
{
	public function main()
	{
		global $_W;
		global $_GPC;
		$this->AllList();

	}


	//全部查询留言和条数
	public  function  AllList(){
		$array = pdo_getall("test_ewei_qt");
		$num = pdo_count("test_ewei_qt");
		$opencommission = true;



	include $this->template("qt/testPage");
	}

}

?>
