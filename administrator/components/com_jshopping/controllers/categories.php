<?php
/**
* @version      2.9.4 22.07.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerCategories extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );

        $this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        
        addSubmenu("categories");
    }
    
    function display() {
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();
        $_categories = &$this->getModel("categories");
        
        $context = "jshopping.list.admin.category";
        $catid = $mainframe->getUserStateFromRequest( $context.'catid', 'catid', 0, 'int');
        
        if ($catid){
            $category = &JTable::getInstance('category', 'jshop');        
            $category->load($catid);
            $category->name = $category->getName();
            $tree = $category->getTreeChild();
        }else{
            $tree = array();
        }
        
        $countsubcat = $_categories->getAllCatCountSubCat();
        $countproducts = $_categories->getAllCatCountProducts();

        $categories = $_categories->getSubCategories($catid, 'ordering');
        $parentTop->category_id = 0;
        $parentTop->name = _JSHOP_TOP_LEVEL;
        $categories_select = buildTreeCategory(0);
        array_unshift($categories_select, $parentTop);    
        $lists['treecategories'] = JHTML::_('select.genericlist', $categories_select,'catid','class="inputbox" onchange = "document.adminForm.submit();"','category_id','name', $catid );
        
        $view=&$this->getView("category_list", 'html');
        $view->assign('categories', $categories);
        $view->assign('countsubcat', $countsubcat);
        $view->assign('countproducts', $countproducts);
        $view->assign('lists', $lists);
        $view->assign('tree', $tree);
        $view->assign('category_parent_id', $catid);
        $view->display();
    }
    
    function edit() {
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();        
        $cid = JRequest::getInt("category_id");        
        
        $category = &JTable::getInstance("category","jshop");
        $category->load($cid);
        
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
        
        $nofilter = array();
        JFilterOutput::objectHTMLSafe( $category, ENT_QUOTES, $nofilter);

        if ($cid) {
            $parentid = $category->category_parent_id;
            $rows = $this->_getAllCategoriesLevel($category->category_parent_id, $category->ordering);            
        } else {
            $category->category_publish = 1;
            $parentid = JRequest::getInt("catid");
            $rows = $this->_getAllCategoriesLevel($parentid);
        }

        $lists['writeable'] = (is_writable($jshopConfig->image_category_path))?($jshopConfig->image_category_path . '::' . messageOutput(_JSHOP_WRITEABLE,'jshop_green')):($jshopConfig->image_category_path . '::' . messageOutput(_JSHOP_NON_WRITEABLE));
        $lists['templates'] = getTemplates('category', $category->category_template);
        $lists['onelevel'] = $rows;    
        
        $parentTop->category_id = 0;
        $parentTop->name = _JSHOP_TOP_LEVEL;
        $categories = buildTreeCategory(0);
        array_unshift($categories, $parentTop);
        
        $lists['treecategories'] = JHTML::_('select.genericlist', $categories,'category_parent_id','class="inputbox" size="1" onchange = "changeCategory()"','category_id','name', $parentid);
        $lists['parentid'] = $parentid;
        
        $view=&$this->getView("category_edit", 'html');
        $view->assign('category', $category);
        $view->assign('lists', $lists);
        $view->assign('languages', $languages);
        $view->assign('multilang', $multilang);
        $view->display();
    }
    
    function save() {        
        $mainframe =& JFactory::getApplication();
        $jshopConfig = &JSFactory::getConfig();        
        
        require_once ($jshopConfig->path.'lib/image.lib.php');
        require_once ($jshopConfig->path.'lib/uploadfile.class.php');
        
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();        
        
        $_alias = &$this->getModel("alias"); 
        $db = &JFactory::getDBO();
        
        $category = &JTable::getInstance("category","jshop");
        if (!$_POST["category_id"]){
            $_POST['category_add_date'] = date("Y-m-d H:i:s");
        }
        if (!isset($_POST['category_publish'])){
            $_POST['category_publish'] = 0;
        }
        
        $post = JRequest::get('post');
        $_lang = &$this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        
        $dispatcher->trigger( 'onBeforeSaveCategory', array(&$post) );
        
        foreach($languages as $lang){
            $post['name_'.$lang->language] = trim($post['name_'.$lang->language]);
            $post['alias_'.$lang->language] = setFilterAlias($post['alias_'.$lang->language]);
            if ($post['alias_'.$lang->language]!="" && !$_alias->checkExistAlias1Group($post['alias_'.$lang->language], $lang->language, $post['category_id'], 0)){
                $post['alias_'.$lang->language] = "";
                JError::raiseWarning("",_JSHOP_ERROR_ALIAS_ALREADY_EXIST);
            }
            $post['description_'.$lang->language] = JRequest::getVar('description'.$lang->id,'','post',"string", 2);
            $post['short_description_'.$lang->language] = JRequest::getVar('short_description_'.$lang->language,'','post',"string", 2);
        }
        
        if (!$category->bind($post)) {
            JError::raiseWarning("",_JSHOP_ERROR_BIND);
            $this->setRedirect("index.php?option=com_jshopping&controller=categories");
            return 0;
        }
        $edit = $category->category_id;
       
        $upload = new UploadFile($_FILES['category_image']);
        $upload->setAllowFile(array('jpeg','jpg','gif','png'));
        $upload->setDir($jshopConfig->image_category_path);
        if ($upload->upload()){            
            if ($post['old_image']) {
                @unlink($jshopConfig->image_category_path."/".$post['old_image']);
            }
            $name = $upload->getName();
            @chmod($jshopConfig->image_category_path."/".$name, 0777);
            
            if ($post['size_im_category'] < 3){
                if($post['size_im_category'] == 1){
                    $category_width_image = $jshopConfig->image_category_width; 
                    $category_height_image = $jshopConfig->image_category_height;
                }else{
                    $category_width_image = JRequest::getInt('category_width_image'); 
                    $category_height_image = JRequest::getInt('category_height_image');
                }

                $path_full = $jshopConfig->image_category_path."/".$name;
                $path_thumb = $jshopConfig->image_category_path."/".$name;

                if (!ImageLib::resizeImageMagic($path_full, $category_width_image, $category_height_image, $jshopConfig->image_cut, $jshopConfig->image_fill, $path_thumb, $jshopConfig->image_quality, $jshopConfig->image_fill_color)) {
                    JError::raiseWarning("",_JSHOP_ERROR_CREATE_THUMBAIL);
                    saveToLog("error.log", "SaveCategory - Error create thumbail");
                }
                @chmod($jshopConfig->image_category_path."/".$name, 0777);    
                unset($img);
            }
            
            $category->category_image = $name;
            
        }else{            
            if ($upload->getError() != 4){
                JError::raiseWarning("", _JSHOP_ERROR_UPLOADING_IMAGE);
                saveToLog("error.log", "SaveCategory - Error upload image. code: ".$upload->getError());
            }
        }

        $this->_reorderCategory($category);
         
        if (!$category->store()) {
            JError::raiseWarning("",_JSHOP_ERROR_SAVE_DATABASE);
            $this->setRedirect("index.php?option=com_jshopping&controller=categories");
            return 0;
        }
        
        $dispatcher->trigger( 'onAfterSaveCategory', array(&$category) );
        
        $success = ($edit)?(_JSHOP_CATEGORY_SUCC_UPDATE):(_JSHOP_CATEGORY_SUCC_ADDED);
        
        if ($this->getTask()=='apply'){
            $this->setRedirect('index.php?option=com_jshopping&controller=categories&task=edit&category_id='.$category->category_id, $success);
        }else{
            $this->setRedirect('index.php?option=com_jshopping&controller=categories', $success);
        }        
    }
    
    function order(){        
        $id = JRequest::getInt("id");
        $move = JRequest::getInt("move");        
        $table = &JTable::getInstance('category', 'jshop');
        $table->load($id);
        $table->move($move, 'category_parent_id="'.$table->category_parent_id.'"');
        $this->setRedirect("index.php?option=com_jshopping&controller=categories");
    }
    
    function saveorder(){
        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        $order = JRequest::getVar( 'order', array(), 'post', 'array' );
        $category_parent_id = JRequest::getInt("category_parent_id");
        
        foreach ($cid as $k=>$id){
            $table = &JTable::getInstance('category', 'jshop');
            $table->load($id);
            if ($table->ordering!=$order[$k]){
                $table->ordering = $order[$k];
                $table->store();
            }        
        }
        
        $table = &JTable::getInstance('category', 'jshop');
        $table->ordering = null;
        $table->reorder('category_parent_id="'.$category_parent_id.'"');        
                
        $this->setRedirect("index.php?option=com_jshopping&controller=categories");
    }

    function _getAllCategoriesLevel($parentId, $currentOrdering = 0){
        $jshopConfig = &JSFactory::getConfig();
        $_categories = &$this->getModel("categories");
        $rows = $_categories->getSubCategories($parentId, "ordering");
        $first[] = JHTML::_('select.option', '0',_JSHOP_ORDERING_FIRST,'ordering','name');
        $rows = array_merge($first,$rows);
        $currentOrdering = (!$currentOrdering) ? ($rows[count($rows) - 1]->ordering) : ($currentOrdering);
        return (JHTML::_('select.genericlist', $rows,'ordering','class="inputbox" size="1"','ordering','name',$currentOrdering));
    }
    
    function _reorderCategory(&$category) {
        $db = &JFactory::getDBO();
        $query = "UPDATE `#__jshopping_categories` SET `ordering` = ordering + 1
                    WHERE `category_parent_id` = '" . $category->category_parent_id . "' AND `ordering` > '" . $category->ordering . "'";
        $db->setQuery($query);
        $db->query();
        $category->ordering++;
    }
    
    function publish(){
        $this->publishCategory(1);
        $this->setRedirect('index.php?option=com_jshopping&controller=categories');
    }
    
    function unpublish(){
        $this->publishCategory(0);
        $this->setRedirect('index.php?option=com_jshopping&controller=categories');
    }
    
    function publishCategory($flag) {        
        $db = &JFactory::getDBO();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();
        $cid = JRequest::getVar("cid");
        $dispatcher->trigger( 'onBeforePublishCategory', array(&$cid, &$flag) );
        foreach ($cid as $key => $value) {
            $query = "UPDATE `#__jshopping_categories` SET `category_publish` = '" . $db->getEscaped($flag) . "' WHERE `category_id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
        }
                
        $dispatcher->trigger( 'onAfterPublishCategory', array(&$cid, &$flag) );
    }
    
    function remove() {
        $jshopConfig = &JSFactory::getConfig();
        $db = &JFactory::getDBO();
        JPluginHelper::importPlugin('jshoppingadmin');
        $dispatcher =& JDispatcher::getInstance();        
        $text = array();
        $cid = JRequest::getVar("cid");
        $_categories = &$this->getModel("categories");
        
        $dispatcher->trigger( 'onBeforeRemoveCategory', array(&$cid) );
        
        foreach ($cid as $key => $value) {
            $category = &JTable::getInstance("category", "jshop");
            $category->load($value);
            $name_category = $category->getName();
            if($category->getCountProducts(0)){
                $text[]= sprintf(_JSHOP_CATEGORY_NO_DELETED, $name_category);
                continue;
            }
            $_categories->deleteCategory($value);
            @unlink($jshopConfig->image_category_path.'/'.$category->category_image);
            $text[]= sprintf(_JSHOP_CATEGORY_DELETED, $name_category);
        }
        
        $dispatcher->trigger( 'onAfterRemoveCategory', array(&$cid) );
        
        $this->setRedirect('index.php?option=com_jshopping&controller=categories', implode('</li><li>',$text));
    }
    
    function sorting_cats_html(){
        $catid = JRequest::getVar('catid');
        print $this->_getAllCategoriesLevel($catid);
    die();    
    }
    
    function delete_foto(){
        $catid = JRequest::getInt("catid");
        $jshopConfig = &JSFactory::getConfig();
        $category = &JTable::getInstance("category", "jshop");
        $category->load($catid);
        @unlink($jshopConfig->image_category_path.'/'.$category->category_image);
        $category->category_image = "";
        $category->store();
        die();
    }
    
    
}
?>