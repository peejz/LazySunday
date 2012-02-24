<div class="games view">
<h2><?php  echo __('Game');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($game['Game']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($game['Game']['data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resultado'); ?></dt>
		<dd>
			<?php echo h($game['Game']['resultado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo h($game['Game']['estado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($game['Game']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($game['Game']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Game'), array('action' => 'edit', $game['Game']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Game'), array('action' => 'delete', $game['Game']['id']), null, __('Are you sure you want to delete # %s?', $game['Game']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Games'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Game'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invites'), array('controller' => 'invites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invite'), array('controller' => 'invites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Goals'), array('controller' => 'goals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Goal'), array('controller' => 'goals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Invites');?></h3>
	<?php if (!empty($game['Invite'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $game['Invite']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Game Id');?></dt>
		<dd>
	<?php echo $game['Invite']['game_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Disponivel');?></dt>
		<dd>
	<?php echo $game['Invite']['disponivel'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Invite'), array('controller' => 'invites', 'action' => 'edit', $game['Invite']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Goals');?></h3>
	<?php if (!empty($game['Goal'])):?>
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
		foreach ($game['Goal'] as $goal): ?>
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
	<h3><?php echo __('Related Teams');?></h3>
	<?php if (!empty($game['Team'])):?>
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
		foreach ($game['Team'] as $team): ?>
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
