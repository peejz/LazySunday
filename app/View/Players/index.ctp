<div class="players index">
	<h2><?php echo __('Players');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nome');?></th>
			<th><?php echo $this->Paginator->sort('presencas');?></th>
			<th><?php echo $this->Paginator->sort('ranking');?></th>
			<th><?php echo $this->Paginator->sort('vitorias');?></th>
			<th><?php echo $this->Paginator->sort('golos');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($players as $player): ?>
	<tr>
		<td><?php echo h($player['Player']['id']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['nome']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['presencas']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['ranking']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['vitorias']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['golos']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['created']); ?>&nbsp;</td>
		<td><?php echo h($player['Player']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $player['Player']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $player['Player']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $player['Player']['id']), null, __('Are you sure you want to delete # %s?', $player['Player']['id'])); ?>
		</td>
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
		<li><?php echo $this->Html->link(__('New Player'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Goals'), array('controller' => 'goals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Goal'), array('controller' => 'goals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invites'), array('controller' => 'invites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invite'), array('controller' => 'invites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
