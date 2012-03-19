<div class="actions2">
    <!--<ul>
        <li><?php /*echo $this->Html->link(__('Edit Game'), array('action' => 'edit', $game['Game']['id'])); */?> </li>
        <li><?php /*echo $this->Form->postLink(__('Delete Game'), array('action' => 'delete', $game['Game']['id']), null, __('Are you sure you want to delete # %s?', $game['Game']['id'])); */?> </li>
        <li><?php /*echo $this->Html->link(__('List Games'), array('action' => 'index')); */?> </li>
        <li><?php /*echo $this->Html->link(__('New Game'), array('action' => 'add')); */?> </li>
        <li><?php /*echo $this->Html->link(__('List Goals'), array('controller' => 'goals', 'action' => 'index')); */?> </li>
        <li><?php /*echo $this->Html->link(__('New Goal'), array('controller' => 'goals', 'action' => 'add')); */?> </li>
        <li><?php /*echo $this->Html->link(__('List Invites'), array('controller' => 'invites', 'action' => 'index')); */?> </li>
        <li><?php /*echo $this->Html->link(__('New Invite'), array('controller' => 'invites', 'action' => 'add')); */?> </li>
        <li><?php /*echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); */?> </li>
        <li><?php /*echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); */?> </li>
    </ul>-->
    <ul>
        <li><?php echo $this->Html->link(__('Admin'), array('action' => 'admin', $game['Game']['id'])); ?></li>
    </ul>

    <ul>
        <?php foreach($list_games as $game_id => $game_date):

        $game_date = date('d M, Y', strToTime($game_date));
        if($game_id == $game['Game']['id']) {
            $font_weight='bold';
        } else {
            $font_weight='normal';
        }

        ?>

            <li font-weight="<?php echo $font_weight; ?>"><?php echo $this->Html->link(__($game_date), array('action' => 'view', $game_id)); ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php if($game['Game']['estado'] == 0): ?>
<div class="games view2">
    <h2><?php echo __('Teams'); ?></h2>
    <h1><?php echo $this->Form->postLink('Aceitar', 'saveTeams', array('data' => array('game_id' => $game['Game']['id']))); ?></h1>
    
    <div>
        <?php //print_r($generatedTeams); ?>
        <table>
            <tr>
                <th>pos</th>
                <th><?php echo $generatedTeams['team_1_ranking']; ?></th>
                <th>Escuros</th>
                <th>pres</th>
            </tr>

            <?php if($generatedTeams['team_1'] != null): ?>
                <?php foreach($generatedTeams['team_1'] as $key => $player):?>
                    <tr>
                        <td><?php echo $key; ?>º</td>
                        <td><?php echo $player['ranking']; ?></td>
                        <td><?php echo $player['name']; ?></td>
                        <td><?php echo $player['presencas']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
                
        </table>
    </div>

    <div>
        <table>
            <tr>
                <th>pos</th>
                <th><?php echo $generatedTeams['team_2_ranking']; ?></th>
                <th>Escuros</th>
                <th>pres</th>
            </tr>

            <?php if($generatedTeams['team_2'] != null): ?>
                <?php foreach($generatedTeams['team_2'] as $key => $player):?>
                    <tr>
                        <td><?php echo $key; ?>º</td>
                        <td><?php echo $player['ranking']; ?></td>
                        <td><?php echo $player['name']; ?></td>
                        <td><?php echo $player['presencas']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>
    </div>


<!--<h2><?php /* echo __('Game');*/?></h2>
	<dl>
		<dt><?php /*echo __('Id'); */?></dt>
		<dd>
			<?php /*echo h($game['Game']['id']); */?>
			&nbsp;
		</dd>
		<dt><?php /*echo __('Data'); */?></dt>
		<dd>
			<?php /*echo h($game['Game']['data']); */?>
			&nbsp;
		</dd>
		<dt><?php /*echo __('Resultado'); */?></dt>
		<dd>
			<?php /*echo h($game['Game']['resultado']); */?>
			&nbsp;
		</dd>
		<dt><?php /*echo __('Estado'); */?></dt>
		<dd>
			<?php /*echo h($game['Game']['estado']); */?>
			&nbsp;
		</dd>
		<dt><?php /*echo __('Created'); */?></dt>
		<dd>
			<?php /*echo h($game['Game']['created']); */?>
			&nbsp;
		</dd>
		<dt><?php /*echo __('Modified'); */?></dt>
		<dd>
			<?php /*echo h($game['Game']['modified']); */?>
			&nbsp;
		</dd>
	</dl>-->
</div>
<?php endif; ?>

<!-----------------INVITES----------------------->
<?php if($game['Game']['estado'] != 2): ?>
<div class="invited">
    <h2><?php  echo __('Invited');?></h2>

    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th>Status</th>
            <th>Ranking</th>
            <th>Player</th>
            <th>Yes</th>
            <th>No</th>

        </tr>

        <?php   //echo $this->Form->input('gameid', array('value' =>$game['Game']['id'], 'type' => 'hidden' )); ?>
        <?php foreach($invites as $invite): ?>
        <?php   echo $this->Form->Create(null, array('controller' => 'games', 'action' => 'updateInvites', 'url' => '/games/updateInvites/'.$game['Game']['id'])); ?>
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
                else if(is_null($valor)) { $icon = 'question.png';}
                else {$icon = 'not_available.png';}

                echo $this->Html->image($icon, array('alt' => 'CakePHP')); ?></td>
            <td><?php echo $invite['Player']['ranking']; ?></td>
            <td><?php echo $invite['Player']['nome']; ?></td>
<!--            <td>--><?php //$this->Form->radio('jogador'.$invite['Player']['id'], $options, $attributes); ?><!--</td>-->
            <td><?php if($valor == false or $valor == null) {echo $this->Form->Submit('tick.png', array('name' => $invite['Player']['id'], 'value' => 1));} ?></td>
            <td><?php if($valor === true or $valor === null) {echo $this->Form->Submit('cross.png', array('name' => $invite['Player']['id'], 'value' => 0));} ?></td>

        </tr>
        <?php echo $this->Form->end(); ?>
        <?php endforeach; ?>
    </table>
    </div>


<?php endif; ?>


<?php if($game['Game']['estado'] == 2): ?>

<div class="invited">
    <h3><?php echo __('Equipas');?></h3>
    <div class="equipa1">
        <table>
            <tr>
                <th><?php echo __('Brancos'); ?></th>
                <th><?php echo __($team_1_goals); ?></th>
            </tr>

            <?php foreach($team_1 as $nomejogador => $golos): ?>
            <tr>
                <td width=120px;><?php echo $nomejogador; ?></td>
                <td style="text-align: right"><?php echo $golos; ?></td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
    <div  class="equipa2">
        <table>
            <tr>
                <th><?php echo __($team_2_goals); ?></th>
                <th><?php echo __('Escuros'); ?></th>
            </tr>

            <?php foreach($team_2 as $nomejogador => $golos): ?>
            <tr>
                <td style="text-align: right"><?php echo $golos; ?></td>
                <td width=120px;><?php echo $nomejogador; ?></td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>
<?php endif; ?>

