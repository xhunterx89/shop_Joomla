<?php
 /**
  * @version $Id$
  *  @package IceTheme IceOptimizer extenion
  *  @subpackage	IceTheme PlgSYstemId_Optimizer
  *  @copyright Copyright (C) 2010 IceTheme. All rights reserved.
  *  @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
  */
define( 'DS', DIRECTORY_SEPARATOR );
$cacheRootPath = str_replace( 'plugins' . DS . 'system' .DS . 'ice_speed'.DS.'ice_speed', 'cache', dirname(__FILE__) );


$filename  =  isset($_GET['f'])? $_GET['f']:'';
$tmp       = explode( '.', $filename );
$type      = 'css';

if( !empty($filename) ){
	$cacheGroup = 'plg_icespeed';
	$path = $cacheRootPath.DS.$cacheGroup.DS.$filename.'.php';
	$path = $cacheRootPath.DS.$cacheGroup.DS.$tmp[0].'.php';
	if (file_exists($path) && count($tmp) == 2 ) {
		$content = @file_get_contents($path);
		$content = str_replace('<?php die("Access Denied"); ?>#x#', '', $content);
		//$content = unserialize(preg_replace('/^.*\n/', '', $content));
		$content = unserialize($content);
		$content = $content['result'];
		$type=$tmp[1];
	}
	$expire = @file_get_contents( $cacheRootPath.DS.'time.txt' );
	header('Expires: ' . gmdate('D, d M Y H:i:s', filectime($path) + $expire) . ' GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($path)).' GMT');

	// check request whethere to use gzip?
	if( isset($_GET['use']) &&  $_GET['use'] == 'gzip' ){
   		header( "Content-Encoding: gzip" );
   		$content = gzencode( $content );
	}
}

if( $type == 'js' ){
	header( 'Content-type: text/javascript; charset=UTF-8' );
}else{ 
	header( 'Content-type: text/css; charset=UTF-8' );
}
echo  $content;

?>
