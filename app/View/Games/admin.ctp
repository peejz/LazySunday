<div class="actions">
    <h2>Admin</h2>
    <ul>
        <li><?php echo $this->Html->link(__('Update Pl Stats'), array('action' => 'updatePlayerStats', $game['Game']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('View'), array('action' => 'view', $game['Game']['id'])); ?></li>

    </ul>
    <h1><?php echo $this->Form->postLink('Aceitar', 'saveTeams', array('data' => array('game_id' => $game['Game']['id']))); ?></h1>
</div>

<?php if($game['Game']['estado'] == 0): ?>
    <div class="notinvited">
        <h2><?php  echo __('Bench');?></h2>
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
            <tr><td><?php echo $this->Form->end('Go!'); ?></td><td></td></tr>
        </table>
    </div>
<?php endif; ?>

<?php if($game['Game']['estado'] == 1): ?>
    <div class="submit_goals">
        <?php //debug($teams); ?>

        <?php echo $this->Form->Create(null, array('controller' => 'games', 'action' => 'submitGoals', 'url' => '/games/submitGoals/'.$game['Game']['id'])); ?>
            <?php for($i=0; $i <= 1; $i++):?>
                <table>
                    <tr>
                        <th>Player</th>
                        <th>Goals</th>
                    </tr>

                    <?php foreach($teams[$i]['Player'] as $player): ?>
                        <tr>
                            <td><?php echo $player['nome']; ?></td>
                            <td><?php echo $this->Form->input($player['id']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endfor; ?>
        <?php echo $this->Form->end('Submit'); ?>

    </div>
<?php endif; ?>