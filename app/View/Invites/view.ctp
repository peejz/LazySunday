<div class="invites view">
<h2><?php  echo __('Invite');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($invite['Invite']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Game'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invite['Game']['data'], array('controller' => 'games', 'action' => 'view', $invite['Game']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Disponivel'); ?></dt>
		<dd>
			<?php echo h($invite['Invite']['disponivel']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Invite'), array('action' => 'edit', $invite['Invite']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Invite'), array('action' => 'delete', $invite['Invite']['id']), null, __('Are you sure you want to delete # %s?', $invite['Invite']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Invites'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invite'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Games'), array('controller' => 'games', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Game'), array('controller' => 'games', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Players'), array('controller' => 'players', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Player'), array('controller' => 'players', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Players');?></h3>
	<?php if (!empty($invite['Player'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th><?php echo __('Presencas'); ?></th>
		<th><?php echo __('Ranking'); ?></th>
		<th><?php echo __('Vitorias'); ?></th>
		<th><?php echo __('Golos'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($invite['Player'] as $player): ?>
		<tr>
			<td><?php echo $player['id'];?></td>
			<td><?php echo $player['nome'];?></td>
			<td><?php echo $player['presencas'];?></td>
			<td><?php echo $player['ranking'];?></td>
			<td><?php echo $player['vitorias'];?></td>
			<td><?php echo $player['golos'];?></td>
			<td><?php echo $player['created'];?></td>
			<td><?php echo $player['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'players', 'action' => 'view', $player['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'players', 'action' => 'edit', $player['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'players', 'action' => 'delete', $player['id']), null, __('Are you sure you want to delete # %s?', $player['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Player'), array('controller' => 'players', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
