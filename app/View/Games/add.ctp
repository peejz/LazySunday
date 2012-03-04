<div class="games form">
<?php echo $this->Form->create('Game');?>
	<fieldset>
		<legend><?php echo __('Add Game'); ?></legend>
	<?php
		echo $this->Form->input('data'); ?>
        <?php echo 'Jogadores a convidar:'; ?>
		<table>
            <?php foreach($players as $key => $player): ?>
            <tr>
                <td width="20"><?php echo $this->Form->checkbox('jogador'.$key); ?></td>
                <td><?php echo $player; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Games'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Goals'), array('controller' => 'goals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Goal'), array('controller' => 'goals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invites'), array('controller' => 'invites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invite'), array('controller' => 'invites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
