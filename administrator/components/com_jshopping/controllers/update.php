<?php
/**
* @version      2.9.4 06.08.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.archive');
jimport('joomla.filesystem.path');

class JshoppingControllerUpdate extends JController{
    
    function __construct( $config = array() ){
        $mainframe =& JFactory::getApplication();
        parent::__construct( $config );
        checkAccessController("update");
        addSubmenu("update");
    }

    function display(){
		                
		$view=&$this->getView("update", 'html');        
		$view->display(); 
    }
    
	
	function update() {
        
        // Get the uploaded file information
        $userfile = JRequest::getVar('install_package', null, 'files', 'array' );

        // Make sure that file uploads are enabled in php
        if (!(bool) ini_get('file_uploads')) {
            JError::raiseWarning('SOME_ERROR_CODE', JText::_('WARNINSTALLFILE'));
            $this->setRedirect("index.php?option=com_jshopping&controller=update");
            return false;
        }

        // Make sure that zlib is loaded so that the package can be unpacked
        if (!extension_loaded('zlib')) {
            JError::raiseWarning('SOME_ERROR_CODE', JText::_('WARNINSTALLZLIB'));
            $this->setRedirect("index.php?option=com_jshopping&controller=update");
            return false;
        }

        // If there is no uploaded file, we have a problem...
        if (!is_array($userfile) ) {
            JError::raiseWarning('SOME_ERROR_CODE', JText::_('No file selected'));
            $this->setRedirect("index.php?option=com_jshopping&controller=update");
            return false;
        }

        // Check if there was a problem uploading the file.
        if ( $userfile['error'] || $userfile['size'] < 1 )
        {
            JError::raiseWarning('SOME_ERROR_CODE', JText::_('WARNINSTALLUPLOADERROR'));
            $this->setRedirect("index.php?option=com_jshopping&controller=update");
            return false;
        }

        // Build the appropriate paths
        $config =& JFactory::getConfig();
        $tmp_dest = $config->getValue('config.tmp_path').DS.$userfile['name'];
        $tmp_src = $userfile['tmp_name'];

        // Move uploaded file
        jimport('joomla.filesystem.file');
        $uploaded = JFile::upload($tmp_src, $tmp_dest);
        
        $archivename = $tmp_dest;
        
        // Temporary folder to extract the archive into
        $tmpdir = uniqid('install_');

        // Clean the paths to use for archive extraction
        $extractdir = JPath::clean(dirname($archivename).DS.$tmpdir);
        $archivename = JPath::clean($archivename);

        // do the unpacking of the archive
        $result = JArchive::extract( $archivename, $extractdir);

        if ( $result === false ) {
            JError::raiseWarning('500', "Error");
            $this->setRedirect("index.php?option=com_jshopping&controller=update");
            return false;
        }                        
                
        $this->copyFiles($extractdir);
		
        if (file_exists($extractdir."/update.sql")){
            $db = &JFactory::getDBO();
            $lines = file($extractdir."/update.sql");
            $fullline = implode(" ", $lines);
            $queryes = $db->splitSql($fullline);            
            foreach($queryes as $query){
                if (trim($query)!=''){
                    $db->setQuery($query);
                    $db->query();
                    if ($db->getErrorNum()) {
                        JError::raiseWarning( 500, $db->stderr() );
                        saveToLog("error.log", "Update - ".$db->stderr());
                    }
                }
            }            
        }
        
        if (file_exists($extractdir."/update.php")) include($extractdir."/update.php");
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onAfterUpdateShop', array($extractdir) );
                
        @unlink($archivename);
        
        $session =& JFactory::getSession();
        $checkedlanguage = array();
        $session->set("jshop_checked_language", $checkedlanguage);        
        
        $this->setRedirect("index.php?option=com_jshopping&controller=update", _JSHOP_COMPLETED);                        
    }
    
    function copyFiles($startdir, $subdir = ""){
        
        if ($subdir!="" && !file_exists(JPATH_ROOT.$subdir)){
            @mkdir(JPATH_ROOT.$subdir, 0755);
        }
        
        $files = JFolder::files($startdir.$subdir, '');
        foreach($files as $file){
        
            if ($subdir=="" && ($file == "update.sql" || $file == "update.php")){
                continue;
            }            
            
            if (@copy($startdir.$subdir."/".$file, JPATH_ROOT.$subdir."/".$file)){
                //JError::raiseWarning( 500, "Copy file: ".$subdir."/".$file." OK");
            }else{
                JError::raiseWarning( 500, "Copy file: ".$subdir."/".$file." ERROR");
                saveToLog("error.log", "Update - Copy file: ".$subdir."/".$file." ERROR");
            }
            
        }
        
        $folders = JFolder::folders($startdir.$subdir, '');
        foreach($folders as $folder){
            $dir = $subdir."/".$folder;            
            $this->copyFiles($startdir, $dir);
        }
    }
         
}
?>