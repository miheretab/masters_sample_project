<?php $administrator = $this->Session->read('Auth.User.group_id') == 1; ?>
<div class="comments index">
	<h2><?php echo __('Comments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('content', 'Comment');?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'Author');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<?php if($administrator) { ?>
			<th class="actions"><?php echo __('Actions');?></th>
			<?php } ?>
	</tr>
	<?php
	foreach ($comments as $comment): ?>
	<tr>
		<td><?php echo h($comment['Comment']['id']); ?>&nbsp;</td>
		<td><?php echo h($comment['Comment']['content']); ?>&nbsp;</td>
		<td><?php echo $comment['User']['name']; ?></td>
		<td><?php echo h($comment['Comment']['created']); ?>&nbsp;</td>
		<?php if($administrator) { ?>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?>
		</td>
		<?php } ?>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Post Comment'), array('action' => 'add')); ?></li>
	</ul>
</div>
