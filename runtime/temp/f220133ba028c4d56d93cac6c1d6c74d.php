<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:90:"D:\software\phpstudy_pro\WWW\wwwlsgxcxcom\public/../application/admin\view\member\add.html";i:1589686245;s:84:"D:\software\phpstudy_pro\WWW\wwwlsgxcxcom\application\admin\view\layout\default.html";i:1583049507;s:81:"D:\software\phpstudy_pro\WWW\wwwlsgxcxcom\application\admin\view\common\meta.html";i:1588499659;s:83:"D:\software\phpstudy_pro\WWW\wwwlsgxcxcom\application\admin\view\common\script.html";i:1583049507;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Member_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-member_name" class="form-control" name="row[member_name]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Member_birthday'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-member_birthday" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" name="row[member_birthday]" type="text" value="<?php echo date('Y-m-d'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Member_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-member_tel" class="form-control" name="row[member_tel]" type="number" data-rule="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Member_store_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">


            <select name="row[member_store_id]"  id="c-member_store_id" class="selectpicker" data-rule="required">
                <?php if(is_array($store) || $store instanceof \think\Collection || $store instanceof \think\Paginator): $i = 0; $__LIST__ = $store;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['manage_name']; ?></option>
                <?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Member_integral'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-member_integral" class="form-control" name="row[member_integral]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Member_stored_value'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-member_stored_value" class="form-control" name="row[member_stored_value]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Member_card_validity'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-member_card_validity" data-rule="required" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[member_card_validity]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('状态'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo Form::switcher('row[status]', '1', ['color'=>'green', 'disabled'=>true]); ?>
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>