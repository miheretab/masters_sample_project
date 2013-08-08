<div class="branches form">
<?php echo $this->Form->create('Branch');?>
	<fieldset>
		<legend><?php echo __('Edit Branch'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Ajax->autoComplete('Branch.specific_place', '/branches/autoComplete');
		echo $this->Form->input('city', array('placeholder' => 'Addis Ababa'));
		echo $this->Form->input('Service');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Branch.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Branch.id'))); ?></li>
	</ul>
</div>