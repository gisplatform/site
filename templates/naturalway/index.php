<?php
/**
* @version   $Id: index.php 9769 2013-04-26 17:40:14Z kevin $
 * @author RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access

defined( '_JEXEC' ) or die( 'Restricted index access' );

$jquery = '';
jimport('joomla.version');
$version = new JVersion();
if(version_compare($version->getShortVersion(), '3.0', '>=')){
    JHtml::_('jquery.framework');
} else {
    JHTML::_('behavior.mootools');
    JFactory::getDocument()->addScript($this->baseurl.'/templates/'.$this->template.'/js/jq.min.js');
}
        
// load and inititialize gantry class
require_once(dirname(__FILE__) . '/lib/gantry/gantry.php');
$gantry->init();

// get the current preset
$gpreset = str_replace(' ','',strtolower($gantry->get('name')));

if(function_exists('imagecreatefrompng') && function_exists('imagefilter')){

    jimport('joomla.filesystem.file');

    function ct_colorize_pics($sourcePath, $destPath, $r, $g, $b){

        if (@file_exists($sourcePath) && @is_readable($sourcePath) && @is_dir($sourcePath) && $handle = @opendir($sourcePath)) {

                while (false !== ($file = @readdir($handle))) {

                        $ext = strtolower(JFile::getExt($sourcePath.$file));
                    
                        if($file != "." && $file != ".." && ( $ext == 'png' || $ext == 'jpg'  || $ext == 'jpeg') ){

                            if($ext == 'png'){
                                $im = imagecreatefrompng( $sourcePath.$file );
                            }else{
                                $im = imagecreatefromjpeg( $sourcePath.$file );
                            }
                            
                            // turn off alphablending for images that are not explicetly marked to use in the filename
                            if( stripos($file, '_alphablending') === false ){
                                imagealphablending($im, false);
                            }
                            
                            imagefilter($im, IMG_FILTER_COLORIZE, intval($r), intval($g), intval($b));
                            imagesavealpha ( $im , true );
                            
                            if( stripos($file, '_multiply') !== false  ){
                            
                                if($ext == 'png'){
                                    $im2 = imagecreatefrompng( $sourcePath.$file );
                                } else {
                                    $im2 = imagecreatefromjpeg( $sourcePath.$file );
                                }
                                
                                imagelayereffect($im2, IMG_EFFECT_OVERLAY);

                                $w = imagesx($im);
                                $h = imagesy($im);
                                imagecopy($im2, $im, 0,0, 0,0, $w,$h); 
                                imagesavealpha ( $im2, true );

                                ob_start();
                                imagepng( $im2 );
                                $c = ob_get_contents();
                                ob_end_clean();
                                JFile::write( $destPath.$file, $c );

                                imagedestroy( $im );
                                imagedestroy( $im2 );
                            
                            } else {
                                
                                ob_start();
                                imagepng( $im );
                                $c = ob_get_contents();
                                ob_end_clean();
                                JFile::write( $destPath.$file, $c );
                                imagedestroy( $im );
                            }
                        }
                }
        }
    }
    
    $base_lastcolor = '';
    $lastcolor = '';
    $button_text_lastcolor = '';
    
    ####################
    
    if( JFile::exists(JPATH_SITE . '/modules/mod_ct_iconicbuttons/icons/lastcolor.txt') ){
        $base_lastcolor = JFile::read(JPATH_SITE . '/modules/mod_ct_iconicbuttons/icons/lastcolor.txt');
    }

    $r = hexdec(substr( str_replace('#','',$gantry->get('linkcolor')), 0, 2 ));
    $g = hexdec(substr( str_replace('#','',$gantry->get('linkcolor')), 2, 2 ));
    $b = hexdec(substr( str_replace('#','',$gantry->get('linkcolor')), 4, 2 ));

    if (JFile::exists(JPATH_SITE.'/modules/mod_ct_iconicbuttons/mod_ct_iconicbuttons.xml') && $gantry->get('linkcolor') != '' && $r.$g.$b != $base_lastcolor) {

        $sourcePath  = JPATH_SITE . '/modules/mod_ct_iconicbuttons/uncolored_icons/';
        $destPath    = JPATH_SITE . '/modules/mod_ct_iconicbuttons/icons/';

        ct_colorize_pics($sourcePath, $destPath, $r, $g, $b);

        $dechex = $r.$g.$b;
        JFile::write(JPATH_SITE . '/modules/mod_ct_iconicbuttons/icons/lastcolor.txt', $dechex);

    }
}
?>
<!doctype html>
<html xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
<head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<?php if ($gantry->get('layout-mode') == '960fixed') : ?>
	<meta name="viewport" content="width=960px">
	<?php elseif ($gantry->get('layout-mode') == '1200fixed') : ?>
	<meta name="viewport" content="width=1200px">
	<?php else : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="HandheldFriendly" content="true" />
        <script type="text/javascript">
        if(navigator.appVersion.indexOf("MSIE 9.")!=-1){
            document.documentElement.className += " ie9";
        } else if(navigator.appVersion.indexOf("MSIE 8.")!=-1){
            document.documentElement.className += " ie8";
        } else if(navigator.appVersion.indexOf("MSIE 7.")!=-1){
            document.documentElement.className += " ie7";
        }
        </script>
	<?php endif; ?>
    <?php
        
        $gantry->displayHead();
        
        // Family weight H1,H2...
        
        // Family1 is for the titles
    
        $font_family = $gantry->get('font1-family1');
        
        if (strpos($font_family, ':')) {
                $explode = explode(':', $font_family);

                $delimiter = $explode[0];
                $name      = $explode[1];
                $variant   = isset($explode[2]) ? $explode[2] : null;
        } else {
                $delimiter = false;
                $name      = $font_family;
                $variant   = null;
        }

        if (isset($variant) && $variant) $variant = ':' . $variant;
        else if($gantry->get('font1-weight1')){ $variant = ':' . $gantry->get('font1-weight1'); }

        switch ($delimiter) {
                // google fonts
                case 'g':
                        $variant = $variant ? $variant : '';
                        $gantry->addStyle('//fonts.googleapis.com/css?family=' . str_replace(" ", "+", $name) . $variant);
                        break;
                default:
                        break;
        }
        
        $gantry->addInlineStyle("\nh1,h2,h3,h4,h5,h6,.title,legend { font-family: '" . $name . "', 'Helvetica', arial, sans-serif; font-weight: " . $gantry->get('font1-weight1') . " !important; }\n");
        
        // Family1 Body End
       
        // Family2 is for the body
    
        $font_family = $gantry->get('font2-family2');
        
        if (strpos($font_family, ':')) {
                $explode = explode(':', $font_family);

                $delimiter = $explode[0];
                $name      = $explode[1];
                $variant   = isset($explode[2]) ? $explode[2] : null;
        } else {
                $delimiter = false;
                $name      = $font_family;
                $variant   = null;
        }

        if (isset($variant) && $variant) $variant = ':' . $variant;
        else if($gantry->get('font2-weight2')){ $variant = ':' . $gantry->get('font2-weight2'); }

        switch ($delimiter) {
                // google fonts
                case 'g':
                        $variant = $variant ? $variant : '';
                        $gantry->addStyle('//fonts.googleapis.com/css?family=' . str_replace(" ", "+", $name) . $variant);
                        break;
                default:
                        break;
        }
        
        $gantry->addInlineStyle("\nbody, input, button, select, textarea { font-family: '" . $name . "', 'Helvetica', arial, sans-serif; font-weight: " . $gantry->get('font2-weight2') . "; }\n");
        
        // Family2 Body End
        
        // Family3 is for the menu
    
        $font_family = $gantry->get('font3-family3');
        
        if (strpos($font_family, ':')) {
                $explode = explode(':', $font_family);

                $delimiter = $explode[0];
                $name      = $explode[1];
                $variant   = isset($explode[2]) ? $explode[2] : null;
        } else {
                $delimiter = false;
                $name      = $font_family;
                $variant   = null;
        }

        if (isset($variant) && $variant) $variant = ':' . $variant;
        else if($gantry->get('font3-weight3')){ $variant = ':' . $gantry->get('font3-weight3'); }
        
        switch ($delimiter) {
                // google fonts
                case 'g':
                        $variant = $variant ? $variant : '';
                        $gantry->addStyle('//fonts.googleapis.com/css?family=' . str_replace(" ", "+", $name) . $variant);
                        break;
                default:
                        break;
        }
        
        $gantry->addInlineStyle("\n.gf-menu, .gf-menu .item, .breadcrumb, [class^=\"icon-\"] { font-family: '" . $name . "', 'Helvetica', arial, sans-serif; font-weight: " . $gantry->get('font3-weight3') . ";}\n");
        
        // Family3 Menu End
        
        $gantry->addStyle('grid-responsive.css', 5);
        $gantry->addLess('bootstrap.less', 'bootstrap.css', 6);

        if ($gantry->browser->name == 'ie') {
            if ($gantry->browser->shortversion == 9) {
                $gantry->addInlineScript("if (typeof RokMediaQueries !== 'undefined') window.addEvent('domready', function(){ RokMediaQueries._fireEvent(RokMediaQueries.getQuery()); });");
            }
            if ($gantry->browser->shortversion == 8) {
                $gantry->addScript('html5shim.js');
            }
        }
        if ($gantry->get('layout-mode', 'responsive') == 'responsive')
            $gantry->addScript('rokmediaqueries.js');
        if ($gantry->get('loadtransition')) {
            $gantry->addScript('load-transition.js');
            $hidden = ' class="rt-hidden"';
        }
    ?>
        <script type="text/javascript">
        <!--
            // windows phone IE10 snap mode fix
            (function() {
                    if ("-ms-user-select" in document.documentElement.style && ( navigator.userAgent.match(/IEMobile\/10\.0/) || navigator.userAgent.match(/IEMobile\/11\.0/) ) ) {
                            var msViewportStyle = document.createElement("style");
                            msViewportStyle.appendChild(
                                    document.createTextNode("@-ms-viewport{width:auto!important}")
                            );
                            document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
                    }
            })();
        
        jQuery(document).ready(function(){
            <?php
            // to top button
            if($gantry->get('totupbutton')){
            ?>
            jQuery('body').append('<div id="toTop"><li class="icon-chevron-up"></li></div>');
            jQuery(window).scroll(function () {
                    if (jQuery(this).scrollTop() != 0) {
                            jQuery('#toTop').fadeIn();
                    } else {
                            jQuery('#toTop').fadeOut();
                    }
            });
            window.addEvent("domready",function(){var b=document.id("toTop");if(b){var a=new Fx.Scroll(window);b.setStyle("outline","none").addEvent("click",function(c){c.stop(); a.toTop();});}});
            <?php
            }
            ?>
            // viewport detection to determine if the menu should open to top or bottom  
            jQuery('.gf-menu').on('mouseover',function(){
                var win = jQuery(window);
                
                var viewport =
                {
                    top : win.scrollTop(),
                    left : win.scrollLeft()
                };

                viewport.right = viewport.left + win.width();
                viewport.bottom = viewport.top + win.height();

                var bounds = jQuery(this).offset();
                bounds.right = bounds.left + jQuery(this).outerWidth();
                bounds.bottom = bounds.top + jQuery(this).outerHeight();

                if(!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom))
                {
                    if((bounds.top-win.scrollTop()) >(win.height()/2))
                    {
                        jQuery(this).find('.dropdown').addClass('dropUp');
                        jQuery(this).addClass('dropUpMenu');
                    }
                    else
                    {
                        jQuery(this).find('.dropdown').removeClass('dropUp');
                        jQuery(this).removeClass('dropUpMenu');
                    }
                }
            });
            // level 1 max height item (autoheight others)
            function update_menu_height(){
                var max_menu_height = 0;
                jQuery('.gf-menu.l1 > li').each(
                        function(i){
                            // check by the width of the closest container if we are in 767px mode and prevent altering the menu heights
                            if(Number(jQuery(this).closest('.rt-container').css('width').replace("px","")) <= 480){ return }

                            var currheight = jQuery(this).innerHeight();
                            if(max_menu_height < currheight){
                                max_menu_height = currheight;
                            }
                            
                            if( i+1 >= jQuery('.gf-menu.l1 > li').size() ){
                                jQuery('.gf-menu.l1 > li > .item').css('display', 'table');
                                jQuery('.gf-menu.l1 > li > .item').css('height', max_menu_height+'px');
                                jQuery('.gf-menu.l1 > li > .item').css('width', '100%');
                                jQuery('.gf-menu.l1 > li > .item').css('margin', '0 auto');
                                jQuery('.gf-menu.l1 > li > .item').css('padding', '0');
                                jQuery('.gf-menu.l1 > li > .item').each(function(){
                                    jQuery(this).html( '<span style="display: table-cell;vertical-align: middle;">' + jQuery(this).html() + '</span>' );
                                });
                                var menu = jQuery(this).closest('.gf-menu');
                                jQuery(menu).css('top', -1 * Math.floor( jQuery(menu).height() / 2 )+"px");
                                if(jQuery('#rt-showcase').size() == 0){
                                    jQuery('#rt-top-surround').css('padding-bottom', Math.floor( jQuery(menu).height() / 2 ) + "px");
                                }
                            }
                        }
                );
            }
            update_menu_height();
            //jQuery(window).resize(update_menu_height);
            
            var level1_size = jQuery('.gf-menu.l1 > li').size();
            if(level1_size > 0){
                jQuery('.gf-menu.l1 > li').css('width', ( 100 / jQuery('.gf-menu.l1 > li').size() ) +'%');
            }
            
            jQuery('li[class^="item"]').mouseover(function(){
                var _dropdown = this;
                jQuery(_dropdown).find('.flyout').each(function(){
                    if(!isFullyVisible(jQuery(this))){
                        jQuery(this).addClass('flyouthorz');
                        jQuery(this).find('.flyout').addClass('flyouthorz');
                    }
                });
            });
        });
        
        function isFullyVisible (elem) {
            var off = elem.offset();
            var et = off.top;
            var el = off.left;
            var eh = elem.height();
            var ew = elem.width();
            var wh = window.innerHeight;
            var ww = window.innerWidth;
            var wx = window.pageXOffset;
            var wy = window.pageYOffset;
            return (el >= wx && el + ew <= ww);  
        }
        //-->
        </script>
        
</head>
<body <?php echo $gantry->displayBodyTag(); ?>>
    
    <?php /** Begin Top Surround **/ if ($gantry->countModules('top') or $gantry->countModules('header')) : ?>
    <header id="rt-top-surround">
		<?php /** Begin Top **/ if ($gantry->countModules('top')) : ?>
		<div id="rt-top" <?php echo $gantry->displayClassesByTag('rt-top'); ?>>
			<div class="rt-container">
				<?php echo $gantry->displayModules('top','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Top **/ endif; ?>
		<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
		<div id="rt-header">
			<div class="rt-container">
				<?php echo $gantry->displayModules('header','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Header **/ endif; ?>
        
    </header>
    <?php /** End Top Surround **/ endif; ?>
    
    <div id="ct-body">
        <?php /** Begin Showcase **/ if ($gantry->countModules('showcase')) : ?>
        <div id="ct-showcase-slider-wrap">
            <div id="ct-showcase-slider">
            </div>
        </div>
	<div id="rt-showcase">
		<div class="rt-showcase-pattern">
			<div class="rt-container">
				<?php echo $gantry->displayModules('showcase','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
        
        <?php /** End Showcase **/ endif; ?>
        
        <div id="ct-main" class="<?php echo $gantry->get('layout-mode') == '960fixed' ? 'ct-main-960' : 'ct-main-1200'; ?>">
               <div id="shadow"> 
            <?php /** Begin Menu **/ if ($gantry->countModules('menu')) : ?>
            <div id="rt-menu">
                    <div class="rt-container">
                            <?php echo $gantry->displayModules('menu','standard','standard'); ?>
                            <div class="clear"></div>
                    </div>
            </div>
            
            <?php /** End Menu **/ endif; ?>
            
            <div id="rt-transition"<?php if ($gantry->get('loadtransition')) echo $hidden; ?>>
                    <?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>
                    <div id="rt-breadcrumbs">
                            <div class="rt-container">
                                    <?php echo $gantry->displayModules('breadcrumb','standard','standard'); ?>
                                    <div class="clear"></div>
                            </div>
                    </div>
                    <?php /** End Breadcrumbs **/ endif; ?>
                  
                <div id="rt-mainbody-surround">
                
                            <?php /** Begin Drawer **/ if ($gantry->countModules('drawer')) : ?>
                           
                    <div id="rt-drawer">
                                
                                <div class="rt-container">
                                    <?php echo $gantry->displayModules('drawer','standard','standard'); ?>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <?php /** End Drawer **/ endif; ?>
                            <?php /** Begin Feature **/ if ($gantry->countModules('feature')) : ?>
                            <div id="rt-feature">
                                    <div class="rt-container">
                                            <?php echo $gantry->displayModules('feature','standard','standard'); ?>
                                            <div class="clear"></div>
                                    </div>
                                    <div id="ct-feature-divider"></div>
                            </div>

                            <?php /** End Feature **/ endif; ?>
                            <?php /** Begin Utility **/ if ($gantry->countModules('utility')) : ?>
                            <div id="rt-utility">
                                    <div class="rt-container">
                                            <?php echo $gantry->displayModules('utility','standard','standard'); ?>
                                            <div class="clear"></div>
                                    </div>
                            </div>
                            <?php /** End Utility **/ endif; ?>

                            <?php /** Begin Main Top **/ if ($gantry->countModules('maintop')) : ?>
                            <div id="rt-maintop">
                                
                                    <div class="rt-container">
                                            <?php echo $gantry->displayModules('maintop','standard','standard'); ?>
                                            <div class="clear"></div>
                                    </div>
                            </div>
                            <?php /** End Main Top **/ endif; ?>
                            <?php /** Begin Full Width**/ if ($gantry->countModules('fullwidth')) : ?>
                            <div id="rt-fullwidth">
                                    <?php echo $gantry->displayModules('fullwidth','basic','basic'); ?>
                                            <div class="clear"></div>
                                    </div>
                            <?php /** End Full Width **/ endif; ?>
                            <?php /** Begin Main Body **/ ?>
                             
                                <div id="ct-mainbody">
                                  
                                <div class="rt-container">
                                        <?php echo $gantry->displayMainbody('mainbody','sidebar','standard','standard','standard','standard','standard'); ?>
                                </div>
                            
                            <?php /** End Main Body **/ ?>
                            <?php /** Begin Main Bottom **/ if ($gantry->countModules('mainbottom')) : ?>
                            <div id="rt-mainbottom">
                                    <div class="rt-container">
                                            <?php echo $gantry->displayModules('mainbottom','standard','standard'); ?>
                                            <div class="clear"></div>
                                    </div>
                            </div>
                            <?php /** End Main Bottom **/ endif; ?>
                            <?php /** Begin Extension **/ if ($gantry->countModules('extension')) : ?>
                            <div id="rt-extension">
                                    <div class="rt-container">
                                            <?php echo $gantry->displayModules('extension','standard','standard'); ?>
                                            <div class="clear"></div>
                                    </div>
                            </div>
                            <?php /** End Extension **/ endif; ?>
                            <?php /** Begin Bottom **/ if ($gantry->countModules('bottom')) : ?>
                            <div id="rt-bottom">
                                
                                    <div class="rt-container">
                                            <?php echo $gantry->displayModules('bottom','standard','standard'); ?>
                                            <div class="clear"></div>
                                    </div>
                            </div>
                            <div id="ct-bottom-divider"></div>
                            <?php /** End Bottom **/ endif; ?>
                    </div>
            </div>
            
        </div>
        
       </div>
          
        </div>
            
	<?php /** Begin Footer Section **/ if ($gantry->countModules('footer') or $gantry->countModules('copyright')) : ?>
            <footer id="rt-footer-surround">
                    <?php /** Begin Footer **/ if ($gantry->countModules('footer')) : ?>
                    <div id="rt-footer">
                            <div class="rt-container">
                                    <?php echo $gantry->displayModules('footer','standard','standard'); ?>
                                    <div class="clear"></div>
                            </div>
                    </div>
                    <?php /** End Footer **/ endif; ?>
                    <?php /** Begin Copyright **/ if ($gantry->countModules('copyright')) : ?>
                    <div id="rt-copyright">
                            <div class="rt-container">
                                    <?php echo $gantry->displayModules('copyright','standard','standard'); ?>
                                    <div class="clear"></div>
                            </div>
                    </div>
                    <?php /** End Copyright **/ endif; ?>
            </footer>
        <?php /** End Footer Surround **/ endif; ?>
                   
	<?php /** Begin Debug **/ if ($gantry->countModules('debug')) : ?>
	<div id="rt-debug">
		<div class="rt-container">
			<?php echo $gantry->displayModules('debug','standard','standard'); ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php /** End Debug **/ endif; ?>
	<?php /** Begin Analytics **/ if ($gantry->countModules('analytics')) : ?>
	<?php echo $gantry->displayModules('analytics','basic','basic'); ?>
	<?php /** End Analytics **/ endif; ?>
        
        </div>
    
	</body>
</html>
<?php
$gantry->finalize();
?>
