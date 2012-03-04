<div class="players view">
<h2><?php  echo __('Player');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($player['Player']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($player['Player']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Presencas'); ?></dt>
		<dd>
			<?php echo h($player['Player']['presencas']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ranking'); ?></dt>
		<dd>
			<?php echo h($player['Player']['ranking']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vitorias'); ?></dt>
		<dd>
			<?php echo h($player['Player']['vitorias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Golos'); ?></dt>
		<dd>
			<?php echo h($player['Player']['golos']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($player['Player']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($player['Player']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Player'), array('action' => 'edit', $player['Player']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Player'), array('action' => 'delete', $player['Player']['id']), null, __('Are you sure you want to delete # %s?', $player['Player']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Players'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Player'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Goals'), array('controller' => 'goals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Goal'), array('controller' => 'goals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invites'), array('controller' => 'invites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invite'), array('controller' => 'invites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Goals');?></h3>
	<?php if (!empty($player['Goal'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Player Id'); ?></th>
		<th><?php echo __('Game Id'); ?></th>
		<th><?php echo __('Golos'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($player['Goal'] as $goal): ?>
		<tr>
			<td><?php echo $goal['id'];?></td>
			<td><?php echo $goal['player_id'];?></td>
			<td><?php echo $goal['game_id'];?></td>
			<td><?php echo $goal['golos'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'goals', 'action' => 'view', $goal['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'goals', 'action' => 'edit', $goal['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'goals', 'action' => 'delete', $goal['id']), null, __('Are you sure you want to delete # %s?', $goal['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Goal'), array('controller' => 'goals', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Invites');?></h3>
	<?php if (!empty($player['Invite'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Game Id'); ?></th>
		<th><?php echo __('Player Id'); ?></th>
		<th><?php echo __('Available'); ?></th>
		<th><?php echo __('Answered'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($player['Invite'] as $invite): ?>
		<tr>
			<td><?php echo $invite['id'];?></td>
			<td><?php echo $invite['game_id'];?></td>
			<td><?php echo $invite['player_id'];?></td>
			<td><?php echo $invite['available'];?></td>
			<td><?php echo $invite['answered'];?></td>
			<td><?php echo $invite['created'];?></td>
			<td><?php echo $invite['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'invites', 'action' => 'view', $invite['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'invites', 'action' => 'edit', $invite['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'invites', 'action' => 'delete', $invite['id']), null, __('Are you sure you want to delete # %s?', $invite['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Invite'), array('controller' => 'invites', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Teams');?></h3>
	<?php if (!empty($player['Team'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Game Id'); ?></th>
		<th><?php echo __('Golos'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($player['Team'] as $team): ?>
		<tr>
			<td><?php echo $team['id'];?></td>
			<td><?php echo $team['game_id'];?></td>
			<td><?php echo $team['golos'];?></td>
			<td><?php echo $team['created'];?></td>
			<td><?php echo $team['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'teams', 'action' => 'view', $team['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'teams', 'action' => 'edit', $team['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'teams', 'action' => 'delete', $team['id']), null, __('Are you sure you want to delete # %s?', $team['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
