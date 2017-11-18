/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbar_Full =
        [
            { name: 'document', items : [ 'Source'/*,'-','Save','NewPage','DocProps','Preview','Print','-','Templates' */] },
            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
            { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
            { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton','HiddenField' ] },
            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
            { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
            { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
            { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
            { name: 'colors', items : [ 'TextColor','BGColor' ] },
        ];

    config.toolbar_Standard = 
        [
    		{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
    		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
    		'/',																					// Line break - next group will be placed in new line.
    		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
    		// { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
            { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
            { name: 'colors', items : [ 'TextColor','BGColor' ] },
            { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] },
            { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
    	];

    config.toolbar_Basic =
        [
            ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About']
        ];
    
    // ******************************************
    // ckfinder = "ckfinder3";
    kcfinder = 'kcfinder';
    // ******************************************
    // FCKeditor
    /*
    config.filebrowserBrowseUrl = libsUrl + ckfinder + '/ckfinder.html';
    config.filebrowserImageBrowseUrl = libsUrl + ckfinder +'/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = libsUrl + ckfinder +'/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = libsUrl +  ckfinder +'/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = libsUrl + ckfinder +'/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = libsUrl + ckfinder +'/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    */
    config.filebrowserBrowseUrl = libsUrl + kcfinder + '/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = libsUrl + kcfinder + '/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = libsUrl + kcfinder + '/browse.php?opener=ckeditor&type=flash';
    config.filebrowserDocsBrowseUrl = libsUrl + kcfinder + '/browse.php?opener=ckeditor&type=docs';

    config.filebrowserUploadUrl = libsUrl + kcfinder + '/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = libsUrl + kcfinder + '/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = libsUrl + kcfinder + '/upload.php?opener=ckeditor&type=flash';
    config.filebrowserDocsUploadUrl = libsUrl + kcfinder + '/upload.php?opener=ckeditor&type=docs';

    config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor_wiris';
    config.toolbar_Full.push({ name: 'wiris', items : [ 'ckeditor_wiris_formulaEditor' /*, 'ckeditor_wiris_formulaEditorChemistry', 'ckeditor_wiris_CAS' */]});
};
