<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>
            <div class="ct-horizontal-login">
<?php if ($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting">
	<?php if($params->get('name') == 0) : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
	} else : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
	} endif; ?>
	</div>
<?php endif; ?>
	<div class="logout-button">
		<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGOUT'); ?>" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
        <div style="clear:both;"></div>
</form>
<?php else : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" >
    <div class="ct-horizontal-wrap">
	<div id="form-login-username" class="ct-horizontal-input">
		<input id="modlgn-username" type="text" name="username" class="inputbox"  size="18" value="<?php echo htmlentities(JText::_('MOD_LOGIN_VALUE_USERNAME'), ENT_QUOTES, 'UTF-8');?>" onfocus="if(this.value=='<?php echo addslashes(JText::_('MOD_LOGIN_VALUE_USERNAME'))?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo addslashes(JText::_('MOD_LOGIN_VALUE_USERNAME')); ?>';}"/>
	</div>
	<div id="form-login-password" class="ct-horizontal-input">
		<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18"  value="<?php echo htmlentities(JText::_('JGLOBAL_PASSWORD'), ENT_QUOTES, 'UTF-8');?>" onfocus="if(this.value=='<?php echo addslashes(JText::_('JGLOBAL_PASSWORD'))?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo addslashes(JText::_('JGLOBAL_PASSWORD')); ?>';}"/>
	</div>
	<?php if (isset($twofactormethods) && count($twofactormethods) > 1): ?>
	<div id="form-login-secretkey" class="ct-horizontal-input">
                <input id="modlgn-secretkey" type="text" name="secretkey" class="inputbox" tabindex="0" size="18" value="<?php echo htmlentities(JText::_('JGLOBAL_SECRETKEY'), ENT_QUOTES, 'UTF-8');?>" onfocus="if(this.value=='<?php echo addslashes(JText::_('JGLOBAL_SECRETKEY'))?>'){this.value='';}" onblur="if(this.value==''){this.value='<?php echo addslashes(JText::_('JGLOBAL_SECRETKEY')); ?>';}"/>
        </div>
        <?php endif; ?>
        
	<input type="submit" name="Submit" class="button ct-horizontal-login-button" value="<?php echo JText::_('JLOGIN') ?>" />
        <div style="clear:both;"></div>
    </div>
    <input type="hidden" name="option" value="com_users" />
    <input type="hidden" name="task" value="user.login" />
    <input type="hidden" name="return" value="<?php echo $return; ?>" />
    <?php echo JHtml::_('form.token'); ?>
</form>
<?php endif; ?>
            </div>
            <div style="clear:both;" class="ct-clear-both-horz"></div>
