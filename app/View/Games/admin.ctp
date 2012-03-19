<div class="actions">
    <h2>Admin</h2>
    <ul>
        <li><?php echo $this->Html->link(__('Update Pl Stats'), array('action' => 'updatePlayerStats', $game['Game']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('View'), array('action' => 'view', $game['Game']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('New Game'), array('action' => 'add')); ?></li>

    </ul>
</div>

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