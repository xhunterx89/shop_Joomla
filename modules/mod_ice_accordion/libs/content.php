<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
/**
 * $ModDesc
 * 
 * @version		$Id: helper.php $Revision
 * @package		modules
 * @subpackage	$Subpackage
 * @copyright	Copyright (C) May 2010 LandOfCoder.com <@emai:landofcoder@gmail.com>. All rights reserved.
 * @website 	htt://landofcoder.com
 * @license		GNU General Public License version 2
 */
 jimport('joomla.application.component.model');
JModel::addIncludePath(JPATH_SITE.'/components/com_content/models');
if( !class_exists('IceGroupAccordionContent') ){ 
	class IceGroupAccordionContent extends LofGroupBase{
		
		/**
		 * @var string $__name;
		 *
		 * @access private
		 */
		var $__name = 'content';
		
		/**
		 * override method: get list image from articles.
		 */
		function getListByParameters( $params ){ 
			return $this->__getListJLOneFive( $params );
		}
			
		/**
     * get the list of articles, using for joomla 1.5.x
     * 
     * @param JParameter $params;
     * @return Array
     */
	public static function __getListJLOneFive( $params )
	{
		  $mainframe = &JFactory::getApplication();
		  $openTarget    = $params->get( 'open_target', 'parent' );
		  $formatter     = $params->get( 'style_displaying', 'title' );
		  $titleMaxChars = $params->get( 'title_max_chars', 100 );
		  $descriptionMaxChars = $params->get( 'description_max_chars', 100 );
		  $isThumb       = $params->get( 'auto_renderthumb',1);
		  $ordering      = $params->get( 'ordering', 'created');
		  $limit         = $params->get( 'limit_items', 4 );
		  $order_direction = $params->get( 'order_direction', "ASC" );
		  if( trim($ordering) == 'rand' ){ $ordering = ' RAND() '; }
		  else { $ordering 	 = "a.".$ordering;}
		  $image_quanlity = $params->get('image_quanlity', 100);
		  $thumbWidth    = (int)$params->get( 'thumbnail_width', 60 );
		  $thumbHeight   = (int)$params->get( 'thumbnail_height', 60 );
		  $imageHeight   = (int)$params->get( 'main_height', 300 ) ;
		  $imageWidth    = (int)$params->get( 'main_width', 900 ) ;
		  $isStripedTags = $params->get( 'auto_strip_tags', 0 );
		  $extraURL     = $params->get('open_target')!='modalbox'?'':'&tmpl=component'; 
		  $date   =& JFactory::getDate();
		  $now    = $date->toMySQL();
		  //$cparam = &JComponentHelper::getParams( 'com_content' );
			// Get the dbo
			$db = JFactory::getDbo();
			
			// Get an instance of the generic articles model
			$model = JModel::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
	
			// Set application parameters in model
			$appParams = JFactory::getApplication()->getParams();
			$model->setState('params', $appParams);
	
			$model->setState('list.select', 'a.fulltext, a.id , a.id, a.title, a.alias, a.title_alias, a.introtext, a.state, a.catid, a.created, a.created_by, a.created_by_alias,' .
								' a.modified, a.modified_by,a.publish_up, a.publish_down, a.attribs, a.metadata, a.metakey, a.metadesc, a.access,' .
								' a.hits, a.featured,' .
								' LENGTH(a.fulltext) AS readmore');
			
			// Set the filter limit 
			$model->setState('list.start', 0);
			$model->setState('list.limit', (int)$limit);		
			$model->setState('filter.published', 1);
	
			// Access filter
			$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
			$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
			$model->setState('filter.access', $access);
			
			$featured = $params->get('content_featured_items_show', 1);
			if(!$featured){
				$model->setState('filter.featured', 'hide');
			}
			elseif($featured==2){
				$model->setState('filter.featured', 'only');
			}
			
			// Set ordering	
			$model->setState('list.ordering', $ordering );
			$model->setState('list.direction', $order_direction);
			IceGroupAccordionContent::_buildConditionQuery($model, $params );
			$items = $model->getItems();
			if( empty($items) ) return array();
			
			$i = 0;
			$showimg = $params->get ( 'show_image', 1 );
			$w = ( int ) $params->get ( 'width', 80 );
			$h = ( int ) $params->get ( 'height', 96 );
			$showdate = $params->get ( 'show_date', 1 );
		
			$thumbnailMode = $params->get( 'thumbnail_mode', 'crop' );
			$aspect 	   = $params->get( 'use_ratio', '1' );
			$crop = $thumbnailMode == 'crop' ? true:false;
			$lists = array ();		
			
			foreach ($items as &$item) {
				$item->slug = $item->id.':'.$item->alias;
				$item->catslug = $item->catid.':'.$item->category_alias;
	
				if ($access || in_array($item->access, $authorised))
				{
					// We know that user has the privilege to view the article
					$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug));
				}
				else {
					$item->link = JRoute::_('index.php?option=com_user&view=login');
				}
				
				$item->introtext = JHtml::_('content.prepare', $item->introtext);
				$item->date = JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC2')); 
				//$results = @$dispatcher->trigger('onPrepareContent', array (& $item, & $params, 0));
				$item->text = $item->introtext;
				$mainframe->triggerEvent( 'onContentPrepare', array( 'com_content.article', &$item, &$params, 0 ) , true ); 
				$item->introtext=$item->text;
				self::parseImages( $item );
				if( $item->mainImage &&  $image=self::renderThumb($item->mainImage, $imageWidth, $imageHeight, $item->title, $isThumb, $image_quanlity ) ){
					$item->mainImage = $image;
				}
				$item->description = self::substring( $item->introtext, $descriptionMaxChars, true );
				$item->title = self::substring( $item->title, $titleMaxChars, true, "" ); 
				if ($showdate) {
					$item->date = $item->modified == null||$item->modified==""||$item->modified=="0000-00-00 00:00:00" ? $item->created : $item->modified;
				}
			}
			return $items;
		}				
		
		/**
		 * build condition query base parameter  
		 * 
		 * @param JParameter $params;
		 * @return .
		 */
		public static function _buildConditionQuery( &$model, $params ){
			$source = trim($params->get( 'source', 'content_category' ) );
			if( $source == 'content_category' ){
				$catids = $params->get( 'content_category','');
				
				if( !$catids ){
					return '';
				}
				$catids = is_array($catids) ? $catids : explode(",",$catids);
				$model->setState('filter.category_id', $catids);
			} else {
				$ids = preg_split('/,/',$params->get( 'article_ids',''));
				$tmp = array();
				foreach( $ids as $id ){
					$tmp[] = (int) trim($id);
				}
				$model->setState('filter.article_id', $tmp);
			}
			return true;
		}
	}
}
?>
