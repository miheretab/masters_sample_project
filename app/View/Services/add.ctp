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
		<legend><?php echo __('Add Service'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description', array('type' => 'textarea'));
		echo $this->Form->input('service_type_id', array('onchange' => 'return checkFood();'));
		echo $this->Form->input('price');
		echo $this->Form->input('currency');?>
		<div id="special"><?php echo $this->Form->input('isSpecial', array('label' => 'Is this special Food?'));?></div>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
