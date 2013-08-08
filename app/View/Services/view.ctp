<div class="services view">
<h2><?php  echo __('Service');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($service['Service']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($service['Service']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($service['Service']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Type'); ?></dt>
		<dd>
			<?php echo $service['ServiceType']['type']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($service['Service']['currency'].' '.$service['Service']['price']); ?>
			&nbsp;
		</dd>		
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($service['Service']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

