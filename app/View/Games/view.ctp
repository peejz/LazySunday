<div class="actions2">
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

<div class="games view2">
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






    <div class="invited">
    <h2><?php  echo __('Invited');?></h2>
    <?php //echo $this->Html->nestedList($invites); ?>
    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th>Status</th>
            <th>Player</th>
            <th>Joga?</th>

        </tr>
        <?php   echo $this->Form->Create(null, array('controller' => 'games', 'action' => 'updateInvites', 'url' => '/games/updateInvites/'.$game['Game']['id'])); ?>
        <?php   //echo $this->Form->input('gameid', array('value' =>$game['Game']['id'], 'type' => 'hidden' )); ?>
        <?php foreach($invites as $invite): ?>

        <?php   $options = array('1' => 'sim', '0' => 'não');
                //$answered = $invite['Invite']['answered'];
                $answered = !is_null($invite['Invite']['available']);
                $valor = false;
                if($answered) {
                    if($invite['Invite']['available']) $valor = true;
                } else {
                    $valor = null;
                }
                $attributes = array('legend' => false, 'value' => $valor, 'separator' => ''); ?>
        <tr>
            <td><?php

                if($valor) {$icon = 'available.png';}
                else if(is_null($valor)) { $icon = 'default.png';}
                else {$icon = 'not_available.png';}

                echo $this->Html->image($icon, array('alt' => 'CakePHP')); ?></td>
            <td><?php echo $invite['Player']['nome']; ?></td>
            <td><?php echo $this->Form->radio('jogador'.$invite['Player']['id'], $options, $attributes); ?></td>

        </tr>
        <?php endforeach; ?>

    </table>
    <?php echo $this->Form->end('Submit'); ?>
    </div>





    <div class="notinvited">
    <h2><?php  echo __('Not Invited');?></h2>
    <table>
        <tr>
            <th>Convidar</th>
            <th>Jogador</th>
        </tr>
        <?php echo $this->Form->Create(null, array('url' => '/games/addInvites/'.$game['Game']['id'])); ?>
        <?php foreach($notinvited as $key => $player): ?>

        <tr>
            <td width="20"><?php echo $this->Form->checkbox('jogador'.$key); ?></td>
            <td><?php echo $player; ?></td>
        </tr>
        <?php endforeach; ?>
        <tr><td><?php echo $this->Form->end('Adicionar Jogador(es)'); ?></td><td></td></tr>
    </table>
    </div>



