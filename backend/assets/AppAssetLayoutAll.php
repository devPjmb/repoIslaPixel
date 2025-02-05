<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAssetLayoutAll extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/all.min.css',
        'css/components-rounded.min.css',
        'css/plugins.min.css',
        'css/layout.min.css',
        'css/custom.min.css',
        'css/darkblue.min.css',
        'js/sweetalert-master/dist/sweetalert.css',
        'css/chosen.css',
        'css/general.css',
        // 'js/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.css',
        // 'js/kartik-v-bootstrap-fileinput-58467aa/css/fileinput.min.css'
    ];
    public $js = [
        // 'js/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.js',
        // 'js/kartik-v-bootstrap-fileinput-58467aa/js/fileinput.min.js',
       'js/bootstrap.min.js',
       'js/chosen.jquery.min.js',
       'js/underscore-min.js',
       'js/backbone-min.js',
       'js/js.cookie.min.js',
       'js/jquery.slimscroll.min.js',
       'js/jquery.blockui.min.js',
       'js/app.min.js',
       'js/layout.min.js',
       // 'js/demo.min.js',
       'js/quick-sidebar.min.js',
       'js/quick-nav.min.js',
        // 'js/ckeditor/ckeditor.js',
        'js/sweetalert-master/dist/sweetalert.min.js',
        'js/valida.2.1.7.min.js',
        'js_util/alerts.js',
        'js/firebase.js',
        'js/list.min.js',
        // 'js/jsgeneral.js',
        // 'js/jsajax.js'
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

