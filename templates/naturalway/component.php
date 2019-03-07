<?php
/**
* @version   $Id: component.php 9769 2013-04-26 17:40:14Z kevin $
 * @author RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

// load and inititialize gantry class
require_once(dirname(__FILE__) . '/lib/gantry/gantry.php');
$gantry->init();

?>
<?php if (JRequest::getString('type')=='raw'):?>
	<jdoc:include type="component" />
<?php else: ?>
<?php 
jimport('joomla.version');
$version = new JVersion();
if(version_compare($version->getShortVersion(), '3.0', '>=')){
    JHtml::_('jquery.framework');
} else {
    JHTML::_('behavior.mootools');
    JFactory::getDocument()->addScript($this->baseurl.'/templates/'.$this->template.'/js/jq.min.js');
} 
?>
	<!doctype html>
	<html xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
		<head>
			<?php if ($gantry->get('layout-mode') == '960fixed') : ?>
			<meta name="viewport" content="width=960px">
			<?php elseif ($gantry->get('layout-mode') == '1200fixed') : ?>
			<meta name="viewport" content="width=1200px">
			<?php else : ?>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                                $gantry->addInlineStyle("\nh1,h2,h3,h4,h5,h6,.title { font-family: '" . $name . "', 'Helvetica', arial, sans-serif; font-weight: " . $gantry->get('font1-weight1') . "; }\n");

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

                                $gantry->addInlineStyle("\nbody { font-family: '" . $name . "', 'Helvetica', arial, sans-serif; font-weight: " . $gantry->get('font2-weight2') . "; }\n");

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

                                $gantry->addInlineStyle("\n.gf-menu, .gf-menu .item, .breadcrumb { font-family: '" . $name . "', 'Helvetica', arial, sans-serif; font-weight: " . $gantry->get('font3-weight3') . ";}\n");

                                // Family3 Menu End
                                
				$gantry->addLess('bootstrap.less', 'bootstrap.css', 6);
			?>
		</head>
		<body class="component-body">
			<div class="component-content">
		    	<jdoc:include type="message" />
				<jdoc:include type="component" />
			</div>
		</body>
	</html>
<?php endif; ?>
<?php
$gantry->finalize();
?>
