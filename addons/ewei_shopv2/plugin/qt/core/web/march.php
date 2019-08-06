<?php
if( !defined("IN_IA") )
{
    exit( "Access Denied" );
}


class March_EweiShopV2Page extends PluginWebPage
{
    public function main()
    {
        global $_W;
        global $_GPC;
        $groups = $this->model->getGroups();
        $pindex = max(1, intval($_GPC["page"]));
        $psize = 20;
        $params = array( ":uniacid" => $_W["uniacid"] );
        $condition = "";
        $keyword = trim($_GPC["keyword"]);

    }

    public function add()
    {
        $this->post();
    }

    protected function post()
    {
        global $_W;
        global $_GPC;
        $id = intval($_GPC["id"]);


        $item = pdo_fetch("select * from " . tablename("ewei_shop_merch_user") . " where id=:id and uniacid=:uniacid limit 1", array( ":id" => $id, ":uniacid" => $_W["uniacid"] ));
        if( empty($item) )
        {
            $item["iscredit"] = 1;
            $item["iscreditmoney"] = 1;
        }

        if( !empty($item["openid"]) )
        {
            $member = m("member")->getMember($item["openid"]);
        }

        if( !empty($item["payopenid"]) )
        {
            $user = m("member")->getMember($item["payopenid"]);
        }

        if( empty($item) || empty($item["accounttime"]) )
        {
            $accounttime = strtotime("+365 day");
        }
        else
        {
            $accounttime = $item["accounttime"];
        }

        if( !empty($item["accountid"]) )
        {
            $account = pdo_fetch("select * from " . tablename("ewei_shop_merch_account") . " where id=:id and uniacid=:uniacid limit 1", array( ":id" => $item["accountid"], ":uniacid" => $_W["uniacid"] ));
        }
        $item["pluginset"]="a:5:{s:10:\"creditshop\";a:1:{s:5:\"close\";s:1:\"0\";}s:5:\"quick\";a:1:{s:5:\"close\";s:1:\"0\";}s:6:\"taobao\";a:1:{s:5:\"close\";s:1:\"0\";}s:8:\"exhelper\";a:1:{s:5:\"close\";s:1:\"0\";}s:7:\"diypage\";a:1:{s:5:\"close\";s:1:\"0\";}}";
        if( !empty($item["pluginset"]) )
        {
            $item["pluginset"] = iunserializer($item["pluginset"]);
        }

        if( empty($account) )
        {
            $show_name = $item["uname"];
            $show_pass = m("util")->pwd_encrypt($item["upass"], "D");
        }
        else
        {
            $show_name = $account["username"];
        }

        $diyform_flag = 0;
        $diyform_plugin = p("diyform");
        $f_data = array(  );
        if( $diyform_plugin && !empty($_W["shopset"]["merch"]["apply_diyform"]) )
        {
            if( !empty($item["diyformdata"]) )
            {
                $diyform_flag = 1;
                $fields = iunserializer($item["diyformfields"]);
                $f_data = iunserializer($item["diyformdata"]);
            }
            else
            {
                $diyform_id = $_W["shopset"]["merch"]["apply_diyformid"];
                if( !empty($diyform_id) )
                {
                    $formInfo = $diyform_plugin->getDiyformInfo($diyform_id);
                    if( !empty($formInfo) )
                    {
                        $diyform_flag = 1;
                        $fields = $formInfo["fields"];
                    }

                }

            }

        }

        if( $_W["ispost"] )
        {
            $fdata = array(  );
            if( $diyform_flag )
            {
                $fdata = p("diyform")->getPostDatas($fields);
                if( is_error($fdata) )
                {
                    show_json(0, $fdata["message"]);
                }

            }

            $status = intval($_GPC["status"]);
            $username = trim($_GPC["username"]);
            $checkUser = false;
            if( 0 < $status )
            {
                $checkUser = true;
            }


            $where = " username=:username";
            $params = array( ":username" => $username );
            $where .= " and uniacid = :uniacid ";
            $params[":uniacid"] = $_W["uniacid"];
            if( !empty($account) )
            {
                $where .= " and id<>:id";
                $params[":id"] = $account["id"];
            }

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
                $pwd = md5(trim($_GPC["pwd"]) . $salt);
            }
            else
            {
                $salt = $account["salt"];
                $pwd = $account["pwd"];
            }

            $data = array( "uniacid" => $_W["uniacid"],
                "merchname" => trim($_GPC["merchname"]),
                "salecate" => trim($_GPC["salecate"]),
                "realname" => trim($_GPC["realname"]),
                "mobile" => trim($_GPC["mobile"]),
                "address" => trim($_GPC["address"]),
                "tel" => trim($_GPC["tel"]),
                "lng" => $_GPC["map"]["lng"],
                "lat" => $_GPC["map"]["lat"],
                "accounttime" => strtotime($_GPC["accounttime"]),
                "accounttotal" => intval($_GPC["accounttotal"]),
                "maxgoods" => intval($_GPC["maxgoods"]),
                "groupid" => intval($_GPC["groupid"]),
                "cateid" => intval($_GPC["cateid"]),
                "isrecommand" => intval($_GPC["isrecommand"]),
                "remark" => trim($_GPC["remark"]),
                "status" => $status,
                "desc" => trim($_GPC["desc1"]),
                "logo" => save_media($_GPC["logo"]),
                "payopenid" => trim($_GPC["payopenid"]),
                "payrate" => trim($_GPC["payrate"], "%"),
                "pluginset" => iserializer($_GPC["pluginset"]),
                "creditrate" => intval($_GPC["creditrate"]),
                "iscredit" => intval($_GPC["iscredit"]),
                "iscreditmoney" => intval($_GPC["iscreditmoney"]) );
            if( $diyform_flag )
            {
                $data["diyformdata"] = iserializer($fdata);
                $data["diyformfields"] = iserializer($fields);
            }

            if( empty($item["jointime"]) && $status == 1 )
            {
                $data["jointime"] = time();
            }

            $account = array(
                "uniacid" => $_W["uniacid"],
                "merchid" => $id,
                "username" => $username,
                "pwd" => $pwd,
                "salt" => $salt,
                "status" => 1,
                "perms" => serialize(array(  )),
                "isfounder" => 1 );
            $item = pdo_fetch("select * from " . tablename("ewei_shop_merch_user") . " where id=:id and uniacid=:uniacid limit 1", array( ":id" => $id, ":uniacid" => $_W["uniacid"] ));
            if( empty($item) )
            {
                $item["applytime"] = time();
                pdo_insert("ewei_shop_merch_user", $data);
                $id = pdo_insertid();
                $account["merchid"] = $id;
                pdo_insert("ewei_shop_merch_account", $account);
                $accountid = pdo_insertid();
                pdo_update("ewei_shop_merch_user", array( "accountid" => $accountid ), array( "id" => $id ));
            }
            else
            {
                pdo_update("ewei_shop_merch_user", $data, array( "id" => $id ));
                if( !empty($item["accountid"]) )
                {
                    pdo_update("ewei_shop_merch_account", $account, array( "id" => $item["accountid"] ));
                }
                else
                {
                    pdo_insert("ewei_shop_merch_account", $account);
                    $accountid = pdo_insertid();
                    pdo_update("ewei_shop_merch_user", array( "accountid" => $accountid ), array( "id" => $id ));
                }
            }

        }

        include($this->template());
    }



}


