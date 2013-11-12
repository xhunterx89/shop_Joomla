<?php
/**
* @version      3.2.4 06.08.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerUsers extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("users");
    }

    function display(){       
        $mainframe =& JFactory::getApplication();
                
        $context = "jshopping.list.admin.users";
        $limit = $mainframe->getUserStateFromRequest( $context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
        $limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );
        $text_search = $mainframe->getUserStateFromRequest( $context.'text_search', 'text_search', '' );
        
        $users = &$this->getModel("users");
        
        $total = $users->getCountAllUsers($text_search);
        
        jimport('joomla.html.pagination');
        $pageNav = new JPagination($total, $limitstart, $limit);        
        $rows = $users->getAllUsers($pageNav->limitstart, $pageNav->limit, $text_search);
        
        $view=&$this->getView("users_list", 'html');        
        $view->assign('rows', $rows);        
        $view->assign('pageNav', $pageNav);
        $view->assign('text_search', $text_search);         
        $view->display();
    }
    
    function edit() {
        
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        $me = & JFactory::getUser();  
        $user_id = JRequest::getInt("user_id");
        $user = &JTable::getInstance('userShop', 'jshop');
        $user->load($user_id);
        
        $user_site = new JUser($user_id);

        $_countries = &$this->getModel("countries");
        $countries = $_countries->getAllCountries(0);
        $lists['country'] = JHTML::_('select.genericlist', $countries,'country','class = "inputbox" size = "1"','country_id','name', $user->country);
        $lists['d_country'] = JHTML::_('select.genericlist', $countries,'d_country','class = "inputbox endes" size = "1"','country_id','name', $user->d_country); 
        
        foreach ($jshopConfig->arr['title'] as $key => $value) {        
            $option_title[] = JHTML::_('select.option', $key, $value, 'title_id', 'title_name' );    
        }    
        $lists['select_titles'] = JHTML::_('select.genericlist', $option_title,'title','class = "inputbox"','title_id','title_name', $user->title );
        $lists['select_d_titles'] = JHTML::_('select.genericlist', $option_title,'d_title','class = "inputbox endes"','title_id','title_name', $user->d_title );
        
        $client_types = array();
        foreach ($jshopConfig->user_field_client_type as $key => $value) {        
            $client_types[] = JHTML::_('select.option', $key, $value, 'id', 'name' );
        }
        $lists['select_client_types'] = JHTML::_('select.genericlist', $client_types,'client_type','class = "inputbox" ','id','name', $user->client_type);

        $_usergroups = &$this->getModel("userGroups");
        $usergroups = $_usergroups->getAllUsergroups();
        $lists['usergroups'] = JHTML::_('select.genericlist', $usergroups, 'usergroup_id', 'class = "inputbox" size = "1"', 'usergroup_id', 'usergroup_name', $user->usergroup_id);
        
        $lists['block']      = JHTML::_('select.booleanlist',  'block', 'class="inputbox" size="1"', $user_site->get('block') );  
        
        filterHTMLSafe($user, ENT_QUOTES);
        
        $tmp_fields = $jshopConfig->getListFieldsRegister();
        $config_fields = $tmp_fields['editaccount'];
        $count_filed_delivery = 0;
        foreach($config_fields as $k=>$v){
            if (substr($k, 0, 2)=="d_" && $v['display']==1) $count_filed_delivery++;
        }
        
        $view=&$this->getView("users_edit", 'html');        
        $view->assign('user', $user);  
        $view->assign('me', $me);       
        $view->assign('user_site', $user_site);        
        $view->assign('lists', $lists);
        $view->assign('config_fields', $config_fields);
        $view->assign('count_filed_delivery', $count_filed_delivery);        
        $view->display();
        
    }
    
    function save() {
        $apply = JRequest::getVar("apply");        
        JSFactory::loadLanguageFile();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        
        $user_shop = &JTable::getInstance('userShop', 'jshop');
        $user_id = JRequest::getInt("user_id");
        $user_shop->load($user_id);
        $post = JRequest::get("post");
        
        $dispatcher->trigger( 'onBeforeSaveUser', array(&$post) );
        
        $user_shop->bind($post);
        $user_shop->password = JRequest::getVar('password');
        $user_shop->password2 = JRequest::getVar('password2');
        
        if (!$user_shop->check("editaccount.edituser")){            
            JError::raiseWarning("", $user_shop->getError());
            $this->setRedirect("index.php?option=com_jshopping&controller=users&task=edit&user_id=".$user_shop->user_id);
            return 0;
        }
        
        unset($user_shop->password);
        unset($user_shop->password2);
        if (!$user_shop->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=users&task=edit&user_id=".$user_shop->user_id);
            return 0;
        }
        
        $user = new JUser($user_id);
        $data['email']      = JRequest::getVar("email");
        $data['password']   = JRequest::getVar("password");
        $data['password2']  = JRequest::getVar("password2");
        $data['name']       = JRequest::getVar("f_name");
        $data['username']   = JRequest::getVar("u_name");
        $data['block']      = JRequest::getVar("block");
        
        $user->bind($data);
        $user->save(true);
        

        $dispatcher->trigger( 'onAfterSaveUser', array(&$user, &$user_shop) );
        
        if ($this->getTask()=='apply'){        
            $this->setRedirect("index.php?option=com_jshopping&controller=users&task=edit&user_id=".$user_shop->user_id);
        }else{
            $this->setRedirect("index.php?option=com_jshopping&controller=users");
        }
    }
    
    function remove(){
        $mainframe =& JFactory::getApplication();
        $cid = JRequest::getVar( 'cid', array(), '', 'array' );        
        $me  = & JFactory::getUser();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
          
        if ($me->authorize( 'com_users', 'block user' )) { 
            $dispatcher->trigger( 'onBeforeRemoveUser', array(&$cid) );
            foreach ($cid as $id){
                if ($me->get( 'id' )==(int)$id) {
                    JError::raiseWarning("", JText::_( 'You cannot delete Yourself!' ));
                    continue;
                }
                $user =& JUser::getInstance((int)$id);
                $user->delete();
                $mainframe->logout((int)$id);
                 
                $user_shop = &JTable::getInstance('userShop', 'jshop');
                $user_shop->delete((int)$id); 
            }            
            $dispatcher->trigger( 'onAfterRemoveUser', array(&$cid) );
        }
        $this->setRedirect("index.php?option=com_jshopping&controller=users");
    }    
    
}
?>