<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：<span class="text-primary">商品库</span>
</div>
<div class="page-content">
    <form action="" method="post" class="form-horizontal form-search page-toolbar" role="form" style="margin-bottom: 0">
        <div class="col-sm-6 pull-right">
            <div class="input-group " >
                <input type="text" class="input-sm form-control" name="search" value="" placeholder="商品名称" > <span class="input-group-btn">
            <button class="btn  btn-primary" type="submit" style="float: left"> 搜索</button> </span>
            </div>
        </div>
    </form>
    <br>
    <?php  if(count($allGoods)>0) { ?>
    <table class="table table-responsive">
        <thead class="navbar-inner">
        <tr>
            <th style="width:60px;text-align:left;">序号</th>
            <th style="width:60px;">商品</th>
            <th  style="width:200px;">&nbsp;</th>
            <th style="width:70px;" >价格</th>
            <th  style="width:60px;" >操作</th>
        </tr>
        </thead>

        <tbody>
        <?php  if(is_array($allGoods)) { foreach($allGoods as $key => $value) { ?>
        <tr>
            <td style='text-align:left;'>
                <?php  echo ($key+$psize*($page-1)+1);?>
            </td>
            <td>
                <img src="<?php  echo tomedia($value['thumb']);?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
            </td>
            <td>
                <br/>
                <?php  echo $value['title'];?>
            </td>
            <td style="color: #ff747b"><?php  echo $value['marketprice'];?></td>
            <?php  if($value['hasoption']) { ?>
            <td  style="overflow:visible;">
                <a class='label label-fail' style="background-color:#ffb18e">
                    暂不开放多规格
                </a>
            </td>
            <?php  } else { ?>
            <?php  if(!$value['bargain']) { ?>
            <td  style="overflow:visible;">
                <?php  if(in_array($value['id'],$goodsids)) { ?>
                    <span class="label label-danger"><i class="fa fa-remove"></i> 已参加秒杀</span>
                    <br />
                    <a href="<?php  echo webUrl('seckill')?>" class="btn btn-default btn-sm" target="_blank">去取消</a>
                <?php  } else { ?>
                <a class='label label-success' href="<?php  echo webUrl('bargain/act',array('id'=>$value['id']));?>">
                    参加砍价
                </a>
                <?php  } ?>
            </td>
                <?php  } ?>
            <?php  } ?>
                <?php  if($value['bargain']) { ?>
            <td  style="overflow:visible;">
                <a class='label label-warning' href="<?php  echo webUrl('bargain/act',array('id'=>$value['id']));?>">
                    已发起
                </a>
                <?php  } ?>
            </td>
        </tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right"><?php  echo $pager;?></td>
            </tr>
        </tfoot>
    </table>
    <?php  } else { ?>
    <div class="panel panel-default">
        <div class="panel-body empty-data">暂时没有任何商品!</div>
    </div>
    <?php  } ?>
</div>



<script language="javascript">myrequire(['web/init'],function(){
    if($('.form-validate').length<=0) {  $('#page-loading').remove(); }
});</script>
<div id="page-loading" style="position: fixed;width:100%;height:100%;background:rgba(255,255,255,0.8);left:0;top:0;z-index:9999">
    <div class="sk-spinner sk-spinner-double-bounce" style="position:fixed;top:50%;left:50%;width:40px;height:40px;margin-left:-20px;margin-top:-20px;">
        <div class="sk-double-bounce1"></div>
        <div class="sk-double-bounce2"></div>
    </div>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>