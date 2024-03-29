<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .full-content-info{max-height:42px;line-height: 21px;overflow: hidden;}
    select.select-sm{width:120px;}
     .table tbody tr {
         height: 24px;
         border: 1px solid #efefef;
     }
</style>
<div class="page-header" xmlns:border-top="http://www.w3.org/1999/xhtml">
    当前位置：<span class="text-primary">投诉管理 </span>
</div>

<div class="page-content">
<form action="./index.php" method="get" class="form-horizontal form-search" role="form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="ewei_shopv2" />
    <input type="hidden" name="do" value="web" />
    <input type="hidden" name="r"  value="sns.complain" />
    <div class="page-toolbar m-b-sm m-t-sm">
        <div class="col-sm-7">
            <div class="btn-group btn-group-sm" style="float:left;">
                <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
            </div>
        </div>


        <div class="col-sm-5 pull-right">
            <div class="input-group">
                <div class="input-group-select">
                    <select name='searchtime' class='form-control'  >
                        <option value=''>不按时间</option>
                        <option value='create' <?php  if($_GPC['searchtime']=='create') { ?>selected<?php  } ?>>投诉时间</option>
                        <option value='checked' <?php  if($_GPC['searchtime']=='checked') { ?>selected<?php  } ?>>审核时间</option>
                    </select>
                </div>
                <input type="text" class=" form-control" name='keyword' value="<?php  echo $_GPC['keyword'];?>" placeholder="投诉内容"> <span class="input-group-btn">
                <button class="btn btn-primary" type="submit"> 搜索</button> </span>
            </div>
        </div>

    </div>
</form>

<form action="" method="post">
    <?php  if(count($complains)>0) { ?>
    <table class="table table-responsive" >
        <thead class="navbar-inner">
        <tr style="background: #f5f7f9">
            <th style="width:25px;"></th>
            <th style='width:40px; text-align: center;'></th>
            <th >投诉话题/评论</th>
            <th >投诉人</th>
            <th>投诉时间</th>
            <th style="text-align: center">状态</th>
            <th style="width: 95px;text-align: center">操作</th>
        </tr>
        <tr></tr>
        </thead>
        <tbody>
        <?php  if(is_array($complains)) { foreach($complains as $row) { ?>
        <tr>
            <td>
                <input type='checkbox' value="<?php  echo $row['id'];?>"/>
            </td>
            <td style="text-align: center;">
                <img class="radius50" style="width:30px;height:30px;padding1px;border:1px solid #ccc" src="<?php  echo tomedia($row['complainant']['avatar'])?>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'">
            </td>
            <td class="full">
                <label class="label label-danger"><?php  echo $row['typename'];?></label>
                <div class="full-content-info">
                    <a href="<?php  echo webUrl('member/list/detail',array('id'=>$row['complainant']['id']))?>"><?php  echo $row['complainant']['nickname'];?></a>:<?php  echo $row['content'];?>
                </div>
            </td>
            <td>
                <a href="<?php  echo webUrl('member/list/detail',array('id'=>$row['defendant']['id']))?>"><?php  echo $row['defendant']['nickname'];?></a>
            </td>
            <td>
                <?php  echo date('Y-m-d H:i', $row['createtime'])?>
            </td>
            <td style="text-align: center">

                <label class="label <?php  if($row['checked']==1) { ?>label-primary<?php  } else if($row['checked']==-1) { ?>label-danger<?php  } else { ?>label-warning<?php  } ?>" href="javascript:void(0);">
                    <?php  if($row['checked']==1) { ?>已审核<?php  } else if($row['checked']==-1) { ?>未通过<?php  } else { ?>待审核<?php  } ?>
                </label>
            </td>
            <td style="text-align:center;">
                <?php if(cv('sns.complain.check')) { ?>
                <?php  if($row['checked']==0) { ?>
                <a data-toggle="ajaxModal" href="<?php  echo webUrl('sns/complain/checked', array('id' => $row['id'],'type'=>$row['complaint_type']))?>" class="btn btn-default btn-sm btn-op btn-operation" style="<?php  if($row['needchecks']>0) { ?>color:red<?php  } ?>">
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="审核">
                        <i class="icow icow-icon19"></i>
                     </span>
                </a>
                <?php  } ?>
                <?php  } ?>
                <?php if(cv('sns.complain.delete')) { ?>
                <a data-toggle='ajaxRemove' href="<?php  echo webUrl('sns/complain/delete', array('id' => $row['id']))?>" class="btn btn-default btn-sm btn-op btn-operation" data-confirm='确认要删除此投诉吗?' title="删除">
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                        <i class="icow icow-shanchu1"></i>
                     </span>
                </a>
                <?php  } ?>
                <?php if(cv('sns.complain.delete')) { ?>
                <a data-toggle='ajaxRemove' href="<?php  echo webUrl('sns/complain/delete1', array('id' => $row['id']))?>"class="btn btn-default btn-sm btn-op btn-operation"  data-confirm='确认要彻底删除此投诉吗?'>
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="彻底删除">
                        <i class="icow icow-shanchu5"></i>
                     </span>
                </a>
                <?php  } ?>
            </td>
        </tr>
        <tr style="background: #f9f9f9">
            <td colspan="4" style='border-top:none;'>
                <a href="javascript:;" onclick="$(this).closest('tr').next('tr').toggle()">[投诉内容]</a>
            </td>
            <td colspan="3" style='text-align: right;border-top:none;' class='aops'>

            </td>
        </tr>
        <tr style="display:none;">
            <td colspan="7"  style='border-top:none;' class="full">
                <?php  echo $row['complaint_text'];?>
                <br/>
                <?php  if(count($row['images'])>0) { ?>
                <?php  if(is_array($row['images'])) { foreach($row['images'] as $img) { ?>
                <a href="<?php  echo tomedia($img)?>" target="_blank"><img src="<?php  echo tomedia($img)?>" style="width:50px;border:1px solid #ccc;padding:1px;margin:2px;" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'"/></a>
                <?php  } } ?>
                <?php  } ?>

            </td>
        </tr>
        <tr></tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-right"><?php  echo $pager;?></td>
            </tr>
        </tfoot>
    </table>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何投诉!
        </div>
    </div>
    <?php  } ?>

</form>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--OTEzNzAyMDIzNTAzMjQyOTE0-->