<div><h1><?php echo $this->Time->format('d M Y', $game['Game']['data']); ?></h1></div>
<!--<div>--><?php //echo $this->Html->link(__('Admin'), array('action' => 'admin/', $game['Game']['id'])); ?><!--</div>-->
<br/>
<!-----------------TEAMS--------------------->
<?php //if(count($generatedTeams['team_1']) == 5): ?>
<div class=teams>

    <!--- Team 1 --->
    <div class="team1">

        <!--- Jogo Terminado 1--->
        <?php if($game['Game']['estado'] == 2): ?>
            <div class="equipa1_res">
                <?php echo $team_1_score; ?>
            </div>
            <div class="equipa1">
                <table>

                    <?php foreach($team_1_data as $nomejogador => $data): ?>
                    <tr>
                        <td width=120px;><?php echo $nomejogador; ?></td>
                        <td style="text-align: right"><?php echo $data['golos']."(".$data['assistencias'].")"; ?></td>
                        <td style="text-align: right"><?php echo $data['player_points']; ?></td>
                    </tr>
                    <?php endforeach; ?>

                </table>
            </div>
        <?php endif; ?>

        <!--- Convocatória 1--->
        <?php if($game['Game']['estado'] == 0): ?>
            <?php if(isset($generatedTeams['team_1'])): ?>
                <div class="equipa1_res">
                    <?php echo $generatedTeams['team_1_rating']; ?>
                </div>
                <div class="equipa1">
                    <?php //print_r($generatedTeams); ?>
                    <table>

                        <?php if($generatedTeams['team_1'] != null): ?>
                        <?php foreach($generatedTeams['team_1'] as $key => $player):?>

                            <tr id=<?php if($player['available'] != 1) { echo 'escuros_null'; } ?>>
                                <td class="num"><?php echo $key; ?>º</td>
                                <td class="player"><?php echo $player['name']; ?></td>
                                <td class="rank"><?php echo $player['rating']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>


    <!--- Team 2 --->
    <div class="team2">

            <!--- Jogo Terminado 2--->
            <?php if($game['Game']['estado'] == 2): ?>
                <div class="equipa2_res">
                    <?php echo $team_2_score; ?>
                </div>
                <div class="equipa2">
                    <table>

                        <?php foreach($team_2_data as $nomejogador => $data): ?>
                        <tr>
                            <td width=120px;><?php echo $nomejogador; ?></td>
                            <td style="text-align: right"><?php echo $data['golos']."(".$data['assistencias'].")"; ?></td>
                            <td style="text-align: right"><?php echo $data['player_points']; ?></td>
                        </tr>
                        <?php endforeach; ?>

                    </table>
                </div>
            <?php endif; ?>

            <!--- Convocatória 2--->
            <?php if($game['Game']['estado'] == 0): ?>
                <?php if(isset($generatedTeams['team_2'])): ?>
                    <div class="equipa2_res">
                        <?php echo $generatedTeams['team_2_rating']; ?>
                    </div>
                    <div class="equipa2">
                        <?php //print_r($generatedTeams); ?>
                        <table>

                            <?php if($generatedTeams['team_2'] != null): ?>
                            <?php foreach($generatedTeams['team_2'] as $key => $player):?>
                                <tr id=<?php if($player['available'] != 1) { echo 'brancos_null'; } ?>>
                                    <td class="num"><?php echo $key; ?>º</td>
                                    <td class="player"><?php echo $player['name']; ?></td>
                                    <td class="rank"><?php echo $player['rating']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </table>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

<?php //endif; ?>


<!-----------------INVITES----------------------->
<?php if($game['Game']['estado'] == 0): ?>
    <div id="invbase">
        <?php foreach($invites as $invite): ?>
        <?php   echo $this->Form->Create('Invite', array('action' => 'updateInvites/'.$game['Game']['id'])); ?>
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
          <div class="rating"><div class="ratingvalor" style="<?php echo 'width:'.$invite['Player']['rating']*0.140;echo 'px'; ?>"></div></div>
          <div class="rating_n"><?php echo $invite['Player']['rating']; ?></div>
          <div class="player"><?php echo $invite['Player']['nome']; ?></div>
          <div class="presence_off presence_txt"><?php echo $this->Form->button('NA', array('name' => $invite['Player']['id'], 'value' => 0, 'div' => false)); ?></div>
          <div class="presence_on presence_txt"><?php echo $this->Form->button('OK', array('name' => $invite['Player']['id'], 'value' => 1, 'div' => false)); ?></div>
        </div>
        <?php echo $this->Form->end(); ?>
        <?php endforeach; ?>
     </div>
     <div id="legendainvites">
         <div class="box">
             <div class="state" style="background-color: #00FF00"></div><div class="desc">Joga</div>
             <div class="state" style="background-color: #FF0000"></div><div class="desc">Não Joga</div>
             <div class="state" style="background-color: #c3c3c3"></div><div class="desc">Não respondeu</div>
        </div>
     </div>
<br/>
<?php endif; ?>

