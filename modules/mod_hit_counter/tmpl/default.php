<?php

/**

 * @package Module Hit Counter for Joomla! 2.5

 * @author http://ajleeonline.com

 * @copyright (C) 2010- ajleeonline.com

 * @license PHP files are GNU/GPL

**/



// No direct access to this file

defined('_JEXEC') or die('Restricted access');

?>

<style type="text/css">

.hitcounter_container {

	background-color:#FFF;

	border: 1px solid #DADADA;

	padding:10px;

}

.hitcounter_rows {

	line-height:25px;

}

</style>

<div class="hitcounter_container">

    <?php if($headertext = $params->get('headertext')) { ?>

        <div class="jvcounter_rows jvcounter_headertext">

            <?php

                echo $headertext;

            ?>

        </div>

    <?php } ?>

    

	<div class="hitcounter_rows hitcounter_image">

    	<?php echo $totalImage;?>

	</div>

    

    <?php if($params->get('showip', 1)) { ?>

        <div class="hitcounter_rows hitcounter_ip">

            <?php

                $ip = $_SERVER['REMOTE_ADDR'] == '::1' ? 'local' : $_SERVER['REMOTE_ADDR']; 

                echo JText::_('IP: ') . $ip;

            ?>

        </div>

    <?php } ?>

    

    <?php if($params->get('showdatetoday',1)) { ?>

        <div class="hitcounter_rows hitcounter_datetoday">

            <?php 

                $dateformat = $params->get('datetodayformat', '%Y-%m-%d %H:%M:%S');

                $timeoffset = time() + 60*60*(int)$params->get('timeoffset', 7);

                echo JFactory::getDate($timeoffset)->toFormat($dateformat);

            ?>

        </div>

    <?php } ?>

    

    <?php if(@$visits['online']) { ?>

        <div class="hitcounter_rows hitcounter_online">
           

            <?php echo JText::_('Thành viên online').' '. count(@$visits['online']['user']);?><br/>

            <?php echo JText::_('Khách online').' '. count(@$visits['online']['guest']);?><br/>

        </div>

    <?php } ?>

    

    <?php if(@$visits['today']){ ?>

        <div class="hitcounter_rows hitcounter_today">

            <?php echo $params->get('texttoday','Today').' '. count($visits['today']);?>

        </div>

    <?php } ?>

    

    <?php if(@$visits['yesterday']) { ?>

        <div class="hitcounter_rows hitcounter_yesterday">

            <?php echo $params->get('textyesterday','Yesterday').' '. count($visits['yesterday']);?>

        </div>

    <?php } ?>

    

    <?php if(@$visits['thisweek']) { ?>

        <div class="hitcounter_rows hitcounter_thisweek">

            <?php echo $params->get('textthisweek','This week').' '. count($visits['thisweek']);?>

        </div>

    <?php } ?>

    

    <?php if(@$visits['lastweek']) { ?>

        <div class="hitcounter_rows hitcounter_lastweek">

            <?php echo $params->get('textlastweek','Last week').' '. count($visits['lastweek']);?>

        </div>

    <?php } ?>

    

    <?php if($visits['thismonth']) { ?>

        <div class="hitcounter_rows hitcounter_thismonth">

            <?php echo $params->get('textthismonth','This month').' '. count($visits['thismonth']);?>

        </div>

    <?php } ?>

    

    <?php if(@$visits['lastmonth']) { ?>

        <div class="hitcounter_rows hitcounter_lastmonth">

            <?php echo $params->get('textlastmonth','Last month').' '. count($visits['lastmonth']);?>

        </div>

    <?php } ?>

    

    <?php if($params->get('showalldays',1)) { ?>

        <div class="hitcounter_rows hitcounter_alldays">

            <?php echo $params->get('textalldays','All days').' '. $visits['total'] ;?>

        </div>

    <?php } ?>

	<?php


//echo '<div align="right">Counter by '; echo '<a href="http://ajleeonline.com">http://ajleeonline.com</a></div>';


?>

</div>