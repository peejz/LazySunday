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
		<li><?php echo $this->Html->link(__('List Goals'), array('controller' => 'goals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Goal'), array('controller' => 'goals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invites'), array('controller' => 'invites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invite'), array('controller' => 'invites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php echo __('Related Invites');?></h3>
	<?php if (!empty($game['Invite'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Game Id'); ?></th>
		<th><?php echo __('Player Id'); ?></th>
		<th><?php echo __('Available'); ?></th>

		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($game['Invite'] as $invite): ?>
		<tr>
			<td><?php echo $invite['id'];?></td>
			<td><?php echo $invite['game_id'];?></td>
			<td><?php echo $invite['player_id'];?></td>
			<td><?php echo $invite['available'];?></td>

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
    <?php //echo $this->Html->nestedList($invites); ?>
    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th>Player</th>
            <th>Joga?</th>
            <th></th>
        </tr>
        <?php   echo $this->Form->Create(null, array('controller' => 'games', 'action' => 'updateInvites', 'url' => '/games/updateInvites/'.$game['Game']['id'])); ?>
        <?php   //echo $this->Form->input('gameid', array('value' =>$game['Game']['id'], 'type' => 'hidden' )); ?>
        <?php foreach($invites as $invite): ?>

        <?php   $options = array('1' => 'Sim', '0' => 'Nao' );
                //$answered = $invite['Invite']['answered'];
                $answered = !is_null($invite['Invite']['available']);
                $valor=false;
                if($answered) {
                    if($invite['Invite']['available']) $valor = true;
                } else {
                    $valor = null;
                }
                $attributes = array('legend' => false, 'value' => $valor); ?>
        <tr>
            <td bgcolor="<?php if($valor) {echo '#33CC00';}
                                else if(is_null($valor)) {
                                    echo '#CCCCCC';
                                } else {
                                    echo '#FF0000';
                                }?>"><?php echo $invite['Player']['nome']; ?></td>
            <td ><?php echo $this->Form->radio('jogador'.$invite['Player']['id'], $options, $attributes); ?></td>
            <td></td>
        </tr>
        <?php endforeach; ?>

    </table>
    <?php echo $this->Form->end('Submit'); ?>
    <table>
        <?php foreach($notinvited as $key => $player): ?>
        <tr>
            <td width="20"><?php echo $this->Form->checkbox('jogador'.$key); ?></td>
            <td><?php echo $player; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
</div>
