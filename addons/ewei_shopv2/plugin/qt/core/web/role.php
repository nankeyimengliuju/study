<?php
if( !defined("IN_IA") )
{
    exit( "Access Denied" );
}


class Role_EweiShopV2Page extends PluginWebPage
{
    public function main()
    {
         $data = $this->addExcel();

         foreach ($data as $value){


             //创建用户
             $id = $this->saveuser($value[1],$value[2],$value[3]);
             //创建账户
             $this->saveaccount($value[1],$id);
             //创建角色
             $accountid =  $this->saverole("子商品管理员权限",$id,$id);
             //创建子账户
             $this->saveazccount($value[1].'-'.$value[2],$id,$accountid);


         }

    }

    public function saveuser($merchname,$realname,$mobile){
        echo '用户录入开始'.'<br/>';
        global $_W;
        global $_GPC;
        $_W["uniacid"]=1;//公众号id
        $_GPC["merchname"]=$merchname;
        $_GPC["status"]=1;
        $_GPC["groupid"]=6;//分组
        $_GPC["salecate"]="服饰";
        $_GPC["desc"]="简介";
        $_GPC["realname"]=$realname;
        $_GPC["mobile"]=$mobile;
        $_GPC["cateid"]=12; //商品类型id
        $_GPC["accountid"]=115; //权限id
        $_GPC["pluginset"]="a:5:{s:10:\"creditshop\";a:1:{s:5:\"close\";s:1:\"0\";}s:5:\"quick\";a:1:{s:5:\"close\";s:1:\"0\";}s:6:\"taobao\";a:1:{s:5:\"close\";s:1:\"0\";}s:8:\"exhelper\";a:1:{s:5:\"close\";s:1:\"0\";}s:7:\"diypage\";a:1:{s:5:\"close\";s:1:\"0\";}}";
        $_GPC["iscredit"]=1;
        $_GPC["accounttotal"]=1;
        $_GPC["iscreditmoney"]=1;
        $data = array( "merchname" => trim($_GPC["merchname"]),"uniacid" => $_W["uniacid"],
            "status" =>  $_GPC["status"],"desc" =>  $_GPC["desc"],
            "groupid" =>  $_GPC["groupid"],"salecate" => $_GPC["salecate"],
            "realname" =>  $_GPC["realname"],"mobile" =>  $_GPC["mobile"],
            "cateid" =>  $_GPC["cateid"],"accountid" => $_GPC["accountid"],
            "pluginset" =>  $_GPC["pluginset"],"iscredit" =>  $_GPC["iscredit"],
            "iscreditmoney" =>  $_GPC["iscreditmoney"],"accountid" => $_GPC["accountid"],
            "accounttotal" => $_GPC["accounttotal"]);
        pdo_insert("ewei_shop_merch_user", $data);

        $id = pdo_fetch("select id from " . tablename("ewei_shop_merch_user") . " where realname=:realname and mobile=:mobile limit 1", array( ":realname" => $_GPC["realname"], ":mobile" =>  $_GPC["mobile"] ));
         //权限id
        $data['accountid']=array( "accountid" =>$id['id'] );
        pdo_update("ewei_shop_merch_user",$data['accountid'],"id=".$id['id']);
        echo '用户录入结束'.'<br/>';
        return $id['id'];

    }

    public function saverole($rolename,$merchid,$id){

        echo '角色录入开始'.'<br/>';
        global $_W;
        global $_GPC;
        $_GPC["id"]=$id;
        $_W["uniacid"]=1;//公众号id
        $_GPC["rolename"]=$rolename;
        $_GPC["status"]=1;
        $_GPC["merchid"]=$merchid;//用户id
        $_GPC["perms"]="goods,goods,goods.main,goods.view,order,order.export,order.export.main,order.list,order.list.main,order.list.status_1,order.list.status0,order.list.status1,order.list.status2,order.list.status3,order.list.status4,order.list.status5,order.op.refund,order.op.refund.main";
        $data = array( "rolename" => trim($_GPC["rolename"]),"uniacid" => $_W["uniacid"],
            "status" =>  $_GPC["status"],"perms" =>  $_GPC["perms"],"merchid" =>  $_GPC["merchid"]);
        pdo_insert("ewei_shop_merch_perm_role", $data);
        $id = pdo_fetch("select id from " . tablename("ewei_shop_merch_perm_role") . " where merchid=:merchid limit 1", array( ":merchid" => $_GPC["merchid"] ));

        echo '角色录入结束'.'<br/>';
        return $id["id"];

    }

    public function saveaccount($useranme,$merchid){
        global $_W;
        global $_GPC;
        $salt = "";
        $pwd = "";
        if( empty($account) || empty($account["salt"]) || !empty($_GPC["pwd"]) )
        {
            $salt = random(8);
            while( 1 )
            {
                $saltcount = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_merch_account") . " where salt=:salt limit 1", array( ":salt" => $salt ));
                if( $saltcount <= 0 )
                {
                    break;
                }

                $salt = random(8);
            }
            $_GPC["pwd"]=123456;
            $pwd = md5(trim($_GPC["pwd"]) . $salt);

        }


        echo '一级商户录入开始'.'<br/>';

        $_GPC["uniacid"]=1; //公众号id
        $_GPC["username"]=$useranme;
        $_GPC["merchid"]=$merchid;// 用户id
        $_GPC["pwd"]=$pwd;
        $_GPC["salt"]=$salt;
        $_GPC["status"]=1;// 启用
        $_GPC["perms"]="a:0:{}";
        $_GPC["isfounder"]=1;
        $_GPC["roleid"]=0; //子账号id

        $data = array( "username" => trim($_GPC["username"]),"uniacid" => $_GPC["uniacid"],
            "status" =>  $_GPC["status"],"merchid" =>  $_GPC["merchid"],
            "pwd" =>  $_GPC["pwd"],"roleid" => $_GPC["roleid"],
            "isfounder" =>  $_GPC["isfounder"],"salt" =>  $_GPC["salt"],
            "perms" =>  $_GPC["perms"]);
        pdo_insert("ewei_shop_merch_account", $data);
        echo '一级商户录入结束'.'<br/>';
    }

    public function saveazccount($username,$merchid,$roleid){
        global $_W;
        global $_GPC;
        $salt = "";
        $pwd = "";
        if( empty($account) || empty($account["salt"]) || !empty($_GPC["pwd"]) )
        {
            $salt = random(8);
            while( 1 )
            {
                $saltcount = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_merch_account") . " where salt=:salt limit 1", array( ":salt" => $salt ));
                if( $saltcount <= 0 )
                {
                    break;
                }

                $salt = random(8);
            }
            $_GPC["pwd"]=111111;
            $pwd = md5(trim($_GPC["pwd"]) . $salt);
        }



        echo '子商户录入开始'.'<br/>';

        $_GPC["uniacid"]=1; //公众号id
        $_GPC["username"]=$username;
        $_GPC["merchid"]=$merchid;// role授权
        $_GPC["pwd"]=$pwd;
        $_GPC["salt"]=$salt;
        $_GPC["status"]=1;// 启用
        $_GPC["perms"]="";
        $_GPC["isfounder"]=0;
        $_GPC["roleid"]=$roleid; //子账号id


        $data = array( "username" => trim($_GPC["username"]),"uniacid" => $_GPC["uniacid"],
            "status" =>  $_GPC["status"],"merchid" =>  $_GPC["merchid"],
            "pwd" =>  $_GPC["pwd"],"roleid" => $_GPC["roleid"],
            "isfounder" =>  $_GPC["isfounder"],"salt" =>  $_GPC["salt"],
            "perms" =>  $_GPC["perms"]);
        pdo_insert("ewei_shop_merch_account", $data);
        echo '子商户录入结束'.'<br/>';
    }




//接收前台文件，
    public  function addExcel()
    {

        require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
        require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
        require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';



        $dir = dirname(__FILE__);

        //接收前台文件
        $ex = $_FILES['excel'];
        //重设置文件名
        $filename = time().substr($ex['name'],stripos($ex['name'],'.'));
        $path = $dir.$filename;//设置移动路径
        move_uploaded_file($ex['tmp_name'],$path);
        $objPHPExcelReader = PHPExcel_IOFactory::load($path);

        if(file_exists($path)){
            unlink($path);
        }

        //读取第一张表
        $sheet = $objPHPExcelReader->getSheet(0);
        //获取总行数
        $row_num = $sheet->getHighestRow();
        //获取总列数
        $col_num = $sheet->getHighestColumn();

        $data = []; //数组形式获取表格数据
        for($col='A';$col<=$col_num;$col++)
        {
            //从第二行开始，去除表头（若无表头则从第一行开始）
            for($row=3;$row<=$row_num;$row++)
            {
                $data[$row-2][] = $sheet->getCell($col.$row)->getValue();
            }
        }

        return $data;

    }



}


