<div class="goals view">
<h2><?php  echo __('Goal');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($goal['Goal']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Player'); ?></dt>
		<dd>
			<?php echo $this->Html->link($goal['Player']['nome'], array('controller' => 'players', 'action' => 'view', $goal['Player']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Game'); ?></dt>
		<dd>
			<?php echo $this->Html->link($goal['Game']['data'], array('controller' => 'games', 'action' => 'view', $goal['Game']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Golos'); ?></dt>
		<dd>
			<?php echo h($goal['Goal']['golos']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Goal'), array('action' => 'edit', $goal['Goal']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Goal'), array('action' => 'delete', $goal['Goal']['id']), null, __('Are you sure you want to delete # %s?', $goal['Goal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Goals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Goal'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Players'), array('controller' => 'players', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Player'), array('controller' => 'players', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Games'), array('controller' => 'games', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Game'), array('controller' => 'games', 'action' => 'add')); ?> </li>
	</ul>
</div>
