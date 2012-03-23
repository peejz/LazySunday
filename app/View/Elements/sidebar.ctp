<?php $allplayers = $this->requestAction('Games/playerStats'); ?>

<table class="sidebar">
    <thead colspan=3>Ranking:</thead>
<?php
    $i = 1;
    foreach ($allplayers as $player): ?>
    <tr>
        <td class="num"><?php echo $i++; ?>º</td>
        <td class="player"><?php echo $player['Player']['nome']; ?></td>
        <td class="rank"><?php echo $player['Player']['ranking']; ?></td>

    </tr>
<?php endforeach; ?>

</table>