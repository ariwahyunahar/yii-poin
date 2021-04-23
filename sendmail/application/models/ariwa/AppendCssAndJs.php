<?php
class Model_ariwa_AppendCssAndJs
{
	public static function ariwa_include_all($base_url)
	{
		// extjs
		$string = '<link rel="stylesheet" type="text/css" href="'.$base_url.'/extjs/resources/css/ext-all.css" rel="stylesheet" />';
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/extjs/images/style.css" rel="stylesheet" />';
		
		$string .= '<script type="text/javascript" src="'.$base_url.'/extjs/adapter/ext/ext-base.js"></script>';
		$string .= '<script type="text/javascript" src="'.$base_url.'/extjs/ext-all-debug.js"></script>';
		
		echo $string;
		
		self::ariwa_include_css($base_url);
		self::ariwa_include_js($base_url);
	}
	
	public static function ariwa_include_css($base_url)
	{
		// css for tree
		$string = '<link rel="stylesheet" type="text/css" href="'.$base_url.'/ariwa/tambahan/treeGrid/treegrid/treegrid.css" rel="stylesheet" />';
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/ariwa/tambahan/maxtreegrid/TreeGrid.css" rel="stylesheet" />';
		// css for row editor
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/extjs/examples/ux/css/RowEditor.css" rel="stylesheet" />';
		// css tambahan
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/ariwa/tambahan/tambahan.css" rel="stylesheet" />';
		// css icon
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/ariwa/images/add_css.css" rel="stylesheet" />';
		// css grid header gabungan
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/ariwa/tambahan/groupheader/GroupHeaderPlugin.css" rel="stylesheet" />';
		// css for file upload
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/extjs/examples/ux/fileuploadfield/css/fileuploadfield.css" rel="stylesheet" />';
		// css for table
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/ariwa/tambahan/table/style.css" rel="stylesheet" />';
		// utuk menu logout bar pada main window
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/extjs/examples/ux/statusbar/css/statusbar.css" />';
		// utuk multiselect combobox
		$string .= '<link rel="stylesheet" type="text/css" href="'.$base_url.'/extjs/examples/extcombo/Ext.ux.form.CheckboxCombo.min.css" />';
		
		echo $string;
	}
	
	public static function ariwa_include_js($base_url)
	{
		// JS for Tree
		$string = '<script type="text/javascript" src="'.$base_url.'/ariwa/tambahan/maxtreegrid/TreeGrid.js"></script>';
		// js add function and add extend extjs class
		$string .= '<script type="text/javascript" src="'.$base_url.'/ariwa/tambahan/extend_class.js"></script>';
		$string .= '<script type="text/javascript" src="'.$base_url.'/ariwa/tambahan/start.js"></script>';
		// js for grid editor
		$string .= '<script type="text/javascript" src="'.$base_url.'/extjs/examples/ux/RowEditor.js"></script>';
		// js for grid checkbox
		$string .= '<script type="text/javascript" src="'.$base_url.'/extjs/examples/ux/CheckColumn.js"></script>';
		// js for close
		$string .= '<script type="text/javascript" src="'.$base_url.'/extjs/examples/ux/TabCloseMenu.js"></script>';
		// js for Row Expander
		$string .= '<script type="text/javascript" src="'.$base_url.'/extjs/examples/ux/RowExpander.js"></script>';
		// js File Upload
		$string .= '<script type="text/javascript" src="'.$base_url.'/extjs/examples/ux/fileuploadfield/FileUploadField.js"></script>';
		//js for statusbar
		$string.= '	<script type="text/javascript" src="'.$base_url.'/extjs/examples/ux/statusbar/StatusBar.js"></script>';
		//js multiselect combobox
		$string.= '	<script type="text/javascript" src="'.$base_url.'/extjs/examples/extcombo/Ext.ux.form.CheckboxCombo.min.js"></script>';
		
		// js grid header gabungan
		$string .= '<script type="text/javascript" src="'.$base_url.'/ariwa/tambahan/groupheader/GroupHeaderPlugin.js"></script>';
		// untuk iframe
		$string .= '<script type="text/javascript" src="'.$base_url.'/extjs/examples/ux/miframe.js"></script>';
		// untuk summary
		$string .= '<script type="text/javascript" src="'.$base_url.'/extjs/examples//ux/GroupSummary.js"></script>';
		echo $string;
	}
}
