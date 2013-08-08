<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = 'Tour Guide Support Application';
$loggedIn = $this->Session->check('Auth.User');
$administrator = $this->Session->read('Auth.User.group_id') == 1;
$selected = "selected";
$homeClass = "";
$serviceTypesClass = "";
$servicesClass = "";
$branchesClass = "";
$commentsClass = "";
$usersClass = "";

if($title_for_layout == "Home")
	$homeClass = $selected;
else if($title_for_layout == "ServiceTypes")
	$serviceTypesClass = $selected;
else if($title_for_layout == "Services")
	$servicesClass = $selected;	
else if($title_for_layout == "Branches")
	$branchesClass = $selected;
else if($title_for_layout == "Comments")
	$commentsClass = $selected;	
else if($title_for_layout == "Users")
	$usersClass = $selected;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('respond.min');
		echo $this->Html->script('jquery.adipoli.min');
		echo $this->Html->script('jquery.fancybox-1.3.4.pack');
		echo $this->Html->script('jquery.isotope.min');
		echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=false');
		echo $this->Html->script('jquery.gmap.min');
		echo $this->Html->script('jquery.autocomplete.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
		<ul class="menu">
			<li>
				<?php echo $this->Html->link("Home", '/', array('class'=>$homeClass)); ?>
			</li>			
		<?php //if the user login
		if($loggedIn) {
		?>
			<li><?php echo $this->Html->link('Branches', array('controller' => 'Branches', 'action' => 'index'), array('class'=>$branchesClass)); ?></li>
			<li><?php echo $this->Html->link('Services', array('controller' => 'Services', 'action' => 'index'), array('class'=>$servicesClass)); ?></li>
			<li><?php echo $this->Html->link('Comments', array('controller' => 'Comments', 'action' => 'index'), array('class'=>$commentsClass)); ?></li>
			<?php if($administrator) { ?>
				<li><?php echo $this->Html->link('ServiceTypes', array('controller' => 'ServiceTypes', 'action' => 'index'), array('class'=>$serviceTypesClass)); ?></li>
				<li><?php echo $this->Html->link('Users', array('controller' => 'Users', 'action' => 'index'), array('class'=>$usersClass)); ?></li>
		<?php }} ?>
		</ul>
		<div id="right_header">
		<?php //if the user doesn't not login
		if(!$loggedIn) {?>
			<?php echo $this->Html->link('Login', array('controller' => 'Users', 'action' => 'login'))
			 . " | " . $this->Html->link(__('Register'), array('controller' => 'Users', 'action' => 'signup')); ?>
		<?php }
		else { 
			echo "Welcome " 
			. $this->Html->link($this->Session->read('Auth.User.name'), array('controller' => 'Users', 'action' => 'edit'), array('title' => 'Profile'))
			. " | " . $this->Html->link('Logout', array('controller' => 'Users', 'action' => 'logout')); 
		} ?>
		</div>		
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link("copyright&copy;2012",
					'/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
