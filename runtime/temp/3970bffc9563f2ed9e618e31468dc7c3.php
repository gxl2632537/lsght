<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:90:"D:\software\phpstudy_pro\WWW\wwwlsgxcxcom\public/../application/admin\view\store\edit.html";i:1589445129;s:84:"D:\software\phpstudy_pro\WWW\wwwlsgxcxcom\application\admin\view\layout\default.html";i:1583049507;s:81:"D:\software\phpstudy_pro\WWW\wwwlsgxcxcom\application\admin\view\common\meta.html";i:1588499659;s:83:"D:\software\phpstudy_pro\WWW\wwwlsgxcxcom\application\admin\view\common\script.html";i:1583049507;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Manage_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-manage_name" class="form-control" name="row[manage_name]" type="text" value="<?php echo htmlentities($row['manage_name']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Description'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-description" class="form-control" name="row[description]" type="text" value="<?php echo htmlentities($row['description']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-avatar" class="control-label col-xs-12 col-sm-2"><span style="color: red">*</span><?php echo __('Logo_img'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-avatar" data-rule="required" class="form-control" size="50" name="row[logo_img]" type="text" value="<?php echo $row['logo_img']; ?>" readonly >
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-avatar" class="btn btn-danger plupload"   data-input-id="c-avatar" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-avatar"><i class="fa fa-upload"></i> 上传</button></span>
                    <span><button type="button" id="fachoose-avatar" class="btn btn-primary fachoose" data-input-id="c-avatar" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> 选择</button></span>
                </div>
                <span class="msg-box n-right" for="c-avatar"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-avatar"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('营业状态'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <?php echo Form::switcher('row[manage_status]', $value=$row['manage_status'], ['color'=>'blue']); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('营业时间'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-manage_time" class="form-control"  name="row[manage_time]" type="text" value="<?php echo $row['manage_time']?datetime($row['manage_time']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('选择加盟位置'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <span data-toggle="addresspicker" data-lat-id="c-dimension" data-lng-id="c-longitude"><a href="javascript:;">点击选择</a></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Longitude'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-longitude" class="form-control" name="row[longitude]" type="text" value="<?php echo htmlentities($row['longitude']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Dimension'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-dimension" class="form-control" name="row[dimension]" type="text" value="<?php echo htmlentities($row['dimension']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('省市区'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class='control-relative'><input id="c-city" class="form-control" data-toggle="city-picker" name="row[city]" type="text" value="<?php echo htmlentities($row['city']); ?>"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-detail" class="form-control" name="row[detail]" type="text" value="<?php echo htmlentities($row['detail']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Manage_contacts'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-manage_contacts" class="form-control" name="row[manage_contacts]" type="text" value="<?php echo htmlentities($row['manage_contacts']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Manage_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-manage_tel" class="form-control" name="row[manage_tel]" type="text" value="<?php echo htmlentities($row['manage_tel']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Manage_notice'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-manage_notice" class="form-control" name="row[manage_notice]" type="text" value="<?php echo htmlentities($row['manage_notice']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Head_contacts'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-head_contacts" class="form-control" name="row[head_contacts]" type="text" value="<?php echo htmlentities($row['head_contacts']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Head_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-head_tel" class="form-control" name="row[head_tel]" type="text" value="<?php echo htmlentities($row['head_tel']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('状态'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <?php echo Form::switcher('row[status]', $value=$row['status'], ['color'=>'green']); ?>
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