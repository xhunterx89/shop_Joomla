<?php
/**
 * @package		"JoomShopping"
 * @version		2.7.4 06.08.2011
 * @author		MAXXmarketing GmbH 
 * @copyright	2011. MAXXmarketing GmbH. All rights reserved.
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');
jimport('joomla.application.component.view');
jimport('joomla.application.component.controller');
jimport('joomla.html.pagination');

class JShoppingControllerProduct_List_Selectable extends JController {
	function display() {
		$app =& JFactory::getApplication();
		$db =& JFactory::getDBO();
		$jshopConfig =& JSFactory::getConfig();        
		$prodMdl =& JModel::getInstance('Products', 'JShoppingModel');    

		$context = "jshoping.list.admin.product";
		$limit = $app->getUserStateFromRequest($context.'limit', 'limit', $app->getCfg('list_limit'), 'int');
		$limitstart = $app->getUserStateFromRequest($context.'limitstart', 'limitstart', 0, 'int');
		
		if (isset($_GET['category_id']) && $_GET['category_id'] === "0"){            
			$app->setUserState($context.'category_id', 0);
			$app->setUserState($context.'manufacturer_id', 0);
			$app->setUserState($context.'label_id', 0);
			$app->setUserState($context.'publish', 0);
			$app->setUserState($context.'text_search', '');
		}              
		
		$category_id = $app->getUserStateFromRequest($context.'category_id', 'category_id', 0, 'int');
		$manufacturer_id = $app->getUserStateFromRequest($context.'manufacturer_id', 'manufacturer_id', 0, 'int');
		$label_id = $app->getUserStateFromRequest($context.'label_id', 'label_id', 0, 'int');
		$publish = $app->getUserStateFromRequest($context.'publish', 'publish', 0, 'int');
		$text_search = $app->getUserStateFromRequest($context.'text_search', 'text_search', '');
		
		$filter = array("category_id" => $category_id,
						"manufacturer_id" => $manufacturer_id,
						"label_id" => $label_id,
						"publish" => $publish,
						"text_search" => $text_search);
				
		$total = $prodMdl->getCountAllProducts($filter);

		$pagination = new JPagination($total, $limitstart, $limit);
		
		$rows = $prodMdl->getAllProducts($filter, $pagination->limitstart, $pagination->limit);
		
		$parentTop->category_id = 0;
		$parentTop->name = " - - - ";
		$categories_select = buildTreeCategory(0);
		
		array_unshift($categories_select, $parentTop);  
		  
		$lists['treecategories'] = JHTML::_('select.genericlist', $categories_select, 'category_id',
											'onchange="document.adminForm.submit();"', 'category_id', 'name',
											$category_id);
		
		$manuf1 = array();
		$manuf1[0]->manufacturer_id = '0';
		$manuf1[0]->name = " - - - ";

		$manufs = JModel::getInstance('Manufacturers', 'JShoppingModel')->getAllManufacturers(0);
		$manufs = array_merge($manuf1, $manufs);
		$lists['manufacturers'] = JHTML::_('select.genericlist', $manufs, 'manufacturer_id',
										   'onchange="document.adminForm.submit();"', 'manufacturer_id',
										   'name', $manufacturer_id);
		
		// product labels
		if ($jshopConfig->admin_show_product_labels) {
			$alllabels = JModel::getInstance('ProductLabels', 'JShoppingModel')->getList();
			$first = array();
			$first[] = JHTML::_('select.option', '0'," - - - ", 'id','name');        
			$lists['labels'] = JHTML::_('select.genericlist', array_merge($first, $alllabels), 'label_id',
										'onchange="document.adminForm.submit();"','id','name', $label_id);
		}
		//
		
		$f_option = array();
		$f_option[] = JHTML::_('select.option', 0, " - - - ", 'id', 'name');
		$f_option[] = JHTML::_('select.option', 1, _JSHOP_PUBLISH, 'id', 'name');
		$f_option[] = JHTML::_('select.option', 2, _JSHOP_UNPUBLISH, 'id', 'name');
		$lists['publish'] = JHTML::_('select.genericlist', $f_option, 'publish', 'onchange="document.adminForm.submit();"', 'id', 'name', $publish);
		
		$currency =& JTable::getInstance('currency', 'jshop');
		$currency->load($jshopConfig->mainCurrency);
		
		$view =& $this->getView('product_list_selectable', 'html');
		$view->assign('rows', $rows);
		$view->assign('lists', $lists);
		$view->assign('category_id', $category_id);
		$view->assign('manufacturer_id', $manufacturer_id);
		$view->assign('pagination', $pagination);
		$view->assign('text_search', $text_search);
		$view->assign('config', $jshopConfig);
		$view->assign('currency', $currency);
		$view->display();
	}
}
?>		