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
echo '<!-- J!TinySlideshow Joomla! 2.5 - Kubik-Rubik Joomla! Extensions -->';
?>
<div id="jtinywrapper">
    <div>
        <?php
        if($show_arrows == 1)
        {
        ?>
            <div class="jtinysliderbutton">
                <img src="modules/mod_jtinyslideshow/images/left.gif" width="32" height="38" alt="Previous" onclick="jtinyslideshow.move(-1)" />
            </div>
        <?php
        }
        ?>
        <div id="jtinyslideshow">
            <ul id="jtinyslides">
                <?php
                if($slide_text_image1 == 1)
                {
                    echo '<li class="jtinycontent"><h1>'.$text_header1.'</h1><p>'.nl2br($text1).'</p></li>';
                }
                else
                {
                    echo '<li class="jtinyimage"><img src="'.$image1.'" ';

                    if($image_scale1 == 1)
                    {
                        echo 'width="100%" height="100%" ';
                    }

                    if(!empty($imagealt1))
                    {
                        echo 'alt="'.$imagealt1.'" ';
                    }

                    echo '/></li>';
                }

                if($slide2 == 1)
                {
                    if($slide_text_image2 == 1)
                    {
                        echo '<li class="jtinycontent"><h1>'.$text_header2.'</h1><p>'.nl2br($text2).'</p></li>';
                    }
                    else
                    {
                        echo '<li class="jtinyimage"><img src="'.$image2.'" ';

                        if($image_scale2 == 1)
                        {
                            echo 'width="100%" height="100%" ';
                        }

                        if(!empty($imagealt2))
                        {
                            echo 'alt="'.$imagealt2.'" ';
                        }

                        echo '/></li>';
                    }
                }

                if($slide3 == 1)
                {
                    if($slide_text_image3 == 1)
                    {
                        echo '<li class="jtinycontent"><h1>'.$text_header3.'</h1><p>'.nl2br($text3).'</p></li>';
                    }
                    else
                    {
                        echo '<li class="jtinyimage"><img src="'.$image3.'" ';

                        if($image_scale3 == 1)
                        {
                            echo 'width="100%" height="100%" ';
                        }

                        if(!empty($imagealt3))
                        {
                            echo 'alt="'.$imagealt3.'" ';
                        }

                        echo '/></li>';
                    }
                }

                if($slide4 == 1)
                {
                    if($slide_text_image4 == 1)
                    {
                        echo '<li class="jtinycontent"><h1>'.$text_header4.'</h1><p>'.nl2br($text4).'</p></li>';
                    }
                    else
                    {
                        echo '<li class="jtinyimage"><img src="'.$image4.'" ';

                        if($image_scale4 == 1)
                        {
                            echo 'width="100%" height="100%" ';
                        }

                        if(!empty($imagealt4))
                        {
                            echo 'alt="'.$imagealt4.'" ';
                        }

                        echo '/></li>';
                    }
                }

                if($slide5 == 1)
                {
                    if($slide_text_image5 == 1)
                    {
                        echo '<li class="jtinycontent"><h1>'.$text_header5.'</h1><p>'.nl2br($text5).'</p></li>';
                    }
                    else
                    {
                        echo '<li class="jtinyimage"><img src="'.$image5.'" ';

                        if($image_scale5 == 1)
                        {
                            echo 'width="100%" height="100%" ';
                        }

                        if(!empty($imagealt5))
                        {
                            echo 'alt="'.$imagealt5.'" ';
                        }

                        echo '/></li>';
                    }
                }

                if($slide6 == 1)
                {
                    if($slide_text_image6 == 1)
                    {
                        echo '<li class="jtinycontent"><h1>'.$text_header6.'</h1><p>'.nl2br($text6).'</p></li>';
                    }
                    else
                    {
                        echo '<li class="jtinyimage"><img src="'.$image6.'" ';

                        if($image_scale6 == 1)
                        {
                            echo 'width="100%" height="100%" ';
                        }

                        if(!empty($imagealt6))
                        {
                            echo 'alt="'.$imagealt6.'" ';
                        }

                        echo '/></li>';
                    }
                }

                if($slide7 == 1)
                {
                    if($slide_text_image7 == 1)
                    {
                        echo '<li class="jtinycontent"><h1>'.$text_header7.'</h1><p>'.nl2br($text7).'</p></li>';
                    }
                    else
                    {
                        echo '<li class="jtinyimage"><img src="'.$image7.'" ';

                        if($image_scale7 == 1)
                        {
                            echo 'width="100%" height="100%" ';
                        }

                        if(!empty($imagealt7))
                        {
                            echo 'alt="'.$imagealt7.'" ';
                        }

                        echo '/></li>';
                    }
                }

                if($slide8 == 1)
                {
                    if($slide_text_image8 == 1)
                    {
                        echo '<li class="jtinycontent"><h1>'.$text_header8.'</h1><p>'.nl2br($text8).'</p></li>';
                    }
                    else
                    {
                        echo '<li class="jtinyimage"><img src="'.$image8.'" ';

                        if($image_scale8 == 1)
                        {
                            echo 'width="100%" height="100%" ';
                        }

                        if(!empty($imagealt8))
                        {
                            echo 'alt="'.$imagealt8.'" ';
                        }

                        echo '/></li>';
                    }
                }
                ?>
            </ul>
        </div>
        <?php
        if($show_arrows == 1)
        {
        ?>
            <div class="jtinysliderbutton">
                <img src="modules/mod_jtinyslideshow/images/right.gif" width="32" height="38" alt="Next" onclick="jtinyslideshow.move(1)" />
            </div>
        <?php
        }
        ?>
    </div>
    <ul id="jtinypagination" class="jtinypagination">
        <li onclick="jtinyslideshow.pos(0)">1</li>
        <?php
        $count = 1;

        if($slide2 == 1)
        {
            echo '<li onclick="jtinyslideshow.pos('.$count.')">'.($count + 1).'</li>';
            $count++;
        }
        if($slide3 == 1)
        {
            echo '<li onclick="jtinyslideshow.pos('.$count.')">'.($count + 1).'</li>';
            $count++;
        }
        if($slide4 == 1)
        {
            echo '<li onclick="jtinyslideshow.pos('.$count.')">'.($count + 1).'</li>';
            $count++;
        }
        if($slide5 == 1)
        {
            echo '<li onclick="jtinyslideshow.pos('.$count.')">'.($count + 1).'</li>';
            $count++;
        }
        if($slide6 == 1)
        {
            echo '<li onclick="jtinyslideshow.pos('.$count.')">'.($count + 1).'</li>';
            $count++;
        }
        if($slide7 == 1)
        {
            echo '<li onclick="jtinyslideshow.pos('.$count.')">'.($count + 1).'</li>';
            $count++;
        }
        if($slide8 == 1)
        {
            echo '<li onclick="jtinyslideshow.pos('.$count.')">'.($count + 1).'</li>';
            $count++;
        }
        ?>
    </ul>
</div>