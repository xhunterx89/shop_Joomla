<?php
/**
 *  @Copyright
 *
 *  @package	J!TinySlideshow for Joomla 2.5
 *  @author     Viktor Vogel {@link http://joomla-extensions.kubik-rubik.de/}
 *  @version	Version: 2.5-3 - 24-Sep-2012
 *  @link       Project page {@link http://joomla-extensions.kubik-rubik.de/jts-jtinyslideshow}
 *
 *  Original script: Slider / Fading JavaScript Slideshow / TinyFader by Michael Leigeber (http://www.leigeber.com/)
 *
 *  @license GNU/GPL
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).DS.'helper.php');

$type = $params->get('type');
$time_intervall = $params->get('time_intervall', 5);
$resume = $params->get('resume');
$visible = $params->get('visible');
$position = $params->get('position');
$width = $params->get('width');
$height = $params->get('height');
$direction = $params->get('direction');
$pagination_position = $params->get('pagination_position');
$show_arrows = $params->get('show_arrows');
$slide_text_image1 = $params->get('slide_text_image1');
$text_header1 = $params->get('text_header1', 'J!TinySlideshow');
$text1 = $params->get('text1', 'by Kubik-Rubik.de');
$image1 = $params->get('image1');
$imagealt1 = $params->get('imagealt1');
$image_scale1 = $params->get('image_scale1');
$slide2 = $params->get('slide2');
$slide_text_image2 = $params->get('slide_text_image2');
$text_header2 = $params->get('text_header2');
$text2 = $params->get('text2');
$image2 = $params->get('image2');
$imagealt2 = $params->get('imagealt2');
$image_scale2 = $params->get('image_scale2');
$slide3 = $params->get('slide3');
$slide_text_image3 = $params->get('slide_text_image3');
$text_header3 = $params->get('text_header3');
$text3 = $params->get('text3');
$image3 = $params->get('image3');
$imagealt3 = $params->get('imagealt3');
$image_scale3 = $params->get('image_scale3');
$slide4 = $params->get('slide4');
$slide_text_image4 = $params->get('slide_text_image4');
$text_header4 = $params->get('text_header4');
$text4 = $params->get('text4');
$image4 = $params->get('image4');
$imagealt4 = $params->get('imagealt4');
$image_scale4 = $params->get('image_scale4');
$slide5 = $params->get('slide5');
$slide_text_image5 = $params->get('slide_text_image5');
$text_header5 = $params->get('text_header5');
$text5 = $params->get('text5');
$image5 = $params->get('image5');
$imagealt5 = $params->get('imagealt5');
$image_scale5 = $params->get('image_scale5');
$slide6 = $params->get('slide6');
$slide_text_image6 = $params->get('slide_text_image6');
$text_header6 = $params->get('text_header6');
$text6 = $params->get('text6');
$image6 = $params->get('image6');
$imagealt6 = $params->get('imagealt6');
$image_scale6 = $params->get('image_scale6');
$slide7 = $params->get('slide7');
$slide_text_image7 = $params->get('slide_text_image7');
$text_header7 = $params->get('text_header7');
$text7 = $params->get('text7');
$image7 = $params->get('image7');
$imagealt7 = $params->get('imagealt7');
$image_scale7 = $params->get('image_scale7');
$slide8 = $params->get('slide8');
$slide_text_image8 = $params->get('slide_text_image8');
$text_header8 = $params->get('text_header8');
$text8 = $params->get('text8');
$image8 = $params->get('image8');
$imagealt8 = $params->get('imagealt8');
$image_scale8 = $params->get('image_scale8');

Mod_JTinySlideshowHelper::addStyle($type, $width, $height , $pagination_position, $show_arrows);

require(JModuleHelper::getLayoutPath('mod_jtinyslideshow', 'default'));

if($position > $count)
{
    $position = $count;
}

Mod_JTinySlideshowHelper::javascript($params, $position, $type);
