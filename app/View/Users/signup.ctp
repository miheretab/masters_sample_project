<div class="users form">
<?php echo $this->Form->create('User', array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Register'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('company');
		echo $this->Form->input('website');
		echo $this->Form->input('pic', array('type' => 'file', 'accept' => 'image/*')); 
	?>
	</fieldset>
<?php echo $this->Form->end(__('Signup'));?>
</div>
