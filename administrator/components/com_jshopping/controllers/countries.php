<?php
/**
* @version      2.9.4 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerCountries extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("other");
    }

    function display(){  	        		
        $mainframe =& JFactory::getApplication();
		$context = "jshoping.list.admin.countries";
        $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
        $limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
        $publish = $mainframe->getUserStateFromRequest( $context.'publish', 'publish', 0, 'int' );
		
		$countries = &$this->getModel("countries");
		$total = $countries->getCountAllCountries();
        
        $countries = &$this->getModel("countries");
        if ($publish == 0) {
            $total = $countries->getCountAllCountries();
        } else {
            $total = $countries->getCountPublishCountries($publish % 2);
        }
		
		jimport('joomla.html.pagination');
        $pageNav = new JPagination($total, $limitstart, $limit);
		$rows = $countries->getAllCountries($publish, $pageNav->limitstart,$pageNav->limit, 0);
        
        $f_option = array();
        $f_option[] = JHTML::_('select.option', 0, _JSHOP_ALL, 'id', 'name');
        $f_option[] = JHTML::_('select.option', 1, _JSHOP_PUBLISH, 'id', 'name');
        $f_option[] = JHTML::_('select.option', 2, _JSHOP_UNPUBLISH, 'id', 'name');
        
        $filter = JHTML::_('select.genericlist', $f_option, 'publish', 'onchange="document.adminForm.submit();"', 'id', 'name', $publish);
                
		$view=&$this->getView("countries_list", 'html');		
        $view->assign('rows', $rows); 
        $view->assign('pageNav', $pageNav);       
        $view->assign('filter', $filter);
		$view->display(); 
    }
    
   	function edit() {
		$country_id = JRequest::getInt("country_id");
		$countries = &$this->getModel("countries");
		$country = &JTable::getInstance('country', 'jshop');
		$country->load($country_id);
		$first[] = JHTML::_('select.option', '0',_JSHOP_ORDERING_FIRST,'ordering','name');
		$rows = array_merge($first, $countries->getAllCountries(0));
		$lists['order_countries'] = JHTML::_('select.genericlist', $rows,'ordering','class="inputbox" size="1"','ordering','name', $country->ordering);
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;        
        
		$edit = ($country_id)?($edit = 1):($edit = 0);                
        
        JFilterOutput::objectHTMLSafe( $country, ENT_QUOTES);

		$view=&$this->getView("countries_edit", 'html');		
        $view->assign('country', $country); 
        $view->assign('lists', $lists);       
        $view->assign('edit', $edit);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
		$view->display();
	}
	
	function save() {
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        
		$country_id = JRequest::getInt("country_id");		
	    $post = JRequest::get('post');
        
        $dispatcher->trigger( 'onBeforeSaveCountry', array(&$post) );
        
		$country = &JTable::getInstance('country', 'jshop');
		if (!$country->bind($post)) {
			JError::raiseWarning("",_JSHOP_ERROR_BIND);
			$this->setRedirect("index.php?option=com_jshopping&controller=countries");
			return 0;
		}
	
		if (!$country->country_publish){
			$country->country_publish = 0;
	    }    
		$this->_reorderCountry($country);
		if (!$country->store()) {
			JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
			$this->setRedirect("index.php?option=com_jshopping&controller=countries");
			return 0;
		}
                
        $dispatcher->trigger( 'onAfterSaveCountry', array(&$country) );
        
		if ($this->getTask()=='apply'){
            $this->setRedirect("index.php?option=com_jshopping&controller=countries&task=edit&country_id=".$country->country_id); 
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=countries");
        }
	}
	
	function _reorderCountry(&$country) {
		$db = &JFactory::getDBO();
		$query = "UPDATE `#__jshopping_countries` SET `ordering` = ordering + 1
					WHERE `ordering` > '" . $country->ordering . "'";
		$db->setQuery($query);
		$db->query();
		$country->ordering++;
	}
	
	function order(){
		$order = JRequest::getVar("order"); 
		$cid = JRequest::getInt("id");
		$number = JRequest::getInt("number");
		$db = &JFactory::getDBO();
		
		switch ($order) {
			case 'up':
				$query = "SELECT a.country_id, a.ordering
					   FROM `#__jshopping_countries` AS a
					   WHERE a.ordering < '" . $number . "'
					   ORDER BY a.ordering DESC
					   LIMIT 1";
				break;
			case 'down':
				$query = "SELECT a.country_id, a.ordering
					   FROM `#__jshopping_countries` AS a
					   WHERE a.ordering > '" . $number . "'
					   ORDER BY a.ordering ASC
					   LIMIT 1";
		}
	
		$db->setQuery($query);
		$row = $db->loadObject();
	
	
		$query1 = "UPDATE `#__jshopping_countries` AS a
					 SET a.ordering = '" . $row->ordering . "'
					 WHERE a.country_id = '" . $cid . "'";
		$query2 = "UPDATE `#__jshopping_countries` AS a
					 SET a.ordering = '" . $number . "'
					 WHERE a.country_id = '" . $row->country_id . "'";
		$db->setQuery($query1);
		$db->query();
		$db->setQuery($query2);
		$db->query();
		
		$this->setRedirect("index.php?option=com_jshopping&controller=countries");
	}
	
	function remove() {
		$db = &JFactory::getDBO();
		$query = '';
		$text = '';
		$cid = JRequest::getVar("cid");
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeRemoveCountry', array(&$cid) );
        
		foreach ($cid as $key => $value) {
			$query = "DELETE FROM `#__jshopping_countries`
					   WHERE `country_id` = '" . $db->getEscaped($value) . "'";
			$db->setQuery($query);
			if ($db->query())
				$text .= _JSHOP_COUNTRY_DELETED."<br>";
			else
				$text .= _JSHOP_COUNTRY_ERROR_DELETED."<br>";	
		}
        
        $dispatcher->trigger( 'onAfterRemoveCountry', array(&$cid) );

		$this->setRedirect("index.php?option=com_jshopping&controller=countries", $text);
	}
	
    function publish(){
        $this->publishCountry(1);
    }
    
    function unpublish(){
        $this->publishCountry(0);
    }
    
	function publishCountry($flag) {
		$cid = JRequest::getVar("cid");
		$db = &JFactory::getDBO();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforePublishCountry', array(&$cid, &$flag) );
        
		foreach ($cid as $key => $value) {
			$query = "UPDATE `#__jshopping_countries` SET `country_publish` = '".$db->getEscaped($flag)."' WHERE `country_id` = '" . $db->getEscaped($value) . "'";
			$db->setQuery($query);
			$db->query();
		}
                
        $dispatcher->trigger( 'onAfterPublishCountry', array(&$cid, &$flag) );
		
		$this->setRedirect("index.php?option=com_jshopping&controller=countries");
	}
    
    function saveorder(){
        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        $order = JRequest::getVar( 'order', array(), 'post', 'array' );
        
        foreach ($cid as $k=>$id){
            $country = &JTable::getInstance('country', 'jshop');
            $country->load($id);
            if ($country->ordering!=$order[$k]){
                $country->ordering = $order[$k];
                $country->store();
            }        
        }
        
        $country = &JTable::getInstance('country', 'jshop');
        $country->reorder();        
                
        $this->setRedirect("index.php?option=com_jshopping&controller=countries");
    }
    
       
}

?>