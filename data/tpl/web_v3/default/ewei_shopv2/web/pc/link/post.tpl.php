<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-heading"> 
	<span class='pull-right'>
		<?php if(cv('pc.link.add')) { ?>
			<a class="btn btn-primary btn-sm" href="<?php  echo webUrl('pc/link/add')?>">添加新友情链接</a>
		<?php  } ?>
		<a class="btn btn-default  btn-sm" href="<?php  echo webUrl('pc/link')?>">返回列表</a>
               
	</span>
	<h2><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>友情链接 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['linkname'];?>】<?php  } ?></small></h2> 
</div>
 
    <form <?php if( ce('pc.link' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
 
                <div class="form-group">
                    <label class="col-sm-2 control-label">排序</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('pc.link' ,$item) ) { ?>
                                <input type="text" name="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
                                <span class='help-block'>数字越大，排名越靠前</span>
                        <?php  } else { ?>
                            <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label must">友情链接标题</label>
                    <div class="col-sm-9 col-xs-12 ">
                         <?php if( ce('pc.link' ,$item) ) { ?>
                        	<input type="text" id='linkname' name="linkname" class="form-control" value="<?php  echo $item['linkname'];?>" data-rule-required="true" />
                         <?php  } else { ?>
                        	<div class='form-control-static'><?php  echo $item['linkname'];?></div>
                        <?php  } ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">友情链接</label>
                    <div class="col-sm-9 col-xs-12">
                         <?php if( ce('pc.link' ,$item) ) { ?>

								<input type="text" value="<?php  echo $item['url'];?>" class="form-control valid" name="url" placeholder="">

                        <?php  } else { ?>
                        	<div class='form-control-static'><?php  echo $item['url'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-9 col-xs-12">
                    	<?php if( ce('pc.link' ,$item) ) { ?>
	                        <label class='radio-inline'>
	                            <input type='radio' name='status' value=1' <?php  if($item['status']==1) { ?>checked<?php  } ?> /> 显示
	                        </label>
	                        <label class='radio-inline'>
	                            <input type='radio' name='status' value=0' <?php  if($item['status']==0) { ?>checked<?php  } ?> /> 隐藏
	                        </label>
	                    <?php  } else { ?>
                            <div class='form-control-static'><?php  if(empty($item['status'])) { ?>隐藏<?php  } else { ?>显示<?php  } ?></div>
                        <?php  } ?>
                    </div>
                </div>
            
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                    	<?php if( ce('pc.link' ,$item) ) { ?>
                    		<input type="submit" value="提交" class="btn btn-primary"  />
                    	<?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('pc.link.add|pc.link.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
            </div>
 
    </form>
 

<script language='javascript'>
    function formcheck() {
        if ($("#linkname").isEmpty()) {
            Tip.focus("linkname", "请填写友情链接名称!");
            return false;
        }
        return true;
    }
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>