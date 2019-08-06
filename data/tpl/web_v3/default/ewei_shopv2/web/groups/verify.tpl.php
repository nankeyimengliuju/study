<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .pd0{padding:0;}
    .trhead td {  background:#efefef;text-align: center}
    .trbody td {  text-align: center; vertical-align:top;border-left:1px solid #f2f2f2;overflow: hidden; font-size:12px;}
    .trorder { background:#f8f8f8;border:1px solid #f2f2f2;text-align:left;}
    .ops { border-right:1px solid #f2f2f2; text-align: center;}
</style>
<div class="page-header">
    当前位置：<span class="text-primary">订单管理</span>
</div>
<div class="page-content">
<div class="main">
    <form action="./index.php" method="get" class="form-horizontal table-search" role="form">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r"  value="groups.verify" />
        <input type="hidden" name="status"  value="<?php  echo $_GPC['status'];?>" />
        <input type="hidden" name="verify"  value="<?php  echo $_GPC['verify'];?>" />
        <div class="page-toolbar m-b-sm m-t-sm">
            <div class="col-sm-6">
                <div class="btn-group btn-group-sm" style='float:left'>
                    <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
                </div>
            </div>
            <div class="col-sm-6 pull-right">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name="paytype" class="form-control input-sm select-md" style="width:100px;">
                            <option value="" <?php  if($_GPC['paytype']=='') { ?>selected<?php  } ?>>支付方式</option>
                            <?php  if(is_array($paytype)) { foreach($paytype as $key => $type) { ?>
                            <option value="<?php  echo $key;?>" <?php  if($_GPC['paytype'] == "$key") { ?> selected="selected" <?php  } ?>><?php  echo $type;?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <div class="input-group-select">
                        <select name='searchtime' class='form-control  input-sm select-md' style="width:100px;"  >
                            <option value=''>不按时间</option>
                            <option value='create' <?php  if($_GPC['searchtime']=='create') { ?>selected<?php  } ?>>下单时间</option>
                            <option value='pay' <?php  if($_GPC['searchtime']=='pay') { ?>selected<?php  } ?>>付款时间</option>
                            <option value='send' <?php  if($_GPC['searchtime']=='send') { ?>selected<?php  } ?>>发货时间</option>
                            <option value='finish' <?php  if($_GPC['searchtime']=='finish') { ?>selected<?php  } ?>>完成时间</option>
                        </select>
                    </div>
                    <div class="input-group-select">
                        <select name='searchfield'  class='form-control  input-sm select-md'   style="width:100px;"  >
                            <option value='orderno' <?php  if($_GPC['searchfield']=='orderno') { ?>selected<?php  } ?>>订单号</option>
                            <option value='member' <?php  if($_GPC['searchfield']=='member') { ?>selected<?php  } ?>>会员信息</option>
                            <option value='goodstitle' <?php  if($_GPC['searchfield']=='goodstitle') { ?>selected<?php  } ?>>商品名称</option>
                            <option value='goodssn' <?php  if($_GPC['searchfield']=='goodssn') { ?>selected<?php  } ?>>商品编码</option>
                            <option value='saler' <?php  if($_GPC['searchfield']=='saler') { ?>selected<?php  } ?>>核销员</option>
                            <option value='store' <?php  if($_GPC['searchfield']=='store') { ?>selected<?php  } ?>>核销门店</option>
                        </select>
                    </div>
                    <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"/>
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>
                    <button type="submit" name="export" value="1" class="btn btn-success btn-sm">导出</button>
                </span>
                </div>
            </div>
        </div>
    </form>
    <?php  if(count($list)>0) { ?>
    <table class='table table-responsive' style='table-layout: fixed;'>
        <tr style='background:#f8f8f8'>
            <td style='width:60px;border-left:1px solid #f2f2f2;'>商品</td>
            <td style='width:150px;'></td>
            <td style='width:70px;text-align: right;;'>单价/数量</td>
            <td  style='width:100px;text-align: center;'>买家</td>
            <td style='width:100px;text-align: center;'>支付/配送/退款</td>
            <td style='width:100px;text-align: center;'>金额</td>
            <td style='width:100px;text-align: center;'>操作</td>
            <td style='width:90px;text-align: center'>状态</td>
        </tr>
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        <tr ><td colspan='8' style='height:20px;padding:0;border-top:none;'>&nbsp;</td></tr>
        <tr class='trorder'>
            <td colspan='4' >
               <span style="font-weight: bold"> <?php  echo date('Y-m-d',$item['createtime'])?> <?php  echo date('H:i:s',$item['createtime'])?></span>
                订单编号:  <?php  echo $item['orderno'];?>
            </td>
            <td colspan='4' style='text-align:right;font-size:12px;' class='aops'>
                <?php if(cv('groups.verify.remarksaler')) { ?>
                <a class='op'  data-toggle="ajaxModal" href="<?php  echo webUrl('groups/order/remarksaler', array('id' => $item['id']))?>" >
                    <?php  if(!empty($item['remark'])) { ?>
                    <i class="icow icow-flag-o" style="color: #df5254;display: inline-block;vertical-align: middle" title="  "></i>
                    备注
                    <?php  } else { ?>
                    <i class="icow icow-yibiaoji" style="color: #999;display: inline-block;vertical-align: middle" title=" " ></i>
                    备注
                    <?php  } ?>

                </a>
                <?php  } ?>
                <?php  if($item['status'] == 0 ) { ?>
                <?php if(cv('groups.verify.close')) { ?>
                <a class='op'  data-toggle='ajaxModal' href="<?php  echo webUrl('groups/order/close',array('id'=>$item['id']))?>" >
                    <i class="icow icow-shutDown" title=""  style="color: #999;margin-right: 3px;display: inline-block;vertical-align: middle"></i>关闭订单</a>
                <?php  } ?>
                <?php  } ?>
            </td>
        </tr>
        <tr class='trbody' style="border-bottom: 1px solid #efefef">
            <td style='overflow:hidden;'><img src="<?php  echo tomedia($item['thumb'])?>" style='width:50px;height:50px;border:1px solid #ccc; padding:1px;' onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'"></td>
            <td style='text-align: left;overflow:hidden;border-left:none;'><?php  echo $item['title'];?></td>
            <td style='text-align:right;border-left:none;'>
                ¥ <?php  if($item['is_team']==1) { ?><?php  echo $item['groupsprice'];?><?php  } else { ?><?php  echo $item['singleprice'];?><?php  } ?>
                <br/>x1
            </td>
            <td  style='text-align: center;' >
                <?php if(cv('member.member.edit')) { ?>
                <a href="<?php  echo webUrl('member/list/detail',array('id'=>$item['mid']))?>"> <?php  echo $item['nickname'];?></a>
                <?php  } else { ?>
                <?php  echo $item['nickname'];?>
                <?php  } ?>
                <br/>
                <?php  echo $item['mrealname'];?><br/><?php  echo $item['mmobile'];?></td>
            <td style='text-align:center;' >
                <?php  if($item['pay_type']=='wechat') { ?>
                <span> <i class="icow icow-weixinzhifu text-success" style="font-size: 17px"></i>微信支付</span>
                <?php  } else if($item['pay_type']=='credit') { ?>
                <span> <i class="icow icow-yue text-warning" style="font-size: 17px;"></i><span>余额支付</span></span>
                <?php  } else if($item['pay_type']=='alipay') { ?>
                <span><i class="icow icow-zhifubaozhifu text-primary" style="font-size: 17px"></i>支付宝支付</span>
                <?php  } else if($item['pay_type']=='other') { ?>
                <span> <i class="text-info icow icow-icon" style="font-size: 17px"></i>其他</span>
                <?php  } else if($item['pay_type']=='') { ?>
                <i class="icow icow-shibai text-danger"></i>未支付
                <?php  } ?>
                <br />
                <span style="margin-top:5px;display:block;">
                    <?php  if($item['isverify'] == 1) { ?>
                    线下核销
                    <?php  } else if(!empty($item['addressid'])) { ?>
                    快递
                    <?php  } else if(!empty($item['isvirtualsend']) || !empty($item['virtual'])) { ?>
                    自动发货<?php  if(!empty($item['isvirtualsend'])) { ?>(虚拟物品)<?php  } else { ?>(虚拟卡密)<?php  } ?>
                    <?php  } else if($item['dispatchtype']) { ?>
                    自提
                    <?php  } else { ?>
                    其他
                    <?php  } ?>
                </span>
                <?php  if($item['refundtime']) { ?>
                <span class='label label-default'>已退款</span>
                <?php  } ?>
            </td>
            <td style='text-align:center' >
                ¥ <?php  echo number_format($item['price']-$item['creditmoney']+$item['freight'],2)?>
                <a data-toggle='popover' data-html='true' data-trigger="hover" data-placement='right' data-content="<table style='width:100%;'>
                <tr>
                    <td  style='border:none;text-align:right;'>商品小计：</td>
                    <td  style='border:none;text-align:right;;'>
                        ¥ <?php  echo number_format($item['price'] + $item['discount'],2)?>
                    </td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>运费：</td>
                    <td  style='border:none;text-align:right;;'>¥ <?php  echo number_format( $item['freight'],2)?></td>
                </tr>
                <?php  if($item['discount']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>团长优惠：</td>
                    <td class='text-danger' style='border:none;text-align:right;'>- ¥<?php  echo $item['discount'];?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['discountprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>会员折扣：</td>
                    <td  class='text-danger' style='border:none;text-align:right;;'>-¥ <?php  echo number_format( $item['discountprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['creditmoney']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>积分抵扣：</td>
                    <td  class='text-danger' style='border:none;text-align:right;;'>-¥ <?php  echo number_format( $item['creditmoney'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['deductenough']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>满额立减：</td>
                    <td  class='text-danger' style='border:none;text-align:right;;'>-¥ <?php  echo number_format( $item['deductenough'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['couponprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>优惠券优惠：</td>
                    <td  class='text-danger' style='border:none;text-align:right;;'>-¥ <?php  echo number_format( $item['couponprice'],2)?></td>
                </tr>
                <?php  if($item['isdiscountprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>促销优惠：</td>
                    <td  class='text-danger' style='border:none;text-align:right;;'>-¥ <?php  echo number_format( $item['isdiscountprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  } ?>
                <?php  if(intval($item['changeprice'])!=0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>卖家改价：</td>
                    <td  style='border:none;text-align:right;;'>
                    <span class='<?php  if(0<$item['changeprice']) { ?>success<?php  } else { ?>danger<?php  } ?>'>
                    <?php  if(0<$item['changeprice']) { ?>+<?php  } else { ?>-<?php  } ?>¥ <?php  echo number_format(abs($item['changeprice']),2)?>
                    </span>
                    </td>
                </tr>
                <?php  } ?>
                <?php  if(intval($item['changedispatchprice'])!=0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>卖家改运费：</td>
                    <td  style='border:none;text-align:right;;'>
                        <span class='<?php  if(0<$item['changedispatchprice']) { ?>success<?php  } else { ?>danger<?php  } ?>'>
                        <?php  if(0<$item['changedispatchprice']) { ?>+<?php  } else { ?>-<?php  } ?>¥ <?php  echo abs($item['changedispatchprice'])?>
                        </span>
                    </td>
                </tr>
                <?php  } ?>
                <tr>
                    <td style='border:none;text-align:right;'>应收款：</td>
                    <td style='border:none;text-align:right;font-weight:bold'>¥ <?php  echo number_format($item['price']-$item['creditmoney']+$item['freight'],2)?></td>
                </tr>
            </table>">
                    <i class='fa fa-question-circle'></i></a>
                <?php  if($item['freight']>0) { ?>
                <br/>(含运费:¥ <?php  echo number_format( $item['freight'],2)?>)
                <?php  } ?>
            </td>
            <td style='text-align:center' >
                <a class='op text-primary'  href="<?php  echo webUrl('groups/verify/detail', array('orderid' => $item['id']))?>" >查看详情</a>
                <?php  if(!empty($item['expresssn']) && $item['status']>=2 && !empty($item['addressid'])) { ?>
                <a class='op' data-toggle="ajaxModal" href="<?php  echo webUrl('util/express', array('id' => $item['id'],'express'=>$item['express'],'expresssn'=>$item['expresssn']))?>">查看物流</a>
                <?php  } ?>
            </td>
            <td  class='ops' style='line-height:20px;text-align:center' >
                <?php  if($item['status'] == 0) { ?><span class='text-danger'>待付款</span><?php  } ?>
                <?php  if($item['status'] == 1) { ?><span class='text-navy'>已付款</span><?php  } ?>
                <?php  if($item['deleted'] == 1) { ?>
                <span class='text-default'>用户已删除</span>
                <?php  } else { ?>
                <?php  if($item['status'] == 3) { ?><span class='text-success'>已完成</span><?php  } ?>
                <?php  if($item['status'] == -1) { ?><span class='text-default'>已取消</span><?php  } ?>
                <?php  } ?>
                <br />
                <?php  if($item['isverify']==1 && $item['status'] == 1) { ?>
                <!--核销 确认核销-->
                <?php if(cv('order.op.verify')) { ?>
                <a class="btn btn-primary btn-xs" style="display: none;" data-toggle='ajaxPost' href="<?php  echo webUrl('groups/verify/fetch', array('id' => $item['id']))?>" data-confirm="确认使用吗？">确认使用</a>
                <?php  } ?>
                <?php  } ?>
            </td>
        </tr>
        <!--<tr style="border-bottom:none;background:#f9f9f9;">-->
            <!--<td colspan='8' style='text-align:left;height:0;padding:0'></td>-->
        <!--</tr>-->
        <?php  } } ?>
    </table>
    <div style="text-align:right;width:100%;">
        <?php  echo $pager;?>
    </div>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何订单!
        </div>
    </div>
    <?php  } ?>
</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--4000097827-->