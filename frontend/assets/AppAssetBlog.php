<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAssetBlog extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/blog/bootstrap.min.css',
		'css/blog/blog-home.css',
	];
	public $js = [
		'js/blog/jquery.min.js',
		'js/blog/bootstrap.bundle.min.js',
	];
	public $depends = [];
	}
