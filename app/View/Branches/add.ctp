<div class="branches form">
<?php echo $this->Form->create('Branch');?>
	<fieldset>
		<legend><?php echo __('Add Branch'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Ajax->autoComplete('Branch.specific_place', '/branches/autoComplete');
		echo $this->Form->input('city', array('placeholder' => 'Addis Ababa'));
		echo $this->Form->input('Service');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
