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
			<?php echo h($branch['Branch']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($branch['User']['name'], array('controller' => 'users', 'action' => 'view', $branch['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Branch'), array('action' => 'edit', $branch['Branch']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Branch'), array('action' => 'delete', $branch['Branch']['id']), null, __('Are you sure you want to delete # %s?', $branch['Branch']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Branches'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Branch'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Services'), array('controller' => 'services', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Services');?></h3>
	<?php if (!empty($branch['Service'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Service Type Id'); ?></th>
		<th><?php echo __('IsSpecial'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($branch['Service'] as $service): ?>
		<tr>
			<td><?php echo $service['id'];?></td>
			<td><?php echo $service['name'];?></td>
			<td><?php echo $service['description'];?></td>
			<td><?php echo $service['service_type_id'];?></td>
			<td><?php echo $service['isSpecial'];?></td>
			<td><?php echo $service['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'services', 'action' => 'view', $service['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'services', 'action' => 'edit', $service['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'services', 'action' => 'delete', $service['id']), null, __('Are you sure you want to delete # %s?', $service['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Service'), array('controller' => 'services', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
