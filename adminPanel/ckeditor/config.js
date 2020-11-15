/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
	var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1); 
    var urlabso = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length))
	var url  = urlabso.substring(0, 51)
CKEDITOR.editorConfig = function( config ) {
	config.filebrowserBrowseUrl = url + '/kcfinder/browse.php?type=files';
   	config.filebrowserImageBrowseUrl = url + '/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = url + '/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = url + '/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = url + '/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = url + '/kcfinder/upload.php?type=flash';

};
