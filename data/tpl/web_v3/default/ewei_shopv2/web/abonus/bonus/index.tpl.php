<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">
    当前位置：<span class="text-primary"> <?php  if(empty($status)) { ?>待确认<?php  } else if($status==1) { ?>待结算<?php  } else if($status==2) { ?>已结算<?php  } ?>结算单
</span>
</div>
<div class="page-content">
    <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="abonus.bonus.status<?php  echo $status;?>" />

        <div class="page-toolbar  m-b-sm m-t-sm">
            <div class="col-sm-5">
                <span class=''>
                    <?php if(cv('abonus.bonus.build')) { ?>
                        <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('abonus/bonus/build')?>"><i class='fa fa-plus'></i> 创建结算单</a>
                    <?php  } ?>
                </span>
            </div>


            <div class="col-sm-6 pull-right">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name="year" class='form-control'>
                            <option value=''>年份</option>
                            <?php  if(is_array($years)) { foreach($years as $y) { ?>
                            <option value="<?php  echo $y;?>" <?php  if($y==$_GPC['year']) { ?>selected="selected"<?php  } ?>><?php  echo $y;?>年</option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <div class="input-group-select">
                        <select name="month" class='form-control'>
                            <option value=''>月份</option>
                            <?php  if(is_array($months)) { foreach($months as $m) { ?>
                            <option value="<?php  echo $m;?>" <?php  if($m==$_GPC['month']) { ?>selected="selected"<?php  } ?>><?php  echo $m;?>月</option>
                            <?php  } } ?>
                        </select>
                    </div>

                        <?php  if($set['paytype']==2) { ?>
                    <div class="input-group-select">
                        <select name="week" class='form-control' >
                            <option value="1" <?php  if($_GPC['year']==1) { ?>selected="selected"<?php  } ?>>第1周</option>
                            <option value="2" <?php  if($_GPC['year']==2) { ?>selected="selected"<?php  } ?>>第2周</option>
                            <option value="3" <?php  if($_GPC['year']==3) { ?>selected="selected"<?php  } ?>>第3周</option>
                            <option value="4" <?php  if($_GPC['year']==4) { ?>selected="selected"<?php  } ?>>第4周</option>
                        </select>
                    </div>
                        <?php  } ?>

                    <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="结算单号"/>
                     <span class="input-group-btn">

                                            <button class="btn btn-primary" type="submit"> 搜索</button>
                                                                                        <?php if(cv('abonus.bonus.export')) { ?>
                            <button type="submit" name="export" value="1" class="btn btn-success ">导出</button>
                            <?php  } ?>
                    </span>
                </div>

            </div>
        </div>


    </form>
    <?php  if(count($list)>0) { ?>

    <table class="table table-hover  table-responsive ">
        <thead class="navbar-inner">
        <tr>
            <th >结算单号</th>
            <th>订单</th>
            <th >代理商</th>
            <th>预计/最红分红</th>
            <th>状态</th>
            <th style="width: 65px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td>
                <?php  if($row['paytype']==2) { ?><label class="label label-warning inline">按周结算</label><?php  } else { ?><label class="label label-primary inline">按月结算</label><?php  } ?>
                <?php  echo $row['year'];?>年<?php  echo $row['month'];?>月
                <?php  if($row['paytype']==2) { ?>
                第<?php  echo $row['week'];?>周
                <?php  } ?>
                <br />
                <?php  echo $row['billno'];?></td>
            <td>数量：<span class="text-success inline"><?php  echo $row['ordercount'];?></span><br/>金额：<span class="text-danger"><?php  echo $row['ordermoney'];?></span></td>
            <td>
                <span class="text-default">总数：<?php  echo $row['aagentcount1'] + $row['aagentcount2'] + $row['aagentcount3']?> 个</span><br/>
                <span class="text-primary">省级：<?php  echo $row['aagentcount1'];?> 个</span><br/>
                <span class="text-success">市级：<?php  echo $row['aagentcount2'];?> 个</span><br/>
                <span class="text-warning">区级：<?php  echo $row['aagentcount3'];?> 个</span>
            </td>

            <td>
             <span class="text-default">总额：<?php  echo $row['bonusmoney1'] + $row['bonusmoney2'] +$row['bonusmoney3']?> 元</span><br/>
             <span class="text-primary">省级：<?php  echo $row['bonusmoney1'];?> / <?php  echo $row['bonusmoney_send1'];?> 元  </span><br/>
             <span class="text-success">市级：<?php  echo $row['bonusmoney2'];?> / <?php  echo $row['bonusmoney_send2'];?> 元</span><br/>
             <span class="text-warning">区级：<?php  echo $row['bonusmoney3'];?> / <?php  echo $row['bonusmoney_send3'];?> 元</span>


            </td>
    <td>
        <?php  if(empty($row['status'])) { ?><label class="label label-warning">待确认</label>
        <?php  } else if($row['status']==1) { ?><label class="label label-primary">待结算</label>
        <?php  } else { ?><label class="label label-success">已结算</label>
        <?php  } ?>
    </td>
            <td>
                <?php if(cv('abonus.bonus.detail')) { ?>
                <a class='btn btn-default btn-sm btn-op btn-operation' href="<?php  echo webUrl('abonus/bonus/detail',array('id' => $row['id']))?>">
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="详情">
                        <i class='icow icow-bianji2'></i>
                    </span>
                </a>
                <?php  } ?>
                <?php  if(empty($row['status'])) { ?>
                    <?php if(cv('abonus.bonus.delete')) { ?>
                <a data-toggle='ajaxRemove' href="<?php  echo webUrl('abonus/bonus/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm btn-op btn-operation" data-confirm='确认要删除此结账单?'>
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                        <i class='icow icow-shanchu1'></i>
                    </span>
                </a>
                    <?php  } ?>
                <?php  } ?>

            </td>
        </tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <small>
                        总数: <span class="text text-danger"><?php  echo $total;?></span>
                        分红总额: <span class="text text-danger"><?php  echo $totalmoneys['b1'] +$totalmoneys['b2'] + $totalmoneys['b3']?></span>
                        省级: <span class="text text-danger"><?php  echo $totalmoneys['b1'];?></span>
                        市级: <span class="text text-danger"><?php  echo $totalmoneys['b2'];?></span>
                        区级: <span class="text text-danger"><?php  echo $totalmoneys['b3'];?></span>
                    </small>
                </td>
                <td colspan="4" class="text-right"> <?php  echo $pager;?></td>
            </tr>
        </tfoot>
    </table>


    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何分红明细!
        </div>
    </div>
    <?php  } ?>
</div>
<script language="javascript">



    require(['bootstrap'],function(){
        $("[rel=pop]").popover({
            trigger:'manual',
            placement : 'left',
            title : $(this).data('title'),
            html: 'true',
            content : $(this).data('content'),
            animation: false
        }).on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(this).siblings(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide")
                }
            }, 100);
        });


    });


</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--OTEzNzAyMDIzNTAzMjQyOTE0-->