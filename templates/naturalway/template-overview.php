<?php
// inject jquery if joomla 2.5 to prevent js errors
jimport('joomla.version');
$version = new JVersion();
$version = $version->getShortVersion();

if(version_compare($version, '3.0', '<=')){
    JFactory::getDocument()->addScript($gantry->templateUrl.'/js/jq.min.js');
}
?>
<div class="template-preview">
	<img src="<?php echo $gantry->templateUrl;?>/template-thumb-big.png" style="max-width:323px;" />
	<h2>Key Features</h2>
	<ul>
		<li>Responsive Design supporting Phone, Tablets and Desktops</li>
                <li>Extensive Custom Colors Options</li>
		<li>Responsive Slider</li>
		<li>Flexible widgets for template customization</li>
		<li>Full extensible framework architecture</li>
		<li>XML driven and with overrides for unprecedented levels of customization</li>
		<li>Per menu-item level of control over any configuration option with inheritance</li>
                <li>And many more!</li>
	</ul>
</div>
<div class="template-description">
	<h1>Natural Way <span class="g4-version"><?php echo "1.2.1";//$gantry->_template->getVersion();?></span></h1>
	<h2>a Gantry based Joomla! template</h2>

	<p>The Natural Way template is a clean modern responsive design with stunning features such as full color control, responsive slider, and many more.</p>

        <p>Natural Way is made by Crosstec. For updates of this template frequently visit <a href="http://crosstec.de/en/joomla-templates.html">http://crosstec.de</a></p>
        
        <div style="background-color: red; background-color: rgba(255,0,0,0.3); border-radius: 8px;font-size: 18px;margin: 20px;padding: 20px;">
                  
        
        <h2>Get The Full Version!</h2>

        <p>Get the full version of this template <strong>plus all of our templates in one package</strong> for as little as <strong>$39 USD</strong> at <strong><a href="http://crosstec.de/en/joomla-templates.html?ref=Naturalway">crosstec.de</a></strong> if you want copyright removal, color setup, sliders and all the other options</p>
        
        </div>
        
	<h2>Natural Way is built upon Gantry. What is the Gantry Framework?</h2>

	<p>Gantry is a sophisticated framework with the sole intention of being the best platform to build a solid theme with.
	    Gantry takes all the lessons learned during the development of many RocketTheme Joomla templates and WordPress
	    Themes and distills that knowledge into a single super-flexible framework that is easy to configure, simple to
	    extend, and powerful enough to handle anything we want to throw at it.</p>

	<p>Get more help and find out more at <a href="http://www.gantry-framework.org/documentation/joomla">http://www.gantry-framework.org</a></p>

</div>
