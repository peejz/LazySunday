<?php $data = $this->requestAction('Games/playerStats'); ?>

<div class=sideTitle>golos marcados</div>
<div class=sideContent>
    <?php echo $data['allGoals']; ?>

</div>

<div class=sideTitle>rating: (min <?php echo $data['n_min_pre']; ?> presenças)</div>
<!--<div class=sideHeuristica>(vitorias/presencas)</div>-->
<div class=sideContent>
    <table class="sidebar">
        <?php
        $i = 1;
        foreach ($data['ratingList'] as $player): ?>
            <tr>
                <td class="num"><?php echo $i++; ?>º</td>
                <td class="player"><?php echo $player['Player']['nome']; ?></td>
                <td class="rank"><?php echo $player['Player']['rating']; ?></td>

            </tr>
            <?php endforeach; ?>

    </table>
</div>

<div class=sideTitle>golos p/ jogo:</div>
<div class=sideContent>
    <?php echo $data['topGoalscorer']['Player']['nome']; ?>

    (<?php echo $data['topGoalscorer']['Player']['golos_p_jogo']; ?>)
</div>

<div class=sideTitle>Equipa M p/ jogo:</div>
<div class=sideContent>
    <?php echo $data['offensiveInfluence']['Player']['nome']; ?>
    (<?php echo $data['offensiveInfluence']['Player']['equipa_m_p_jogo']; ?>)
</div>

<div class=sideTitle>Equipa S p/ jogo:</div>
<div class=sideContent>
    <?php echo $data['defensiveInfluence']['Player']['nome']; ?>
    (<?php echo $data['defensiveInfluence']['Player']['equipa_s_p_jogo']; ?>)
</div>

