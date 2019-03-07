<?php
/**
* @version   $Id: styledeclaration.php 10003 2013-05-02 15:11:18Z kevin $
 * @author		RocketTheme http://www.rockettheme.com
 * @copyright 	Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureStyleDeclaration extends GantryFeature {
	var $_feature_name = 'styledeclaration';

	function isEnabled() {
		global $gantry;
		$menu_enabled = $this->get('enabled');

		if (1 == (int)$menu_enabled) return true;
		return false;
	}

	function init() {
		global $gantry;
		$browser = $gantry->browser;

        // Colors
	$lessVariables = array(
                'sitebackground'     => $gantry->get('sitebackground',       '#F0F0F0'),
		'linkcolor'          => $gantry->get('linkcolor',            '#3399aa'),
                'linkcolorhover'     => $gantry->get('linkcolorhover',       '#227799'),
                'buttonbackgroundcolor'    => $gantry->get('buttonbackgroundcolor',      '#ffffff'),
                'buttontextcolor'    => $gantry->get('buttontextcolor',      '#ffffff'),
            
                'toplinkcolor'          => $gantry->get('toplinkcolor',            '#3399aa'),
                'toplinkcolorhover'     => $gantry->get('toplinkcolorhover',       '#227799'),
                'topbuttontextcolor'    => $gantry->get('topbuttontextcolor',      '#ffffff'),
                'topBorderColor'        => $gantry->get('topBorderColor',          '#252525'),
            
                'showcaselinkcolor'          => $gantry->get('showcaselinkcolor',            '#3399aa'),
                'showcaselinkcolorhover'     => $gantry->get('showcaselinkcolorhover',       '#227799'),
                'showcasebuttontextcolor'    => $gantry->get('showcasebuttontextcolor',      '#ffffff'),
            
                'menubackgroundcolor'        => $gantry->get('menubackgroundcolor',          '#4c6d34'),
                
                'featurelinkcolor'          => $gantry->get('featurelinkcolor',            '#3399aa'),
                'featurelinkcolorhover'     => $gantry->get('featurelinkcolorhover',       '#227799'),
                'featurebuttontextcolor'    => $gantry->get('featurebuttontextcolor',      '#ffffff'),
            
                'utilitylinkcolor'          => $gantry->get('utilitylinkcolor',            '#3399aa'),
                'utilitylinkcolorhover'     => $gantry->get('utilitylinkcolorhover',       '#227799'),
                'utilitybuttontextcolor'    => $gantry->get('utilitybuttontextcolor',      '#ffffff'),
                'utilityBackgroundColor'    => $gantry->get('utilityBackgroundColor',      '#000032'),
                'footerBackgroundColor'    => $gantry->get('footerBackgroundColor',      '#000032'),
            
                'maintoplinkcolor'          => $gantry->get('maintoplinkcolor',            '#3399aa'),
                'maintoplinkcolorhover'     => $gantry->get('maintoplinkcolorhover',       '#227799'),
                'maintopbuttontextcolor'    => $gantry->get('maintopbuttontextcolor',      '#ffffff'),
            
                'bottomlinkcolor'          => $gantry->get('bottomlinkcolor',            '#3399aa'),
                'bottomlinkcolorhover'     => $gantry->get('bottomlinkcolorhover',       '#227799'),
                'bottombuttontextcolor'    => $gantry->get('bottombuttontextcolor',      '#fff'),
            
                'footerlinkcolor'          => $gantry->get('footerlinkcolor',            '#3399aa'),
                'footerlinkcolorhover'     => $gantry->get('footerlinkcolorhover',       '#227799'),
                'footerbuttontextcolor'    => $gantry->get('footerbuttontextcolor',      '#fff'),
            
                'copyrightlinkcolor'          => $gantry->get('copyrightlinkcolor',            '#3399aa'),
                'copyrightlinkcolorhover'     => $gantry->get('copyrightlinkcolorhover',       '#227799'),
                'copyrightbuttontextcolor'    => $gantry->get('copyrightbuttontextcolor',      '#fff'),
            
		'headerstyle'        => $gantry->get('headerstyle',          'dark'),
                'featureBackground'  => $gantry->get('featureBackground',            '#C850C8'),
                'showcasebackground' => $gantry->get('showcasebackground',   '#fafafa'),
                'showcasetext'       => $gantry->get('showcasetext',         '#405060'),
                'showcasetitle'      => $gantry->get('showcasetitle',        '#405060'),
                'showcase-accent'    => $gantry->get('showcase-accent',      '#FF0000'),
                'mainbackground'     => $gantry->get('mainbackground',       '#fafafa'),
                'bodytext'           => $gantry->get('bodytext',             '#405060'),
                'bodytextlight'      => $gantry->get('bodytextlight',        '#aaaaaa'),
                'bodytitle'          => $gantry->get('bodytitle',            '#405060'),
                'maintopbackground'  => $gantry->get('maintopbackground',    '#3399aa'),
                'darkbackground'     => $gantry->get('darkbackground',       '#fafafa'),
                'menuItemRadius'     => $gantry->get('menuItemRadius',       '50%'),
                'backgroundslider' => $gantry->get('backgroundslider',    1),
                'featureModuleHeight'=> $gantry->get('featureModuleHeight', 'auto'),
                'featureModulesTitleColor'=> $gantry->get('featureModulesTitleColor', '#405060'),
                'featureModulesTextColor'=> $gantry->get('featureModulesTextColor', '#405060'),
                'featureFirstTitleColor'=> $gantry->get('featureFirstTitleColor', '#405060'),
                'featureFirstTextColor'=> $gantry->get('featureFirstTextColor', '#405060'),
                'utilityModulesTitleColor'=> $gantry->get('utilityModulesTitleColor', '#fafafa'),
                'utilityModulesTextColor'=> $gantry->get('utilityModulesTextColor', '#405060'),
                'utilityModulesBackgroundColor'=> $gantry->get('utilityModulesBackgroundColor', '#fafafa'),
                'breadcrumbBackgroundColor'=> $gantry->get('breadcrumbBackgroundColor', '#C80000'),
            
                'breadcrumbLinkColor'=> $gantry->get('breadcrumbLinkColor', '#ffffff'),
                'breadcrumbLinkHoverColor'=> $gantry->get('breadcrumbLinkHoverColor', '#ffffff'),
                'breadcrumbTextColor'=> $gantry->get('breadcrumbTextColor', '#405060'),
            
                'maintopGradientLeftColor'=> $gantry->get('maintopGradientLeftColor', '#FF5AC8'),
                'maintopGradientRightColor'=> $gantry->get('maintopGradientRightColor', '#00AAFF'),
                'maintopTitleColor'=> $gantry->get('maintopTitleColor', '#405060'),
                'maintopTextColor'=> $gantry->get('maintopTextColor', '#405060'),
            
                'bottomBackgroundColor'=> $gantry->get('bottomBackgroundColor', '#E6FFFF'),
                'bottombackground'=> $gantry->get('bottombackground', '#fafafa'),
            
                'bottomModuleHeight'=> $gantry->get('bottomModuleHeight', 'auto'),
                'footerModuleHeight'=> $gantry->get('footerModuleHeight', 'auto'),
            
                'bottomModulesTitleColor'=> $gantry->get('bottomModulesTitleColor', '#405060'),
                'bottomModulesTextColor'=> $gantry->get('bottomModulesTextColor', '#405060'),
                'bottomFirstTitleColor'=> $gantry->get('bottomFirstTitleColor', '#405060'),
                'bottomFirstTextColor'=> $gantry->get('bottomFirstTextColor', '#405060'),
                
                'footerModulesTitleColor'=> $gantry->get('footerModulesTitleColor', '#ffffff'),
                'footerModulesTextColor'=> $gantry->get('footerModulesTextColor', '#ffffff'),
            
                'copyrightBackgroundColor'=> $gantry->get('copyrightBackgroundColor', '#111111'),
            
                'copyrightTitlesColor'=> $gantry->get('copyrightTitlesColor', '#405060'),
                'copyrightTextColor'=> $gantry->get('copyrightTextColor', '#999999'),
            
                'formsBorderFocusColor'=> $gantry->get('formsBorderFocusColor', '#227799'),
                'modulethemebackgroundcolor1'          => $gantry->get('modulethemebackgroundcolor1',            '#7a8fa3'),
                'modulethemefontcolor1'          => $gantry->get('modulethemefontcolor1',            '#ffffff'),
                'modulethemelinkcolor1'          => $gantry->get('modulethemelinkcolor1',            '#333333'),
                'modulethemelinkcolorhover1'          => $gantry->get('modulethemelinkcolorhover1',            '#f07548'),
                'modulethemebackgroundcolor2'          => $gantry->get('modulethemebackgroundcolor2',            '#7a8fa3'),
                'modulethemefontcolor2'          => $gantry->get('modulethemefontcolor2',            '#ffffff'),
                'modulethemelinkcolor2'          => $gantry->get('modulethemelinkcolor2',            '#333333'),
                'modulethemelinkcolorhover2'          => $gantry->get('modulethemelinkcolorhover2',            '#f07548'),
                'modulethemebackgroundcolor3'          => $gantry->get('modulethemebackgroundcolor3',            '#7a8fa3'),
                'modulethemefontcolor3'          => $gantry->get('modulethemefontcolor3',            '#ffffff'),
                'modulethemelinkcolor3'          => $gantry->get('modulethemelinkcolor3',            '#333333'),
                'modulethemelinkcolorhover3'          => $gantry->get('modulethemelinkcolorhover3',            '#f07548'),
                'modulethemetitlecolor1'          => $gantry->get('modulethemetitlecolor1',            '#444444'),
                'modulethemetitlecolor2'          => $gantry->get('modulethemetitlecolor2',            '#444444'),
                'modulethemetitlecolor3'          => $gantry->get('modulethemetitlecolor3',            '#444444')
	);
        
        $gantry->addLess('global.less', 'master.css', 8, $lessVariables);
        
        // Logo
	$css = $this->buildLogo();
        
	$this->_disableRokBoxForiPhone();

	$gantry->addInlineStyle($css);
        //$gantry->addInlineStyle($csssmall);
        
        
        
	if ($gantry->get('layout-mode')=="responsive") $gantry->addLess('mediaqueries.less');
	if ($gantry->get('layout-mode')=="960fixed") $gantry->addLess('960fixed.less');
	if ($gantry->get('layout-mode')=="1200fixed") $gantry->addLess('1200fixed.less');
	}

	function buildLogo(){
		global $gantry;

		if ($gantry->get('logo-type')!="custom") return "";

		$source = $width = $height = "";

		$logo = str_replace("&quot;", '"', str_replace("'", '"', $gantry->get('logo-custom-image')));
		$data = json_decode($logo);

		if (!$data){
			if (strlen($logo)) $source = $logo;
			else return "";
		} else {
			$source = $data->path;
		}

		if (substr($gantry->baseUrl, 0, strlen($gantry->baseUrl)) == substr($source, 0, strlen($gantry->baseUrl))){
			$file = JPATH_ROOT . '/' . substr($source, strlen($gantry->baseUrl));
		} else {
			$file = JPATH_ROOT . '/' . $source;
		}

		if (isset($data->width) && isset($data->height)){
			$width = $data->width;
			$height = $data->height;
		} else {
			$size = @getimagesize($file);
			$width = $size[0];
			$height = $size[1];
		}

		if (!preg_match('/^\//', $source))
		{
			$source = JURI::root(true).'/'.$source;
		}

		$output = "";
                $output .= "#rt-logo-img {display: none;}"."\n";
		$output .= "#rt-logo {background: url(".$source.") 50% 0 no-repeat !important;}"."\n";
		$output .= "#rt-logo {width: ".$width."px;height: ".$height."px;}"."\n";
                $output .= ".logo-block {width: auto !important; height: auto !important;}"."\n";
                
		$file = preg_replace('/\//i', DIRECTORY_SEPARATOR, $file);

		if (file_exists($file)){
                    $gantry->addInlineScript('
                        jQuery(document).ready(
                            function(){
                                jQuery("#rt-logo-img").get(0).src="'.$source.'";
                        });
                        '."\n");
                }
	}

	function _createGradient($direction, $from, $fromOpacity, $fromPercent, $to, $toOpacity, $toPercent){
		global $gantry;
		$browser = $gantry->browser;

		$fromColor = $this->_RGBA($from, $fromOpacity);
		$toColor = $this->_RGBA($to, $toOpacity);
		$gradient = $default_gradient = '';

		$default_gradient = 'background: linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';

		switch ($browser->engine) {
			case 'gecko':
			$gradient = ' background: -moz-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
			break;

			case 'webkit':
			if ($browser->shortversion < '5.1'){

				switch ($direction){
					case 'top':
					$from_dir = 'left top'; $to_dir = 'left bottom'; break;
					case 'bottom':
					$from_dir = 'left bottom'; $to_dir = 'left top'; break;
					case 'left':
					$from_dir = 'left top'; $to_dir = 'right top'; break;
					case 'right':
					$from_dir = 'right top'; $to_dir = 'left top'; break;
				}
				$gradient = ' background: -webkit-gradient(linear, '.$from_dir.', '.$to_dir.', color-stop('.$fromPercent.','.$fromColor.'), color-stop('.$toPercent.','.$toColor.'));';
			} else {
				$gradient = ' background: -webkit-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
			}
			break;

			case 'presto':
			$gradient = ' background: -o-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
			break;

			case 'trident':
			if ($browser->shortversion >= '10'){
				$gradient = ' background: -ms-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
			} else if ($browser->shortversion <= '6'){
				$gradient = $from;
				$default_gradient = '';
			} else {

				$gradient_type = ($direction == 'left' || $direction == 'right') ? 1 : 0;
				$from_nohash = str_replace('#', '', $from);
				$to_nohash = str_replace('#', '', $to);

				if (strlen($from_nohash) == 3) $from_nohash = str_repeat(substr($from_nohash, 0, 1), 6);
				if (strlen($to_nohash) == 3) $to_nohash = str_repeat(substr($to_nohash, 0, 1), 6);

				if ($fromOpacity == 0 || $fromOpacity == '0' || $fromOpacity == '0%') $from_nohash = '00' . $from_nohash;
				if ($toOpacity == 0 || $toOpacity == '0' || $toOpacity == '0%') $to_nohash = '00' . $to_nohash;

				$gradient = " filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#".$to_nohash."', endColorstr='#".$from_nohash."',GradientType=".$gradient_type." );";

				$default_gradient = '';

			}
			break;

			default:
			$gradient = $from;
			$default_gradient = '';
			break;
		}

		return  $default_gradient . $gradient;
	}

	function _HEX2RGB($hexStr, $returnAsString = false, $seperator = ','){
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
		$rgbArray = array();

		if (strlen($hexStr) == 6){
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
		} elseif (strlen($hexStr) == 3){
			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		} else {
			return false;
		}

		return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
	}

	function _RGBA($hex, $opacity){
		return 'rgba(' . $this->_HEX2RGB($hex, true) . ','.$opacity.')';
	}

	function _disableRokBoxForiPhone() {
		global $gantry;

		if ($gantry->browser->platform == 'iphone' || $gantry->browser->platform == 'android') {
			$gantry->addInlineScript("window.addEvent('domready', function() {\$\$('a[rel^=rokbox]').removeEvents('click');});");
		}
	}
}
