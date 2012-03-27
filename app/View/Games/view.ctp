<div><h1><?php echo $this->Time->format('d M Y', $game['Game']['data']); ?></h1></div>
<div><?php echo $this->Html->link(__('Admin'), array('action' => 'admin/', $game['Game']['id'])); ?></div>

<!-----------------TEAMS--------------------->
<?php //if(count($generatedTeams['team_1']) == 5): ?>
<div class=teams>

    <!--- Team 1 --->
    <div class="team1">

        <!--- Jogo Terminado 1--->
        <?php if($game['Game']['estado'] == 2): ?>
            <div class="equipa1_res">
                <?php echo $team_1_goals; ?>
            </div>
            <div class="equipa1">
                <table>

                    <?php foreach($team_1 as $nomejogador => $golos): ?>
                    <tr>
                        <td width=120px;><?php echo $nomejogador; ?></td>
                        <td style="text-align: right"><?php echo $golos; ?></td>
                    </tr>
                    <?php endforeach; ?>

                </table>
            </div>
        <?php endif; ?>

        <!--- Convocatória 1--->
        <?php if($game['Game']['estado'] == 0): ?>
            <div class="equipa1_res">
                <?php echo $generatedTeams['team_1_ranking']; ?>
            </div>
            <div class="equipa1">
                <?php //print_r($generatedTeams); ?>
                <table>

                    <?php if($generatedTeams['team_1'] != null): ?>
                    <?php foreach($generatedTeams['team_1'] as $key => $player):?>
                        <tr>
                            <td class="num"><?php echo $key; ?>º</td>
                            <td class="player"><?php echo $player['name']; ?></td>
                            <td class="rank"><?php echo $player['ranking']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </table>
            </div>
        <?php endif; ?>
    </div>


    <!--- Team 2 --->
    <div class="team2">

            <!--- Jogo Terminado 2--->
            <?php if($game['Game']['estado'] == 2): ?>
                <div class="equipa2_res">
                    <?php echo $team_2_goals; ?>
                </div>
                <div class="equipa2">
                    <table>

                        <?php foreach($team_2 as $nomejogador => $golos): ?>
                        <tr>
                            <td width=120px;><?php echo $nomejogador; ?></td>
                            <td style="text-align: right"><?php echo $golos; ?></td>
                        </tr>
                        <?php endforeach; ?>

                    </table>
                </div>
            <?php endif; ?>

            <!--- Convocatória 2--->
            <?php if($game['Game']['estado'] == 0): ?>
                <div class="equipa2_res">
                    <?php echo $generatedTeams['team_2_ranking']; ?>
                </div>
                <div class="equipa2">
                    <?php //print_r($generatedTeams); ?>
                    <table>

                        <?php if($generatedTeams['team_2'] != null): ?>
                        <?php foreach($generatedTeams['team_2'] as $key => $player):?>
                            <tr>
                                <td class="num"><?php echo $key; ?>º</td>
                                <td class="player"><?php echo $player['name']; ?></td>
                                <td class="rank"><?php echo $player['ranking']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php //endif; ?>


<!-----------------INVITES----------------------->
<?php if($game['Game']['estado'] == 0): ?>
    <div id="invbase">
        <?php foreach($invites as $invite): ?>
        <?php   echo $this->Form->Create(null, array('controller' => 'games', 'action' => 'updateInvites/'.$game['Game']['id'])); ?>
        <?php
            $answered = !is_null($invite['Invite']['available']);
            $valor = false;
            if($answered) {
                if($invite['Invite']['available']) $valor = true;
            } else {
                $valor = null;
            }
?>
        <div class="box">
          <div class="state" style="<?php
              if($valor) echo 'background-color: #00FF00';
              elseif(is_null($valor)) echo 'background-color: #c3c3c3';
              else echo 'background-color: #FF0000';
              ?>"></div>
          <div class="ranking"><div class="rankingvalor" style="<?php echo 'width:'.$invite['Player']['ranking']*140;echo 'px'; ?>"></div></div>
          <div class="ranking_n"><?php echo $invite['Player']['ranking']; ?></div>
          <div class="player"><?php echo $invite['Player']['nome']; ?></div>
          <div class="presence_off presence_txt"><?php echo $this->Form->button('NA', array('name' => $invite['Player']['id'], 'value' => 0, 'div' => false)); ?></div>
          <div class="presence_on presence_txt"><?php echo $this->Form->button('OK', array('name' => $invite['Player']['id'], 'value' => 1, 'div' => false)); ?></div>
        </div>
        <?php echo $this->Form->end(); ?>
        <?php endforeach; ?>
     </div>
<br/>
<?php endif; ?>
<br/>
<?php if($game['Game']['estado'] == 0): ?>
<div class="games view">
<!--    <h2>--><?php //echo __('Teams'); ?><!--</h2>-->


    <div class="team">
        <?php //print_r($generatedTeams); ?>
        <table>
            <tr>
                <th>pos</th>
                <th>Escuros</th>
                <th><?php echo $generatedTeams['team_1_ranking']; ?></th>

                <th>pres</th>
            </tr>

            <?php if($generatedTeams['team_1'] != null): ?>
            <?php foreach($generatedTeams['team_1'] as $key => $player):?>
                <tr>
                    <td class="num"><?php echo $key; ?>º</td>
                    <td class="player"><?php echo $player['name']; ?></td>
                    <td class="rank"><?php echo $player['ranking']; ?></td>

                    <td><?php echo $player['presencas']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>
    </div>

    <div class="team">
        <table>
            <tr>
                <th>pos</th>
                <th>Brancos</th>
                <th><?php echo $generatedTeams['team_2_ranking']; ?></th>

                <th>pres</th>
            </tr>

            <?php if($generatedTeams['team_2'] != null): ?>
            <?php foreach($generatedTeams['team_2'] as $key => $player):?>
                <tr>
                    <td class="num"><?php echo $key; ?>º</td>
                    <td class="player"><?php echo $player['name']; ?></td>
                    <td class="rank"><?php echo $player['ranking']; ?></td>

                    <td><?php echo $player['presencas']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>
    </div>

</div>

<?php endif; ?>

