<?php 
//  @copyright  Copyright (C) 2008 - 2011 IceTheme. All Rights Reserved
//  @license  Copyrighted Commercial Software 
//  @author     IceTheme (icetheme.com)

// No direct access.
defined('_JEXEC') or die;

// A code to show the offline.php page for the demo
if(JRequest::getCmd("tmpl","index")== "offline"){  
  if(is_file(dirname(__FILE__).DS."offline.php")){
    require_once(dirname(__FILE__).DS."offline.php");
  }else{
    if(is_file(JPATH_SITE.DS."templates".DS."system".DS."offline.php")){
      require_once(JPATH_SITE.DS."templates".DS."system".DS."offline.php");
    }
  }
}else{

// Include PHP files to the template
include_once(JPATH_ROOT . "/templates/" . $this->template . '/icetools/default.php');
include_once(JPATH_ROOT . "/templates/" . $this->template . '/icetools/switcher.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
  
<head>

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />

<jdoc:include type="head" />

<?php if($this->params->get('fixcols')) { ?>
<?php if(!countModules('mod_ice_accordion')): ?>
<script type="text/javascript" src="<?php echo $this->baseurl . "/templates/" . $this->template . '/js/fix-cols.js' ?>"></script>
<?php endif; ?>
<?php } ?> 


<?php
// Include CSS and JS variables 
include_once(JPATH_ROOT . "/templates/" . $this->template . '/css_vars.php');
?>

</head>

<body class="<?php echo $pageclass->get('pageclass_sfx'); ?>">



<div id="site_wrapper">


<!-- Accessibility -->
<ol id="accessibility">
    <li><a href="#nav-wrapper"><?php echo JText::_("SKIP_MENU");?></a></li>
    <li><a href="#content"><?php echo JText::_("SKIP_CONTENT");?></a></li>
    <li><a href="#footer" ><?php echo JText::_("SKIP_FOOTER");?></a></li>
</ol><!-- Accessibility -->

   
    <!-- TopBar -->   
  <div id="topbar_wrapper">
    
        <div id="topbar">
            
            <div class="wrapper">
                
        <?php if ($this->countModules('contact')) { ?> 
                <div id="contact_nr">
                    <jdoc:include type="modules" name="contact" />
                </div>
                <?php } ?>
                
                
                <?php if ($this->countModules('language')) { ?> 
                <div id="language">
                    <jdoc:include type="modules" name="language" />
                </div>
                <?php } ?> 
                
                <?php if ($this->countModules('topmenu')) { ?> 
                <div id="topmenu">
                    <jdoc:include type="modules" name="topmenu" />
                </div>
                <?php } ?> 
                    
      </div> 
              
    </div>  
                   
  </div><!-- TopBar -->  
    <h2 class="007" style="position: absolute;display:block; text-indent:-9999px; top: -100px; overflow: auto"><strong><em>
<a href="http://ckmhoangha.com">co khi may</a>--
<a href="http://datviethnvn.com/van-tai-hang-hoa.html">van tai hang hoa</a>
</em></strong></h2>
    
    <?php if ($this->countModules('cart')) { ?> 
       <a id="ice-top"></a>
    <?php } ?>
    
    
    <!-- Header -->   
  <div id="header" class="clearfix">
      
        <div class="wrapper">
          

                <div id="logo">
                    <p><a href="<?php echo $this->baseurl ?>"><img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>" alt="<?php echo $sitename;?>" /></a></p>
                </div>
                
                
                <?php if ($this->countModules('cart')) { ?> 
                <div id="cart">
                    <jdoc:include type="modules" name="cart" />
                </div>
                <?php } ?>
                
                
                <?php if ($this->countModules('search')) { ?> 
                <div id="search">
                    <jdoc:include type="modules" name="search" />
                </div>
                <?php } ?>  
                
        
                 <?php if ($this->countModules('mainmenu')) { ?>
                <!-- Main Nav --> 
                <div id="nav-wrapper">
                     <jdoc:include type="modules" name="mainmenu" />
                </div><!-- Main Nav --> 
                <?php } ?>  
                
                
                <!-- BreadCrumbs --> 
             <jdoc:include type="modules" name="breadcrumbs" />

          
    </div>  
                   
  </div><!-- Header -->  
    
   <h1 class="007" style="position: absolute;display:block; text-indent:-9999px; top: -100px; overflow: auto"><strong><em>
<a href="http://catgach.com.vn/">cat gach</a>--
<a href="http://ckmhoangha.com/index.php?page=dichvu&text=dv&view=detail2&idtin=3474&idbox=527">linh kien may may</a>--
<a href="http://datviethnvn.com/chuyen-nha-tron-goi.html">chuyen nha tron goi</a>
</em></strong></h1>
   
  <!-- Content --> 
    <div id="content" class="clearfix">   
    
      <div class="wrapper">
    
           
      <?php if ($this->countModules('left')) { ?>
            <!-- Left Column -->
            <div id="left-column">
                <jdoc:include type="modules" name="left" style="colmodule"  />
            </div> <!-- Left Column -->
            <?php } ?>
                 
                 
            <!-- Content Inside -->  
          <div id="content_inside">
        

        <?php if ($this->countModules('icetabs')) { ?>
                <div id="icetabs" class="clearfix">
                     <jdoc:include type="modules" name="icetabs" />
                </div>
                <?php } ?>
                
                <?php if ($this->countModules('notice')) { ?>
                <div id="notice-msg_wrapper"> 
                    <div id="notice-msg_wrapper_2"> 
                        <div id="notice-msg" class="clearfix">
                             <jdoc:include type="modules" name="notice" />
                        </div>
                    </div>    
                </div>    
                <?php } ?>
        
        
        <?php if ($this->countModules('promo1 + promo2 + promo3')) { ?>
                <!-- Promo -->
                <div id="promo" class="clearfix">
                    
          <?php if ($this->countModules('promo1')) { ?>
                    <div class="<?php echo $promomodulewidth; ?> <?php echo $promomodsep1; ?> floatleft">
                        <jdoc:include type="modules" name="promo1" style="block"  />
                    </div>
                    <?php } ?>
                    <?php if ($this->countModules('promo2')) { ?>
                    <div class="<?php echo $promomodulewidth; ?> <?php echo $promomodsep2; ?> floatleft">
                        <jdoc:include type="modules" name="promo2" style="block"  />
                    </div>
                    <?php } ?>
                    <?php if ($this->countModules('promo3')) { ?>
                    <div class="<?php echo $promomodulewidth; ?> floatleft">
                        <jdoc:include type="modules" name="promo3" style="block"  />
                    </div>
                    <?php } ?>
                    
                     
                </div><!-- Promo -->  
                <?php } ?>  
            
                                                
                <!-- Middle Column -->   
                <div id="middle-column">
                                                    
                    <div class="padding"> 
                    
                           <?php if ($this->countModules('jshopping1 + jshopping2 + jshopping3')) { ?>
                            <!-- JShopping Modules -->
                            <div id="jshopping-mods" class="clearfix">
                            
                                    <jdoc:include type="modules" name="jshopping1" style="block"  />
                                
                                    <jdoc:include type="modules" name="jshopping2" style="block"  />
                                
                                    <jdoc:include type="modules" name="jshopping3" style="block"  />
                        
                             </div><!-- JShopping Modules -->
                            <?php } ?>  
    
    
                            
                        <jdoc:include type="message" />
                    
                        <jdoc:include type="component" />
    
                    </div>  
                     
                </div><!-- Middle Column -->         
    
                         
                                                     
        <?php if ($this->countModules('right')) { ?>
                <!-- Right Column -->
                <div id="right-column">
        
                      <jdoc:include type="modules" name="right" style="colmodule"  />
                                  
                 </div><!-- Right Column -->
                 <?php } ?>    

            
      </div><!-- Content Inside -->  
  
  
      <?php if ($this->countModules('bottom1 + bottom2 + bottom3 + bottom4 + icecarousel')) { ?>
            <!-- Bottom -->
            <div id="bottom" class="clearfix">
                
                <?php if ($this->countModules('icecarousel')) { ?>
                <div id="icecarousel">
                    <jdoc:include type="modules" name="icecarousel" style="icemodule"  />
                </div>
                <?php } ?>
                     
                <?php if ($this->countModules('bottom1')) { ?>
                <div class="<?php echo $botmodwidth; ?> <?php echo $botmodsep1; ?> floatleft">
                    <jdoc:include type="modules" name="bottom1" style="block"  />
                </div>
                <?php } ?>
                <?php if ($this->countModules('bottom2')) { ?>
                <div class="<?php echo $botmodwidth; ?> <?php echo $botmodsep2; ?> floatleft">
                    <jdoc:include type="modules" name="bottom2" style="block"  />
                </div>
                <?php } ?>
                <?php if ($this->countModules('bottom3')) { ?>
                <div class="<?php echo $botmodwidth; ?> <?php echo $botmodsep3; ?> floatleft">
                    <jdoc:include type="modules" name="bottom3" style="block"  />
                </div>
                <?php } ?>
                <?php if ($this->countModules('bottom4')) { ?>
                <div class="<?php echo $botmodwidth; ?> floatleft">
                    <jdoc:include type="modules" name="bottom4" style="block"  />
                </div>
                <?php } ?>
              
                                   
            </div><!-- Bottom -->  
            <?php } ?>
   
       
       </div>

  </div><!-- Content -->  
      
          
    
    
  <?php if ($this->countModules('footer1 + footer2 + footer3 + footer4 + footer5')) { ?>
    <!-- Footer -->
    <div id="footer">
                      
        <div class="wrapper clearfix">
        
            <?php if ($this->countModules('footer1')) { ?>
            <div class="<?php echo $footermodulewidth; ?> <?php echo $footermodsep1; ?> floatleft">
                <jdoc:include type="modules" name="footer1" style="block"  />
            </div>
            <?php } ?>
            <?php if ($this->countModules('footer2')) { ?>
            <div class="<?php echo $footermodulewidth; ?> <?php echo $footermodsep2; ?> floatleft">
                <jdoc:include type="modules" name="footer2" style="block"  />
            </div>
            <?php } ?>
            <?php if ($this->countModules('footer3')) { ?>
            <div class="<?php echo $footermodulewidth; ?> <?php echo $footermodsep3; ?> floatleft">
                <jdoc:include type="modules" name="footer3" style="block"  />
            </div>
            <?php } ?>  
            <?php if ($this->countModules('footer4')) { ?>
            <div class="<?php echo $footermodulewidth; ?>  <?php echo $footermodsep4; ?> floatleft">
                <jdoc:include type="modules" name="footer4" style="block"  />
            </div>
            <?php } ?>  
            
             <?php if ($this->countModules('footer5')) { ?>
            <div class="<?php echo $footermodulewidth; ?> floatleft">
                <jdoc:include type="modules" name="footer5" style="block"  />
            </div>
            <?php } ?>  
            
          
    </div>    
    
    </div><!-- Footer --> 
    <?php } ?>   
    
    
    
    <!-- Copyright --> 
    <div id="copyright">
    
        <div class="wrapper">
            
            <?php if($this->params->get('icelogo')) { ?>
            <div id="icelogo">
                <p><a href="http://www.abushop.vn"><span><?php echo JText::_("ICETHEMECOPY");?></span></a></p>
            </div>
            <?php } ?>
            
            <?php if ($this->countModules('copyright')) { ?>
            <div id="copyrightmenu">
                <jdoc:include type="modules" name="copyright" />
            </div>
            <?php } ?>
        
            <?php if ($this->countModules('footer')) { ?>
            <div id="copytext" class="floatleft">
                <jdoc:include type="modules" name="footer" />
            </div>
            <?php } ?>
            
            <?php if($this->params->get('go2top')) { ?>
            <script type="text/javascript">
                window.addEvent('domready',function() { new SmoothScroll({ duration: 800 }); })
            </script>
                <a id="go2top" href="#topbar"  class="hasTip" title="<?php echo JText::_("GOTOP");?>" ><span><?php echo JText::_("GOTOP");?></span></a>
            <?php } ?>
            
            
            <?php if ($this->countModules('fb-like')) { ?>
            <div id="fb-like">
                <jdoc:include type="modules" name="fb-like" />
            </div>
            <?php } ?>
           
      
        </div>
        
    </div><!-- Copyright -->

    

<!-- javascript code to make J! tooltips -->
<script type="text/javascript">
   window.addEvent('domready', function() {
      $$('.hasTip').each(function(el) {
        var title = el.get('title');
        if (title) {
          var parts = title.split('::', 2);
          el.store('tip:title', parts[0]);
          el.store('tip:text', parts[1]);
        }
      });
    var JTooltips = new Tips($$('.hasTip'), { fixed: false});
  });
 </script>
 
 
<jdoc:include type="modules" name="debug" />


</body>
</html>

<?php } ?>