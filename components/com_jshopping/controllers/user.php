<?php
/**
* @version      3.2.0 28.06.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerUser extends JController{
    
    function display(){
        $this->myaccount();
    }
    
        function login(){
        $jshopConfig = &JSFactory::getConfig();
        $session =& JFactory::getSession();
        $mainframe =& JFactory::getApplication();
        $params = $mainframe->getParams();
        
        $user = &JFactory::getUser();
        if ($user->id){            
            $view_name = "user";
            $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
            $view = &$this->getView($view_name, 'html', '', $view_config);
            $view->setLayout("logout");            
            $view->display();
            return 0;
        }
   
        if (JRequest::getVar('return')){
            $return = JRequest::getVar('return');
        }else{
            $return = $session->get('return');
        }
        
        $show_pay_without_reg = $session->get("show_pay_without_reg");
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("login");
        if (getThisURLMainPageShop()){            
            appendPathWay(_JSHOP_LOGIN);
            if ($seodata->title==""){
                $seodata->title = _JSHOP_LOGIN;
            }
        }else{
            if ($seodata->title==""){
                $seodata->title = $params->get('page_title');
            }
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        //for login-registration template
        $country = &JTable::getInstance('country', 'jshop');        
        $option_country[] = JHTML::_('select.option',  '0', _JSHOP_REG_SELECT, 'country_id', 'name' );    
        $select_countries = JHTML::_('select.genericlist', array_merge($option_country, jshopCountry::getAllCountries()),'country','id = "country" class = "inputbox" size = "1"','country_id','name' );
        foreach ($jshopConfig->arr['title'] as $key => $value) {        
            $option_title[] = JHTML::_('select.option', $key, $value, 'title_id', 'title_name' );    
        }
        $select_titles = JHTML::_('select.genericlist', $option_title,'title','class = "inputbox"','title_id','title_name' );
        
        $client_types = array();
        foreach ($jshopConfig->user_field_client_type as $key => $value) {        
            $client_types[] = JHTML::_('select.option', $key, $value, 'id', 'name' );
        }
        $select_client_types = JHTML::_('select.genericlist', $client_types,'client_type','class = "inputbox" onchange="showHideFieldFirm(this.value)"','id','name');
        
        $tmp_fields = $jshopConfig->getListFieldsRegister();
        $config_fields = $tmp_fields['register'];
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayLogin', array() );

        $view_name = "user";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("login");
        $view->assign('href_register', SEFLink('index.php?option=com_jshopping&controller=user&task=register',0,0, $jshopConfig->use_ssl));
        $view->assign('href_lost_pass', SEFLInk('index.php?option=com_users&view=reset',0,0, $jshopConfig->use_ssl));
        $view->assign('return', $return);
        $view->assign('validate', $validate = JUtility::getToken());
        $view->assign('Itemid', JRequest::getVar('Itemid'));
        $view->assign('config', $jshopConfig);
        $view->assign('show_pay_without_reg', $show_pay_without_reg);
        $view->assign('select_client_types', $select_client_types);
        $view->assign('select_titles', $select_titles);
        $view->assign('select_countries', $select_countries);
        $view->assign('config_fields', $config_fields);
        $view->assign('live_path', JURI::base());
        $view->assign('urlcheckdata', SEFLink("index.php?option=com_jshopping&controller=user&task=check_user_exist_ajax&ajax=1", 0, 1, $jshopConfig->use_ssl));
        $view->display();
    }
    
    function loginsave(){
        $mainframe =& JFactory::getApplication();
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        
        // Check for request forgeries
        JRequest::checkToken('request') or jexit( 'Invalid Token' );
       
        if ($return = JRequest::getVar('return', '', 'method', 'base64')) {
            $return = base64_decode($return);
            if (!JURI::isInternal($return)) {
                $return = '';
            }
        }

        $options = array();
        $options['remember'] = JRequest::getBool('remember', false);
        $options['return'] = $return;

        $credentials = array();
        $credentials['username'] = JRequest::getVar('username', '', 'method', 'username');
        $credentials['password'] = JRequest::getString('passwd', '', 'post', JREQUEST_ALLOWRAW);
        
        $dispatcher->trigger( 'onBeforeLogin', array(&$options, &$credentials) );
        
        //preform the login action
        $error = $mainframe->login($credentials, $options);
        
        setNextUpdatePrices();

        if (!JError::isError($error)){
            // Redirect if the return url is not registration or login
            if ( ! $return ) {
                $return = JURI::base();
            }                        
            $dispatcher->trigger( 'onAfterLogin', array() );            
            $mainframe->redirect( $return );
        }else{
            $dispatcher->trigger( 'onAfterLoginEror', array() );
            // Redirect to a login form
            $mainframe->redirect( SEFLink('index.php?option=com_jshopping&controller=user&task=login&return='.base64_encode($return),0,1,$jshopConfig->use_ssl) );
        }
    }
    
    function check_user_exist_ajax() {
        $mes = array();
        $username = JRequest::getVar("username");
        $email = JRequest::getVar("email");
        $db = &JFactory::getDBO(); 
        $query = "SELECT id FROM `#__users` WHERE username = '" . $db->getEscaped($username) . "'";
        $db->setQuery($query);
        $db->query();
        if ($db->getNumRows()){ 
            $mes[] = sprintf(_JSHOP_USER_EXIST, $username);
        }
        
        $query = "SELECT id FROM `#__users` WHERE email = '" . $db->getEscaped($email) . "'";
        $db->setQuery($query);
        $db->query();
        if ($db->getNumRows()){ 
            $mes[] = sprintf(_JSHOP_USER_EXIST_EMAIL, $email);
        }
        
        if (count($mes)==0){
            print "1";
        }else{
            print implode("\n",$mes);
        }
        die();
    }
    
    function register(){

        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO(); 
        $mainframe =& JFactory::getApplication();
        $params = $mainframe->getParams();
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("register");
        if (getThisURLMainPageShop()){            
            appendPathWay(_JSHOP_REGISTRATION);
            if ($seodata->title==""){
                $seodata->title = _JSHOP_REGISTRATION;
            }
        }else{
            if ($seodata->title==""){
                $seodata->title = $params->get('page_title');
            }
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        // If user registration is not allowed, show 403 not authorized.
        $usersConfig = &JComponentHelper::getParams( 'com_users' );
        if ($usersConfig->get('allowUserRegistration') == '0') {
            JError::raiseError( 403, JText::_( 'Access Forbidden' ));
            return;
        }        
        
        $country = &JTable::getInstance('country', 'jshop');        
        $option_country[] = JHTML::_('select.option',  '0', _JSHOP_REG_SELECT, 'country_id', 'name' );    
        $select_countries = JHTML::_('select.genericlist', array_merge($option_country, jshopCountry::getAllCountries()),'country','id = "country" class = "inputbox" size = "1"','country_id','name', $jshopConfig->default_country );
        foreach ($jshopConfig->arr['title'] as $key => $value) {        
            $option_title[] = JHTML::_('select.option', $key, $value, 'title_id', 'title_name' );    
        }
        $select_titles = JHTML::_('select.genericlist', $option_title,'title','class = "inputbox"','title_id','title_name' );
        
        $client_types = array();
        foreach ($jshopConfig->user_field_client_type as $key => $value) {        
            $client_types[] = JHTML::_('select.option', $key, $value, 'id', 'name' );
        }
        $select_client_types = JHTML::_('select.genericlist', $client_types,'client_type','class = "inputbox" onchange="showHideFieldFirm(this.value)"','id','name');
        
        $tmp_fields = $jshopConfig->getListFieldsRegister();
        $config_fields = $tmp_fields['register'];
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayRegister', array() );
        
        $view_name = "user";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("register");
           
        $view->assign('select_client_types', $select_client_types);
        $view->assign('select_titles', $select_titles);
        $view->assign('select_countries', $select_countries);
        $view->assign('config_fields', $config_fields);
        $view->assign('live_path', JURI::base());        
        $view->assign('urlcheckdata', SEFLink("index.php?option=com_jshopping&controller=user&task=check_user_exist_ajax&ajax=1",0,1));
        $view->assign('validate', JUtility::getToken());
        $view->display();
    }
    
    function registersave(){
        // Check for request forgeries
        JRequest::checkToken() or jexit( 'Invalid Token' );
        
        $mainframe = JFactory::getApplication();
        $jshopConfig = JSFactory::getConfig();
        $config = JFactory::getConfig();
        $db = JFactory::getDBO();
        $params = JComponentHelper::getParams('com_users');
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        
        // If user registration is not allowed, show 403 not authorized.
        if ($params->get('allowUserRegistration') == '0') {
            JError::raiseError( 403, JText::_( 'Access Forbidden' ));
            return;
        }
        
        $usergroup = &JTable::getInstance('usergroup', 'jshop');
        $default_usergroup = jshopUsergroup::getDefaultUsergroup();
        // Get the constants from com_user
        $lang = & JFactory::getLanguage();
        $lang->load( 'com_users' );
        // End Get constants from com_user        
        
        $_POST['username'] = JRequest::getVar('u_name');
        $_POST['password2'] = JRequest::getVar('password_2');
        $_POST['name'] = JRequest::getVar('f_name');
        
        $dispatcher->trigger( 'onBeforeRegister', array(&$_POST) );
        
        $row = &JTable::getInstance('userShop', 'jshop');                
        $row->bind(JRequest::get('post'));
        $row->usergroup_id = $default_usergroup;
        $row->password = JRequest::getVar('password');
        $row->password2 = JRequest::getVar('password_2');
        
        if (!$row->check("register")) {
            JError::raiseWarning('', $row->getError());
            $this->setRedirect(SEFLink("index.php?option=com_jshopping&controller=user&task=register",0,1, $jshopConfig->use_ssl));
            return 0;
        }
        
        $user = new JUser;
        // Prepare the data for the user object.
        $data = array();
        $data['groups'][] = $params->get('new_usertype', 2);
        $data['email']        = JRequest::getVar("email");
        $data['password']    = JRequest::getVar("password");
        $data['password2']    = JRequest::getVar("password_2");
        $data['name']    = JRequest::getVar("f_name");
        $data['username']    = JRequest::getVar("u_name");
        $useractivation = $params->get('useractivation');

        // Check if the user needs to activate their account.
        if (($useractivation == 1) || ($useractivation == 2)) {
            jimport('joomla.user.helper');
            $data['activation'] = JUtility::getHash(JUserHelper::genRandomPassword());
            $data['block'] = 1;
        }
        $user->bind($data);
        $user->save();
        
        $row->user_id = $user->id;
        unset($row->password);
        unset($row->password2);
        if (!$db->insertObject($row->getTableName(), $row, $row->getKeyName())){
            JError::raiseWarning('', "Error insert in table ".$row->getTableName());
            $this->setRedirect(SEFLink("index.php?option=com_jshopping&controller=user&task=register",0,1,$jshopConfig->use_ssl));
            return 0;
        }
        
        // Compile the notification mail values.
        $data = $user->getProperties();
        $data['fromname']    = $config->get('fromname');
        $data['mailfrom']    = $config->get('mailfrom');
        $data['sitename']    = $config->get('sitename');
        $data['siteurl']    = JUri::base();
        
                // Handle account activation/confirmation emails.
        if ($useractivation == 2)
        {
            // Set the link to confirm the user email.
            $uri = JURI::getInstance();
            $base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
            $data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);

            $emailSubject    = JText::sprintf(
                'COM_USERS_EMAIL_ACCOUNT_DETAILS',
                $data['name'],
                $data['sitename']
            );

            $emailBody = JText::sprintf(
                'COM_USERS_EMAIL_REGISTERED_WITH_ADMIN_ACTIVATION_BODY',
                $data['name'],
                $data['sitename'],
                $data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
                $data['siteurl'],
                $data['username'],
                $data['password_clear']
            );
        }
        else if ($useractivation == 1)
        {
            // Set the link to activate the user account.
            $uri = JURI::getInstance();
            $base = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port'));
            $data['activate'] = $base.JRoute::_('index.php?option=com_users&task=registration.activate&token='.$data['activation'], false);

            $emailSubject    = JText::sprintf(
                'COM_USERS_EMAIL_ACCOUNT_DETAILS',
                $data['name'],
                $data['sitename']
            );

            $emailBody = JText::sprintf(
                'COM_USERS_EMAIL_REGISTERED_WITH_ACTIVATION_BODY',
                $data['name'],
                $data['sitename'],
                $data['siteurl'].'index.php?option=com_users&task=registration.activate&token='.$data['activation'],
                $data['siteurl'],
                $data['username'],
                $data['password_clear']
            );
        } else {

            $emailSubject    = JText::sprintf(
                'COM_USERS_EMAIL_ACCOUNT_DETAILS',
                $data['name'],
                $data['sitename']
            );

            $emailBody = JText::sprintf(
                'COM_USERS_EMAIL_REGISTERED_BODY',
                $data['name'],
                $data['sitename'],
                $data['siteurl']
            );
        }

        // Send the registration email.
        $return = JUtility::sendMail($data['mailfrom'], $data['fromname'], $data['email'], $emailSubject, $emailBody);

        // Check for an error.
        if ($return !== true) {
            $this->setError(JText::_('COM_USERS_REGISTRATION_SEND_MAIL_FAILED'));

            // Send a system message to administrators receiving system mails
            $db = JFactory::getDBO();
            $q = "SELECT id
                FROM #__users
                WHERE block = 0
                AND sendEmail = 1";
            $db->setQuery($q);
            $sendEmail = $db->loadResultArray();
            if (count($sendEmail) > 0) {
                $jdate = new JDate();
                // Build the query to add the messages
                $q = "INSERT INTO `#__messages` (`user_id_from`, `user_id_to`, `date_time`, `subject`, `message`)
                    VALUES ";
                $messages = array();
                foreach ($sendEmail as $userid) {
                    $messages[] = "(".$userid.", ".$userid.", '".$jdate->toMySQL()."', '".JText::_('COM_USERS_MAIL_SEND_FAILURE_SUBJECT')."', '".JText::sprintf('COM_USERS_MAIL_SEND_FAILURE_BODY', $return, $data['username'])."')";
                }
                $q .= implode(',', $messages);
                $db->setQuery($q);
                $db->query();
            }
            return false;
        }
        
        $dispatcher->trigger( 'onAfterRegister', array(&$user, &$row, &$_POST, &$useractivation) );
                
        if ( $useractivation == 2 ){
            $message  = JText::_('COM_USERS_REGISTRATION_COMPLETE_VERIFY');
            $return = SEFLink("index.php?option=com_jshopping&controller=user&task=login",0,1,$jshopConfig->use_ssl);
        } elseif ( $useractivation == 1 ){
            $message  = JText::_('COM_USERS_REGISTRATION_COMPLETE_ACTIVATE');
            $return = SEFLink("index.php?option=com_jshopping&controller=user&task=login",0,1,$jshopConfig->use_ssl);
        } else {
            $message = JText::_('COM_USERS_REGISTRATION_SAVE_SUCCESS');
            $return = SEFLink("index.php?option=com_jshopping&controller=user&task=login",0,1,$jshopConfig->use_ssl);
        }
        
        $this->setRedirect($return, $message);
    }
    
    function editaccount(){
    
        checkUserLogin();
        $user = &JFactory::getUser();
        $adv_user = &JSFactory::getUserShop();
        $jshopConfig = &JSFactory::getConfig();
        $mainframe =& JFactory::getApplication();
        $params = $mainframe->getParams();
            
        appendPathWay(_JSHOP_EDIT_DATA);        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("editaccount");
        if ($seodata->title==""){
            $seodata->title = _JSHOP_EDIT_DATA;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);    
        
        if (!$adv_user->country) $adv_user->country = $jshopConfig->default_country;
        if (!$adv_user->d_country) $adv_user->d_country = $jshopConfig->default_country;
        
        $country = &JTable::getInstance('country', 'jshop');
        $option_country[] = JHTML::_('select.option', 0, _JSHOP_REG_SELECT, 'country_id', 'name' );
        $option_countryes = array_merge($option_country,jshopCountry::getAllCountries());    
        $select_countries = JHTML::_('select.genericlist', $option_countryes,'country','class = "inputbox" size = "1"','country_id', 'name',$adv_user->country );
        $select_d_countries = JHTML::_('select.genericlist', $option_countryes,'d_country','class = "inputbox" size = "1"','country_id', 'name',$adv_user->d_country );

        foreach ($jshopConfig->arr['title'] as $key => $value) {        
            $option_title[] = JHTML::_('select.option', $key, $value, 'title_id', 'title_name' );    
        }    
        $select_titles = JHTML::_('select.genericlist', $option_title,'title','class = "inputbox"','title_id','title_name',$adv_user->title );
        $select_d_titles = JHTML::_('select.genericlist', $option_title,'d_title','class = "inputbox"','title_id','title_name',$adv_user->d_title );
        
        $client_types = array();
        foreach ($jshopConfig->user_field_client_type as $key => $value) {        
            $client_types[] = JHTML::_('select.option', $key, $value, 'id', 'name' );
        }
        $select_client_types = JHTML::_('select.genericlist', $client_types,'client_type','class = "inputbox" onchange="showHideFieldFirm(this.value)"','id','name', $adv_user->client_type);
                
        $tmp_fields = $jshopConfig->getListFieldsRegister();
        $config_fields = $tmp_fields['editaccount'];
        $count_filed_delivery = 0;
        foreach($config_fields as $k=>$v){
            if (substr($k, 0, 2)=="d_" && $v['display']==1) $count_filed_delivery++;
        }
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayEditUser', array(&$adv_user) );
        
        filterHTMLSafe( $adv_user, ENT_QUOTES);        
        
        $view_name = "user";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("editaccount");
                
        $view->assign('select_countries',$select_countries);
        $view->assign('select_d_countries',$select_d_countries);
        $view->assign('select_titles',$select_titles);
        $view->assign('select_d_titles',$select_d_titles);
        $view->assign('select_client_types', $select_client_types);
        $view->assign('live_path', JURI::base());
        $view->assign('user', $adv_user);
        $view->assign('delivery_adress', $adv_user->delivery_adress);
        $view->assign('action', SEFLink('index.php?option=com_jshopping&controller=user&task=accountsave',0,0,$jshopConfig->use_ssl));
        $view->assign('config_fields', $config_fields);
        $view->assign('count_filed_delivery', $count_filed_delivery);
        $view->display();
    }
    
    function accountsave(){
        checkUserLogin();
        $user = JFactory::getUser();
        $db = JFactory::getDBO();
        $app = JFactory::getApplication();
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $jshopConfig = &JSFactory::getConfig();
        
        $user_shop = &JTable::getInstance('userShop', 'jshop');        
        $post = JRequest::get('post');
        
        $dispatcher->trigger( 'onBeforeAccountSave', array(&$post) );
        
        unset($post['user_id']);
        unset($post['usergroup_id']);
        $user_shop->load($user->id);
        $user_shop->bind($post);
        
        if (!$user_shop->check("editaccount")) {
            JError::raiseWarning('',$user_shop->getError());
            $this->setRedirect(SEFLink("index.php?option=com_jshopping&controller=user&task=editaccount",0,1,$jshopConfig->use_ssl));
            return 0;
        }
        
        if (!$user_shop->store()) {
            JError::raiseWarning(500,_JSHOP_REGWARN_ERROR_DATABASE);
            $this->setRedirect(SEFLink("index.php?option=com_jshopping&controller=user&task=editaccount",0,1,$jshopConfig->use_ssl));
            return 0;
        }
        
        $user = new JUser($user->id);        
        $user->email = $user_shop->email;
        $user->save();
        
        $data = array();
        $data['email'] = $user->email;
        $app->setUserState('com_users.edit.profile.data', $data);
        
        setNextUpdatePrices();
        
        $dispatcher->trigger( 'onAfterAccountSave', array() );
                
        $this->setRedirect(SEFLink("index.php?option=com_jshopping&controller=user&task=myaccount",0,1,$jshopConfig->use_ssl), _JSHOP_ACCOUNT_UPDATE);
    }
    
    function orders(){
        $jshopConfig = &JSFactory::getConfig();
        checkUserLogin();
        $user = &JFactory::getUser();
        $order = &JTable::getInstance('order', 'jshop');
        
        appendPathWay(_JSHOP_MY_ORDERS);
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("myorders");
        if ($seodata->title==""){
            $seodata->title = _JSHOP_MY_ORDERS;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        $orders = jshopOrder::getOrdersForUser($user->id);
        foreach ($orders as $key => $value) {
            $orders[$key]->order_href = SEFLink('index.php?option=com_jshopping&controller=user&task=order&order_id=' . $value->order_id,0,0,$jshopConfig->use_ssl);
        }
        
        JPluginHelper::importPlugin('jshoppingorder');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayListOrder', array(&$orders) );
        
        $view_name = "order";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("listorder");
        $view->assign('orders', $orders);
        $view->assign('image_path', $jshopConfig->live_path."images");
        $view->display();
    }
    
    function order(){
        $jshopConfig = &JSFactory::getConfig();
        checkUserLogin();
        $db = &JFactory::getDBO(); 
        $user = &JFactory::getUser();
        $lang = &JSFactory::getLang();
        
        appendPathWay(_JSHOP_MY_ORDERS, SEFLink('index.php?option=com_jshopping&controller=user&task=orders',0,0,$jshopConfig->use_ssl));
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("myorder-detail");
        if ($seodata->title==""){
            $seodata->title = _JSHOP_MY_ORDERS;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        $order_id = JRequest::getInt('order_id');
        
        $order = &JTable::getInstance('order', 'jshop');        
        $order->load($order_id);
        
        appendPathWay(_JSHOP_ORDER_NUMBER.": ".$order->order_number);
        
        if ($user->id!=$order->user_id){
            JError::raiseError( 500, "Error order number");    
        }
        
        $order->items = $order->getAllItems();
        $order->weight = $order->getWeightItems();
        $order->status_name = $order->getStatus();
        $order->history = $order->getHistory();
        if ($jshopConfig->client_allow_cancel_order && $order->order_status!=$jshopConfig->payment_status_for_cancel_client){
            $allow_cancel = 1;
        }else{
            $allow_cancel = 0;
        }
        
        $shipping_method =&JTable::getInstance('shippingMethod', 'jshop');
        $shipping_method->load($order->shipping_method_id);
        
        $name = $lang->get("name");
        $description = $lang->get("description");
        $order->shipping_info = $shipping_method->$name;
        
        $pm_method = &JTable::getInstance('paymentMethod', 'jshop');
        $pm_method->load($order->payment_method_id);
        $order->payment_name = $pm_method->$name;
        if ($pm_method->show_descr_in_email) $order->payment_description = $pm_method->$description;  else $order->payment_description = "";
        
        $country = &JTable::getInstance('country', 'jshop');
        $country->load($order->country);
        $field_country_name = $lang->get("name");
        $order->country = $country->$field_country_name;
        
        $d_country = &JTable::getInstance('country', 'jshop');
        $d_country->load($order->d_country);
        $field_country_name = $lang->get("name");
        $order->d_country = $d_country->$field_country_name;
        
        $jshopConfig->user_field_client_type[0]="";
        $order->client_type_name = $jshopConfig->user_field_client_type[$order->client_type];
        
        $order->order_tax_list = $order->getTaxExt();
        $show_percent_tax = 0;        
        if (count($order->order_tax_list)>1 || $jshopConfig->show_tax_in_product) $show_percent_tax = 1;
        if ($jshopConfig->hide_tax) $show_percent_tax = 0;
        $hide_subtotal = 0;
        if (($jshopConfig->hide_tax || count($order->order_tax_list)==0) && $order->order_discount==0 && $order->order_payment==0 && $jshopConfig->without_shipping) $hide_subtotal = 1;
        
        $text_total = _JSHOP_ENDTOTAL;
        if (($jshopConfig->show_tax_in_product || $jshopConfig->show_tax_product_in_cart) && (count($order->order_tax_list)>0)){
            $text_total = _JSHOP_ENDTOTAL_INKL_TAX;
        }
        
        $tmp_fields = $jshopConfig->getListFieldsRegister();
        $config_fields = $tmp_fields["address"];
        $count_filed_delivery = 0;
        foreach($config_fields as $k=>$v){
            if (substr($k, 0, 2)=="d_" && $v['display']==1) $count_filed_delivery++;
        }
        
        JPluginHelper::importPlugin('jshoppingorder');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayOrder', array(&$order) );

        $view_name = "order";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("order");
        $view->assign('order', $order);
        $view->assign('config', $jshopConfig);
        $view->assign('text_total', $text_total);
        $view->assign('show_percent_tax', $show_percent_tax);
        $view->assign('hide_subtotal', $hide_subtotal);
        $view->assign('image_path', $jshopConfig->live_path . "images");
        $view->assign('config_fields', $config_fields);
        $view->assign('count_filed_delivery', $count_filed_delivery);
        $view->assign('allow_cancel', $allow_cancel);
        $view->display();
        
    }
    
    function cancelorder(){
        $jshopConfig = &JSFactory::getConfig();
        checkUserLogin();
        $db = &JFactory::getDBO(); 
        $user = &JFactory::getUser();
        $lang = &JSFactory::getLang();
        $mainframe =& JFactory::getApplication();
        
        if (!$jshopConfig->client_allow_cancel_order) return 0;
        
        $order_id = JRequest::getInt('order_id');
        
        $order = &JTable::getInstance('order', 'jshop');        
        $order->load($order_id);
        
        appendPathWay(_JSHOP_ORDER_NUMBER.": ".$order->order_number);
        
        if ($user->id!=$order->user_id){
            JError::raiseError( 500, "Error order number");    
        }
        $status = $jshopConfig->payment_status_for_cancel_client;
        
        if ($order->order_status==$status || in_array($order->order_status, $jshopConfig->payment_status_disable_cancel_client)){
            $this->setRedirect(SEFLink("index.php?option=com_jshopping&controller=user&task=order&order_id=".$order_id,0,1,$jshopConfig->use_ssl));
            return 0;
        }
        
        $order->order_status = $status;
        $order->store();
        
        $vendorinfo = $order->getVendorInfo();
        
        $order_status = &JTable::getInstance('orderStatus', 'jshop');
        $order_status->load($status);
        
        if (in_array($status, $jshopConfig->payment_status_return_product_in_stock)){
            $order->changeProductQTYinStock("+");
        }
        
        $order_history = &JTable::getInstance('orderHistory', 'jshop');
        $order_history->order_id = $order->order_id;
        $order_history->order_status_id = $status;
        $order_history->status_date_added = date("Y-m-d H:i:s");
        $order_history->customer_notify = 1;
        $order_history->comments  = $restext;
        $order_history->store();
        
        $name = $lang->get("name");
        
        $view_name = "order";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("statusorder");
        $view->assign('order', $order);
        $view->assign('order_status', $order_status->$name);
        $view->assign('vendorinfo', $vendorinfo);
        $message = $view->loadTemplate();
         
        $mailfrom = $mainframe->getCfg( 'mailfrom' );
        $fromname = $mainframe->getCfg( 'fromname' );
        JUtility::sendMail($mailfrom, $fromname, $jshopConfig->contact_email, _JSHOP_ORDER_STATUS_CHANGE_TITLE, $message);
        $subject = sprintf(_JSHOP_ORDER_STATUS_CHANGE_SUBJECT, $order->order_number);
        JUtility::sendMail($mailfrom, $fromname, $order->email, $subject, $message);
        
        JPluginHelper::importPlugin('jshoppingorder');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onAfterUserCancelOrder', array(&$order_id) );
        
        $this->setRedirect(SEFLink("index.php?option=com_jshopping&controller=user&task=order&order_id=".$order_id,0,1,$jshopConfig->use_ssl), _JSHOP_ORDER_CANCELED);
    }
    
    function myaccount(){
        $jshopConfig = &JSFactory::getConfig();
        checkUserLogin();
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("myaccount");
        if ($seodata->title==""){
            $seodata->title = _JSHOP_MY_ACCOUNT;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeDisplayMyAccount', array() );

        $view_name = "user";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/".$jshopConfig->template."/".$view_name);
        $view = &$this->getView($view_name, 'html', '', $view_config);
        $view->setLayout("myaccount");
        $view->assign('href_edit_data', SEFLink('index.php?option=com_jshopping&controller=user&task=editaccount',0,0,$jshopConfig->use_ssl));
        $view->assign('href_show_orders', SEFLink('index.php?option=com_jshopping&controller=user&task=orders',0,0,$jshopConfig->use_ssl));
        $view->assign('href_logout', SEFLink('index.php?option=com_jshopping&controller=user&task=logout'));

        $view->display();
    }
    
    function logout(){
        $mainframe =& JFactory::getApplication();
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher =& JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeLogout', array() );

        //preform the logout action
        $error = $mainframe->logout();
        
        $session =& JFactory::getSession();
        $session->set('user_shop_guest', null);
        $session->set('cart', null);

        if (!JError::isError($error)){
            if ($return = JRequest::getVar('return', '', 'method', 'base64')) {
                $return = base64_decode($return);
                if (!JURI::isInternal($return)) {
                    $return = '';
                }
            }
            
            setNextUpdatePrices();
                        
            $dispatcher->trigger( 'onAfterLogout', array() );

            // Redirect if the return url is not registration or login
            if ( $return && !( strpos( $return, 'com_user' )) ) {
                $mainframe->redirect( $return );
            }else{
                $mainframe->redirect(JURI::base());
            }
        }
    }
    
}
?>