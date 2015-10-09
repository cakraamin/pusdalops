<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('tiny_MCE'))
{
	function tiny_MCE()
	{
		$tinyMce = '
			<!-- TinyMCE -->
			<script type="text/javascript" src="'. base_url().'asset/js/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript">
				tinyMCE.init({
					// General options
					mode : "textareas",
					height : "500",
					theme : "advanced",
					plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
					
					// Theme options
					theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
					theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
					theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
					theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
					
					content_css : "css/content.css",
					setup: function(ed){
						ed.onInit.add(function(ed){
							mceObjParent = window.parentSandboxBridge
						});
					}
				});
			</script>
			<!-- /TinyMCE -->
			';	
		return $tinyMce;
   }
}

if(!function_exists('tiny_MCE_Img'))
{
	function tiny_MCE_Img()
	{
		$tinyMce = '
			<!-- TinyMCE -->
			<script type="text/javascript" src="'. base_url().'asset/js/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript">
				tinyMCE.init({
					// General options
					mode : "textareas",
					height : "500",
					theme : "advanced",
					plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
					
					// Theme options
					theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
					theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
					theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
					theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
					
					content_css : "css/content.css",
					setup: function(ed){
						ed.onInit.add(function(ed){
							mceObjParent = window.parentSandboxBridge
						});
					}
				});
			</script>
			<!-- /TinyMCE -->
			';	
		return $tinyMce;
   }
}

if(!function_exists('tiny_MCE_Simple'))
{
	function tiny_MCE_Simple()
	{
		$tinyMce = '
			<!-- TinyMCE -->
			<script type="text/javascript" src="'. base_url().'asset/js/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript">
				tinyMCE.init({
					// General options
					mode : "textareas",
					height : "200",
					theme : "simple",
					
					content_css : "css/content.css",
					setup: function(ed){
						ed.onInit.add(function(ed){
							mceObjParent = window.parentSandboxBridge
						});
					}
				});
			</script>
			<!-- /TinyMCE -->
			';	
		return $tinyMce;
   }
}