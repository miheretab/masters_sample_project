<div class="serviceTypes form">
<?php echo $this->Form->create('ServiceType');?>
	<fieldset>
		<legend><?php echo __('Edit Service Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ServiceType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ServiceType.id'))); ?></li>
	</ul>
</div>
