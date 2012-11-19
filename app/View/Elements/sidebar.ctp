<script>
    $(document).ready(function() {
        $('.sparktristate').sparkline('html', {type: 'tristate'});
    });
</script>
<?php $data = $this->requestAction('Players/sidebarStats'); ?>

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
                <td class="player"><?php echo $this->Html->link(__($player['Player']['nome']), array('action' => 'view', $player['Player']['id'])); ?></td>
                <td class="rank"><?php echo $player['Player']['rating']; ?></td>
                <td>
                    <span class="sparktristate"><?php
                    if(array_key_exists('Team', $player)) {
                    // sparklines processa o html deste span
                        $player['Team'] = array_reverse($player['Team']);
                        // so' nos interessam os ultimos 5 jogos
                        // jogo mais recente 'a direita
                        for($j=4; $j > -1; $j--) {
                            if($player['Team'][$j]['winner'] == 0) {
                                // no lazyfoot uma derrota e' representada por '0'
                                // nas sparklines e' representada por '-1'
                                echo '-1';
                            } else {
                                echo $player['Team'][$j]['winner'];
                            }
                            // entre cada resultado imprimir virgula
                            // mas o ultimo nao precisa
                            if($j != 0) {
                                echo ",";
                            }
                        }
                    }
                    ?></span>
                </td>
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

