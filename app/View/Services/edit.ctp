<script language="javascript">
$(document).ready(function () {
	checkFood();

});
function checkFood() {
	if($('#ServiceServiceTypeId').val() == 1) {
		$("#special").show();
	}
	else {
		$("#special").hide();
	}
}
</script>
<div class="services form">
<?php echo $this->Form->create('Service');?>
	<fieldset>
		<legend><?php echo __('Edit Service'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description', array('type' => 'textarea'));
		echo $this->Form->input('service_type_id', array('onchange' => 'return checkFood();'));
		echo $this->Form->input('price');
		echo $this->Form->input('currency'); ?>
		<div id="special"><?php echo $this->Form->input('isSpecial', array('label' => 'Is this special Food?'));?></div>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Service.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Service.id'))); ?></li>
	</ul>
</div>
