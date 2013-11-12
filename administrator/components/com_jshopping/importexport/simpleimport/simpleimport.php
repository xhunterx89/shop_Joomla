<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.filesystem.folder');

class IeSimpleImport extends IeController{
    
    function view(){
        $jshopConfig = &JSFactory::getConfig();
        $ie_id = JRequest::getInt("ie_id");
        $_importexport = &JTable::getInstance('ImportExport', 'jshop'); 
        $_importexport->load($ie_id);
        $name = $_importexport->get('name');                        
            
        JToolBarHelper::title(_JSHOP_IMPORT. ' "'.$name.'"', 'generic.png' ); 
        JToolBarHelper::custom("backtolistie", "back", 'browser.png', _JSHOP_BACK_TO.' "'._JSHOP_PANEL_IMPORT_EXPORT.'"', false );        
        JToolBarHelper::spacer();
        JToolBarHelper::save("save", _JSHOP_IMPORT);    
        
        include(dirname(__FILE__)."/form.php");  
    }

    function save(){
        $mainframe =& JFactory::getApplication();
        
        $jshopConfig = &JSFactory::getConfig();        
        require_once(JPATH_COMPONENT_SITE.'/lib/uploadfile.class.php');
        require_once(JPATH_COMPONENT_SITE."/lib/csv.io.class.php");
        
        $ie_id = JRequest::getInt("ie_id");
        if (!$ie_id) $ie_id = $this->get('ie_id');        
        
        $lang = &JSFactory::getLang();
        $db = &JFactory::getDBO();
        
        $_importexport = &JTable::getInstance('ImportExport', 'jshop'); 
        $_importexport->load($ie_id);
        $alias = $_importexport->get('alias');
        $_importexport->set('endstart', time());
        $_importexport->store();
                
        //get list tax
        $query = "SELECT tax_id, tax_value FROM `#__jshopping_taxes`";
        $db->setQuery($query);        
        $rows = $db->loadObjectList();
        $listTax = array();
        foreach($rows as $row){
            $listTax[intval($row->tax_value)] = $row->tax_id;
        }
        //
        
        //get list category
        $query = "SELECT category_id as id, `".$lang->get("name")."` as name FROM `#__jshopping_categories`";
        $db->setQuery($query);        
        $rows = $db->loadObjectList();
        $listCat = array();
        foreach($rows as $row){
            $listCat[$row->name] = $row->id;
        }        
        //
        
        $_products = &JModel::getInstance('products', 'JshoppingModel');                
        
        $dir = $jshopConfig->importexport_path.$alias."/";
        
        $upload = new UploadFile($_FILES['file']);
        $upload->setAllowFile(array('csv'));
        $upload->setDir($dir);
        if ($upload->upload()){
            $filename = $dir."/".$upload->getName();
            @chmod($filename, 0777);
            $csv = new csv();
            $data = $csv->read($filename);            
            if (is_array($data)){                
                foreach($data as $k=>$row){                    
                    if (count($row)<2 || $k==0) continue;
                                        
                    $tax_value = intval($row[5]);                    
                    if (!isset($listTax[$tax_value])){
                        $tax = &JTable::getInstance('tax', 'jshop');
                        $tax->set('tax_name', $tax_value);
                        $tax->set('tax_value', $tax_value);
                        $tax->store();
                        $listTax[$tax_value] = $tax->get("tax_id");                        
                    }
                    
                    $category_name = $row['6'];
                    if (!isset($listCat[$category_name]) && $category_name!=""){
                        $cat = &JTable::getInstance("category","jshop");
                        $query = "SELECT max(ordering) FROM `#__jshopping_categories`";
                        $db->setQuery($query);        
                        $ordering = $db->loadResult() + 1;
                        $cat->set($lang->get("name"), $category_name);
                        $cat->set("category_ordertype", 1);
                        $cat->set("products_page", $jshopConfig->count_products_to_page);
                        $cat->set("products_row", $jshopConfig->count_products_to_row);
                        $cat->set("category_publish", 0);
                        $cat->set("ordering", $ordering);                        
                        $cat->store();
                        $listCat[$category_name] = $cat->get("category_id");                        
                    }
                    
                    
                    $product =& JTable::getInstance('product', 'jshop');
                    $product->set("product_ean", $row[1]);
                    $product->set("product_quantity", $row[2]);
                    $product->set("product_date_added", $row[3]);
                    $product->set("product_price", $row[4]);
                    $product->set("min_price", $row[4]);
                    $product->set("product_tax_id", $listTax[$tax_value]);                                        
                    $product->set($lang->get("name"), utf8_encode($row[7]));
                    $product->set($lang->get("short_description"), utf8_encode($row[8]));
                    $product->set($lang->get("description"), utf8_encode($row[9]));
                    $product->store();
                    $product_id = $product->get("product_id");
                    $category_id = $listCat[$category_name];
                    if ($category_name!="" && $category_id){
                        $_products->setCategoryToProduct($product_id, array($category_id));
                    }
                    
                    unset($product);
                }
            }
        }else{            
            JError::raiseWarning("", _JSHOP_ERROR_UPLOADING);
        }
                
        if (!JRequest::getInt("noredirect")){
            $mainframe->redirect("index.php?option=com_jshopping&controller=importexport&task=view&ie_id=".$ie_id, _JSHOP_COMPLETED);
        }
    }
    
}

?>