<?php
/**
 * @version		$Id$
 * @author		Pham Minh Tuan (admin@vnskyline.com)
 * @package		Joomla.Plugin
 * @subpakage	Skyline.ScrollToTop
 * @copyright	Copyright (c) 2012 Skyline Software (http://www.vnskyline.com). All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die();

jimport('joomla.plugin.plugin');

/**
 * System - Scroll To Top Plugin
 *
 * @package		Joomla.Plugin
 * @subpakage	Skyline.ScrollToTop
 */
class plgSystemSL_ScrollToTop extends JPlugin {

	/**
	 * Constructor.
	 *
	 * @param 	$subject
	 * @param	array $config
	 */
	function __construct(&$subject, $config = array()) {
		// call parent constructor
		parent::__construct($subject, $config);
	}

	/**
	 * onAfterRoute Hook.
	 */
	function onAfterRoute() {
		// initialize variables
		$app			= JFactory::getApplication();
		$admin_enable	= $this->params->get('admin_enable');

		if (!$admin_enable && $app->isAdmin()) {
			return;
		}

		$style		= $this->params->get('style');
		$text		= htmlspecialchars($this->params->get('text'));
		$title		= htmlspecialchars($this->params->get('title'));
		$duration	= (int) $this->params->get('duration', 500);
		$transition	= $this->params->get('transition', 'Fx.Transitions.linear');
		$custom_css	= $this->params->get('custom_css');

		$class		= 'scrollToTop';
		if ($style != 'text') {
			$class	.= '-' . $style;
		}

		$js			= <<<SCRIPTHERE
document.addEvent('domready', function() {
	new Skyline_ScrollToTop({
		'text':			'$text',
		'title':		'$title',
		'className':	'$class',
		'duration':		$duration,
		'transition':	$transition
	});
});
SCRIPTHERE;

		JHtml::_('behavior.mootools');
		$document	= JFactory::getDocument();
		$document->addScript(JURI::root() . 'plugins/system/sl_scrolltotop/assets/js/skyline_scrolltotop.min.js');
		$document->addScriptDeclaration($js);
		$document->addStyleSheet(JURI::root() . 'plugins/system/sl_scrolltotop/assets/css/style.css');

		if ($custom_css) {
			$document->addStyleDeclaration($custom_css);
		}
	}
}