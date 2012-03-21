<?php $allplayers = $this->requestAction('Games/playerStats'); ?>

<table class="sidebar">
    <thead colspan=3>Ranking:</thead>
<?php
    $i = 1;
    foreach ($allplayers as $player): ?>
    <tr>
        <td><?php echo $i++; ?>º</td>
        <td><?php echo $player['Player']['ranking']; ?></td>
        <td><?php echo $player['Player']['nome']; ?></td>
    </tr>
<?php endforeach; ?>

</table>