<div class="serviceTypes form">
<?php echo $this->Form->create('ServiceType');?>
	<fieldset>
		<legend><?php echo __('Add Service Type'); ?></legend>
	<?php
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
