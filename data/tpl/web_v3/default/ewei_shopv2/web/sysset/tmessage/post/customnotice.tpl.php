<?php defined('IN_IA') or exit('Access Denied');?><style>
    .popover{
        margin-left: 48px !important;
    }
    .popover.bottom>.arrow{
        margin-left: -58px !important;
    }
</style>
<div class="row" style="height: 450px">
    <div class="col-sm-8">
        <div class="form-group">
            <label class="col-lg control-label">输入文字内容</label>
            <div class="col-sm-9 col-xs-12">
                <textarea id="send_desc" name="send_desc" style="height: 150px;resize: none;" class="form-control" placeholder='支持<a href=""></a>标签' ><?php  echo $list['send_desc'];?></textarea>
                <div class="edit" style="width: 100%;height: 30px;border-bottom:1px solid #e5e6e7;border-left:1px solid #e5e6e7;border-right:1px solid #e5e6e7">
                    <!--<div style="width: 30px;height: 30px;float: left;margin-left: 20px">-->
                    <!--<a href="javascript:" id="btn" title="插入emoji">-->
                    <!--<img src="../addons/ewei_shopv2/static/images/emoji.png" width="18px" height="18px" style="margin-top: 7px;">-->
                    <!--</a>-->
                    <!--</div>-->
                    <div style="width: 30px;height: 30px;float: left;margin-left: 20px">
                        <a href="javascript:" id="emotion" title="插入表情">
                            <img src="../addons/ewei_shopv2/static/images/qq.png" width="18px" height="18px" style="margin-top: 7px;">
                        </a>
                    </div>
                    <div style="width: 30px;height: 30px;float: left;margin-left: 20px">
                        <a href="javascript:" id="link" title="插入链接">
                            <img src="../addons/ewei_shopv2/static/images/link.png" width="18px" height="18px" style="margin-top: 7px;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <select class="form-control" onclick="$('.tm').hide();$('.tm-' + $(this).val()).show()">
                    <option value="">选择模板变量类型</option>
                    <option value="order">订单类</option>
                    <option value="upgrade">升级类</option>
                    <option value="rw">充值提现类</option>
                    <?php  if(cv('commission')) { ?>
                    <option value="commission">分销类</option>
                    <?php  } ?>
                    <?php  if(cv('globonus')) { ?>
                    <option value="globonus">股东类</option>
                    <?php  } ?>
                    <?php  if(cv('merch')) { ?>
                    <option value="merch">多商户类</option>
                    <?php  } ?>
                    <?php  if(cv('pstore')) { ?>
                    <option value="pstore">门店类</option>
                    <?php  } ?>
                    <?php  if(cv('bargain')) { ?>
                    <option value="bargain">砍价类</option>
                    <?php  } ?>
                    <?php  if(cv('exchange')) { ?>
                    <option value="exchange">兑换中心</option>
                    <?php  } ?>
                    <?php  if(cv('cashier')) { ?>
                    <option value="cashier">收银台类</option>
                    <?php  } ?>
                    <?php  if(cv('lottery')) { ?>
                    <option value="lottery">游戏中心类</option>
                    <?php  } ?>
                    <?php  if(cv('task')) { ?>
                    <option value="task">任务中心类</option>
                    <?php  } ?>

                </select>
            </div>
            <div class="panel-body tm tm-upgrade" style="display:none">
                <a href='JavaScript:' class="btn btn-default  btn-sm ">商城名称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">粉丝昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">旧等级</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">新等级</a>
            </div>
            <div class="panel-heading tm tm-rw" style="display:none">充值</div>

            <div class="panel-body tm tm-rw" style="display:none">
                <a href='JavaScript:' class="btn btn-default  btn-sm">支付方式</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">充值金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">充值时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">赠送金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">实际到账</a>
            </div>

            <div class="panel-heading tm tm-rw" style="display:none">充值退款</div>
            <div class="panel-body tm tm-rw" style="display:none">
                <a href='JavaScript:' class="btn btn-default  btn-sm">支付方式</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">充值金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">充值时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">赠送金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">实际到账</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">退款金额</a>
            </div>

            <div class="panel-heading tm tm-rw" style="display:none">提现</div>
            <div class="panel-body tm tm-rw" style="display:none">
                <a href='JavaScript:' class="btn btn-default  btn-sm">提现金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">提现时间</a>
            </div>
            <div class="panel-heading tm tm-order" style="display:none">
                订单信息
            </div>
            <div class="panel-body tm tm-order" style="display:none">
                <a href='JavaScript:' class="btn btn-default  btn-sm">商城名称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">粉丝昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">订单号</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">订单金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">运费</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">商品详情</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">单品详情</a>(单品商家下单通知变量)
                <a href='JavaScript:' class="btn btn-default btn-sm">快递公司</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">快递单号</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">购买者姓名</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">购买者电话</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">收货地址</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">下单时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">支付时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">发货时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">收货时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">门店</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">门店地址</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">门店联系人</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">门店营业时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">虚拟物品自动发货内容</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">虚拟卡密自动发货内容</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">自提码</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">备注信息</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">积分变动</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">积分余额</a>
            </div>
            <div class="panel-heading tm tm-order" style="display:none">
                售后相关
            </div>
            <div class="panel-body tm tm-order" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">售后类型</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">退款金额</a>

                <a href='JavaScript:' class="btn btn-default btn-sm">退货地址</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">换货快递公司</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">换货快递单号</a>

            </div>
            <div class="panel-heading tm tm-order" style="display:none">
                订单状态更新
            </div>
            <div class="panel-body tm tm-order" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">粉丝昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">订单编号</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">原收货地址</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">新收货地址</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">订单原价格</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">订单新价格</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">修改时间</a>

            </div>
            <div class="panel-heading tm tm-commission" style="display:none">成为下级或分销商</div>
            <div class="panel-body tm tm-commission" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
            </div>
            <div class="panel-heading tm tm-commission" style="display:none">新增下线通知</div>
            <div class="panel-body tm tm-commission" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">下线层级</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">下级昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
            </div>
            <div class="panel-heading tm tm-commission" style="display:none">下级付款类</div>
            <div class="panel-body tm tm-commission" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">下级昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">订单编号</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">订单金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">商品详情</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">佣金金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">下线层级</a>
            </div>
            <div class="panel-heading tm tm-commission" style="display:none">提现申请和佣金打款类</div>
            <div class="panel-body tm tm-commission" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">提现方式</a>
            </div>
            <div class="panel-heading tm tm-commission" style="display:none">分销商等级升级通知</div>
            <div class="panel-body tm tm-commission" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">旧等级</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">旧一级分销比例</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">旧二级分销比例</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">旧三级分销比例</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">新等级</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">新一级分销比例</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">新二级分销比例</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">新三级分销比例</a>
            </div>



            <div class="panel-heading tm tm-globonus" style="display:none">成为股东</div>
            <div class="panel-body tm tm-globonus" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
            </div>

            <div class="panel-heading tm tm-globonus" style="display:none">股东等级升级通知</div>
            <div class="panel-body tm tm-globonus" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">旧等级</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">旧分红例</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">新等级</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">新分红比例</a>
            </div>
            <div class="panel-heading tm tm-globonus" style="display:none">分红发放通知</div>
            <div class="panel-body tm tm-globonus" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">打款方式</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">金额</a>
            </div>

            <div class="panel-heading tm tm-merch" style="display:none">入驻申请</div>
            <div class="panel-body tm tm-merch" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">商户名称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">主营项目</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">联系人</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">手机号</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请时间</a>
            </div>
            <div class="panel-heading tm tm-merch" style="display:none">入驻申请(用户)</div>
            <div class="panel-body tm tm-merch" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">驳回原因</a>
            </div>

            <div class="panel-heading tm tm-bargain" style="display:none">砍价类</div>
            <div class="panel-body tm tm-bargain" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">砍价金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">当前金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">砍价时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">砍价人昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">砍掉或增加</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">成功或失败</a>
            </div>
            <div class="panel-heading tm tm-exchange" style="display:none">兑换中心</div>
            <div class="panel-body tm tm-exchange" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">兑换时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">兑换面值</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">粉丝昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">商城名称</a>
            </div>
            <div class="panel-heading tm tm-pstore" style="display:none">申请通知</div>
            <div class="panel-body tm tm-pstore" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">联系人</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">联系电话</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请时间</a>
            </div>

            <div class="panel-heading tm tm-pstore" style="display:none">申请结算通知</div>
            <div class="panel-body tm tm-pstore" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">联系人</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">联系电话</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请金额</a>
            </div>

            <div class="panel-heading tm tm-pstore" style="display:none">审核通知</div>
            <div class="panel-body tm tm-pstore" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">联系人</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">联系电话</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">审核状态</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">审核时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">驳回原因</a>
            </div>

            <div class="panel-heading tm tm-pstore" style="display:none">打款通知</div>
            <div class="panel-body tm tm-pstore" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">联系人</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">联系电话</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">打款时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">打款金额</a>

            </div>

            <div class="panel-heading tm tm-pstore" style="display:none">门店支付通知</div>
            <div class="panel-body tm tm-pstore" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">付款人</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">付款金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">付款时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">门店名称</a>

            </div>

            <!--收银台模板消息 begin-->
            <div class="panel-heading tm tm-cashier" style="display:none">申请结算通知</div>
            <div class="panel-body tm tm-cashier" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">联系人</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">联系电话</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请金额</a>
            </div>

            <div class="panel-heading tm tm-cashier" style="display:none">打款通知</div>
            <div class="panel-body tm tm-cashier" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">联系人</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">联系电话</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">打款时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">申请金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">打款金额</a>
            </div>

            <div class="panel-heading tm tm-cashier" style="display:none">支付通知</div>
            <div class="panel-body tm tm-cashier" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">付款金额</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">余额抵扣</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">付款时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">收银台名称</a>

            </div>

            <div class="panel-heading tm tm-lottery" style="display:none">获得抽奖通知</div>
            <div class="panel-body tm tm-lottery" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">活动名称</a>
            </div>

            <div class="panel-heading tm tm-task" style="display:none">通用任务</div>
            <div class="panel-body tm tm-task" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">当前时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">接取时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">截止时间</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">任务名称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">分数进度</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">任务所有者昵称</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">已完成数</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">待完成数</a>
                <a href='JavaScript:' class="btn btn-default btn-sm">总需求数</a>
            </div>
            <div class="panel-heading tm tm-task" style="display:none">海报任务</div>
            <div class="panel-body tm tm-task" style="display:none">
                <a href='JavaScript:' class="btn btn-default btn-sm">关注者昵称</a>
            </div>

            <div class="panel-body">
                点击变量后会自动插入选择的文本框的焦点位置，在发送给粉丝时系统会自动替换对应变量值
                <div class="text text-danger">
                    注意：以上模板消息变量只适用于系统类通知，会员群发工具不适用
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    require(['jquery','util'], function($, util){
        $(function(){
            $('#btn').click(function(){
                util.emojiBrowser(function(emoji){
                    console.log(emoji);
                    var text = '[U+'+emoji[0].text+']';
                    var content = $('#send_desc').val()+text;
                    $('#send_desc').val(content);

                });
            });
        });

        $(function(){
            util.emotion($('#emotion'),$('#send_desc'),function (emotion_code) {
                var content = $('#send_desc').val()+emotion_code;
                $('#send_desc').val(content);
            });
        });

        $(function () {
            $('#link').click(function () {
                var link='<a href=\\"您要插入的链接\\">链接文字</a>';
                var content = $('#send_desc').val()+link;
                $('#send_desc').val(content);
            });
        });
    });


</script>