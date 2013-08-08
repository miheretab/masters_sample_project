<div class="branches view">
<h2><?php  echo __('Branch');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($branch['Branch']['specific_place'].', '.$branch['Branch']['city'].', Ethiopia'); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Services');?></h3>
	<?php $hasFoodService = false; if (!empty($branch['Service'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Service Type'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($branch['Service'] as $service): if($service['service_type_id'] == 1) $hasFoodService = true; ?>
		<tr>
			<td><?php echo $service['id'];?></td>
			<td><?php echo $service['name'];?></td>
			<td><?php echo $service['ServiceType']['type'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<?php if($hasFoodService) { ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Food And Drinks Menu'), array('controller' => 'Services', 'action' => 'menu', $branch['Branch']['id'])); ?></li>	
	</ul>
</div>
<?php } ?>