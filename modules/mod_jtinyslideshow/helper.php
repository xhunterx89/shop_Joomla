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

class Mod_JTinySlideshowHelper
{
    function javascript(&$params, $position, $type)
    {
        $time_intervall = $params->get('time_intervall', 5);
        $resume = $params->get('resume');
        $visible = $params->get('visible');
        $direction = $params->get('direction');

        if($type == 1)
        {
            ?>
            <script type="text/javascript">// <![CDATA[
                var jtinyslideshow=new TINY.slider.slide('jtinyslideshow',{
                    id:'jtinyslideshow',
                    auto:<?php echo $time_intervall; ?>,
                    resume:<?php echo $resume; ?>,
                    vertical:<?php echo $direction; ?>,
                    navid:'jtinypagination',
                    activeclass:'jtinycurrent',
                    position:<?php echo $position - 1; ?>
                }); // ]]></script>
        <?php
        }
        else
        {
            ?>
            <script type="text/javascript">// <![CDATA[
                var jtinyslideshow=new TINY.fader.fade('jtinyslideshow',{
                    id:'jtinyslides',
                    auto:<?php echo $time_intervall; ?>,
                    resume:<?php echo $resume; ?>,
                    navid:'jtinypagination',
                    activeclass:'jtinycurrent',
                    visible:<?php echo $visible; ?>,
                    position:<?php echo $position - 1; ?>
                }); // ]]></script>
        <?php
        }
    }

    function addStyle($type, $width, $height , $pagination_position, $show_arrows)
    {
        $document = JFactory::getDocument();

        if($type == 1)
        {
            $document->addScript('modules/mod_jtinyslideshow/jtinyslider.js');
        }
        else
        {
            $document->addScript('modules/mod_jtinyslideshow/jtinyfader.js');
        }

        $document->addStyleSheet('modules/mod_jtinyslideshow/jtinyslideshow.css');

        $css = '#jtinyslideshow {width:'.$width.'px; height:'.$height.'px;}'."\n";
        $css .= '#jtinyslides {width:'.$width.'px; height:'.$height.'px;}'."\n";
        $css .= '#jtinyslides li {width:'.$width.'px; height:'.$height.'px;}'."\n";
        $css .= 'li#jtinycontent {width:'.($width - 36).'px; height:'.($height - 30).'px;}'."\n";
        $css .= '.jtinysliderbutton {padding-top:'.($height / 2 - 16).'px;}'."\n";

        if($pagination_position == 0)
        {
            $css .= '#jtinywrapper {height:'.$height.'px;}'."\n";
            $css .= '.jtinypagination {top: -50px !important; display: none !important;}'."\n";
        }
        elseif($pagination_position == 1)
        {
            $css .= '#jtinywrapper {height:'.$height.'px;}'."\n";
            $css .= '.jtinypagination {top: -50px !important; margin: 15px 38px 0 0 !important;}'."\n";
        }
        else
        {
             $css .= '#jtinywrapper {height:'.($height + 50).'px;}'."\n";
        }

        if($show_arrows == 0)
        {
            $css .= '#jtinywrapper {width:'.($width + 38).'px;}'."\n";
        }
        else
        {
            $css .= '#jtinywrapper {width:'.($width + 70).'px;}'."\n";
        }

        $document->addStyleDeclaration($css);
    }
}
