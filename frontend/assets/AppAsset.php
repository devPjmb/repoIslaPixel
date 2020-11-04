<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/site.css',
		'css/bootstrap.min.css',
		'css/animate.min.css',
		'css/agency.min.css',
		'css/all.min.css',
		'css/slick.css',
		'css/slick-theme.css',
	];
	public $js = [
		'js/jquery.min.js',
		'js/agency.min.js',
		'js/bootstrap.bundle.min.js',
		'js/contact_me.js',
		'js/jqBootstrapValidation.js',
		'js/jquery.easing.min.js',
		'js/modernizer.min.js',
		'js/wow.min.js',
		'js/slick.min.js',
		'js/main.js',
	];
	public $depends = [];
	}
