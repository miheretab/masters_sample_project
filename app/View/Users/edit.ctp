<div class="users form">
<?php echo $this->Form->create('User', array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('company');
		echo $this->Form->input('website');
		if(isset($user['photo'])) { echo $this->Html->image($user['photo'], array('class' => 'pic', 'height' => "186", 'width' => "153"));
	?>
		<br /><br />
	<?php } ?>
	<?php echo $this->Form->input('pic', array('type' => 'file', 'accept' => 'image/*')); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
	</ul>
</div>
