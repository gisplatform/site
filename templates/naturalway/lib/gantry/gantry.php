<?php
/**
 * @version   $Id: gantry.php 5318 2012-11-20 23:07:37Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();
global $gantry;

$gantry_lib_path = JPATH_SITE . '/libraries/gantry/gantry.php';
if (!file_exists($gantry_lib_path)) {
    ob_end_clean();
?>
<html>
    <head></head>
    <body>
        Don't worry, you are almost there! This message just means, that the template installed but the Gantry Framework couldn't be downloaded at the installation. Please download (free, no charge) and install the "Gantry Framework from here:
        <br/><br/>
        <a href="http://crosstec.de/gantry.zip">http://crosstec.de/gantry.zip</a>
        We might have modified this version of Gantry, for example to make it work with Joomla! 3.2 early enough to make your updates smooth.
        The original version is always found at <a href=">http://www.gantry-framework.org">>http://www.gantry-framework.org</a
        <br/><br/>
        After installation, re-visit your website and you should see the site with the right template styles and fully functional. You can at any time restore your previous template in your Joomla! administration.
        <br/><br/>
        This template is based on the Gantry Framework from RocketTheme, LLC and brings a bunch of hot features to your template that otherwise wouldn't be possible in that quality. Thank you for your understanding.
    </body>
</html>
<?php
    die;
}
$backtrace = debug_backtrace();
$gantry_calling_file = $backtrace[0]['file'];
include($gantry_lib_path);