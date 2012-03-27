<?php $data = $this->requestAction('Games/playerStats'); ?>

<table class="sidebar">
    <thead colspan=3>TopGoalscorer:</thead>
<tr>
    <td><?php echo $data['topGoalscorer']['Player']['nome']; ?></td>
    <td><?php echo $data['topGoalscorer']['Player']['golos_p_jogo']; ?></td>
    <td>golos p/ jogo</td>
</tr>
</table>

<table class="sidebar">
    <thead colspan=3>equipaAtaque:</thead>
    <tr>
        <td><?php echo $data['offensiveInfluence']['Player']['nome']; ?></td>
        <td><?php echo $data['offensiveInfluence']['Player']['equipa_m_p_jogo']; ?></td>
        <td>p/jogo</td>
    </tr>
</table>

<table class="sidebar">
    <thead colspan=3>equipaDefesa:</thead>
    <tr>
        <td><?php echo $data['defensiveInfluence']['Player']['nome']; ?></td>
        <td><?php echo $data['defensiveInfluence']['Player']['equipa_s_p_jogo']; ?></td>
        <td>p/jogo</td>
    </tr>
</table>

<table class="sidebar">
    <thead colspan=3>Ranking:</thead>
<?php
    $i = 1;
    foreach ($data['rankingList'] as $player): ?>
    <tr>
        <td class="num"><?php echo $i++; ?>º</td>
        <td class="player"><?php echo $player['Player']['nome']; ?></td>
        <td class="rank"><?php echo $player['Player']['ranking']; ?></td>

    </tr>
<?php endforeach; ?>

</table>