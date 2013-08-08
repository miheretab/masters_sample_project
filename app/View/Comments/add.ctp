<div class="comments form">
<?php echo $this->Form->create('Comment');?>
	<fieldset>
		<legend><?php echo __('Post Comment'); ?></legend>
	<?php
		echo $this->Form->input('content', array('type' => 'textarea', 'label' => 'Comment'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
