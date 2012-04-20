<?php
App::uses('AppController', 'Controller');
/**
 * Games Controller
 *
 * @property Game $Game
 */
class GamesController extends AppController {

    public $uses = array('Game', 'Invite', 'Goal', 'Team', 'Player', 'PlayersTeam', 'Rating');
    public $helpers = array('Time');

    //Minimum number of attendances required to be accepted in the rating table
    const N_MIN_PRE = 1;

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$games = $this->Game->find('all', array('order' => array('Game.id' => 'desc')));
		$this->set('games', $games);
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {

        $this->Game->id = $id;
		if (!$this->Game->exists()) {
			throw new NotFoundException(__('Invalid game'));
		}
		$this->set('game', $this->Game->read(null, $id));

        $game = $this->Game->findById($id);

        if($game['Game']['estado'] == 0) {
        //Invites - variaveis para a view
        $this->set($this->invites($id));
        //Teams
        $this->set('generatedTeams', $this->generateTeams($id));
        }
        //elseif($game['Game']['estado'] == 1) {
        //$something = "";
        //}
        else {
        //teams goals - variaveis para a view
        $this->set($this->teams_goals($id));
        }
        //menu dos jogos à esquerda
        $this->set('list_games', array_reverse($this->Game->find('list'), true));

        //rebuild player stats
        //$this->presencas();

	}

    /**
     * teams_goals method
     *
     * @param string $id
     * @return array
     */
    public function teams_goals($id){
        // ----- Teams
        $teamoptions = array('conditions' => array('game_id' => $id));
        $teams = $this->Game->Team->find('all', $teamoptions);
        $i = 1;
        //if(count($teams) != 2) throw new NotFoundException(__('Teams dont exist.'));
        foreach($teams as $team) {
            foreach($team['Player'] as $player) {
                ${'team'.$i.'_list'}[$player['nome']] = $player['id'];
            }
            ${'team_'.$i.'_golos'} = $team['Team']['golos'];
            $i++;
        }

        // ----- Goals
        $goaloptions = array('conditions' => array('game_id' => $id));
        $goals = $this->Game->Goal->find('all', $goaloptions);
        //if(count($goals <= 0)) throw new NotFoundException(__('Goals dont exist.'));
        if($goals) {
            foreach($goals as $goal) {
                foreach($team1_list as $playername => $playerid) {
                    if($goal['Goal']['player_id'] == $playerid){
                        $team1_list[$playername] = $goal['Goal']['golos'];
                    }
                }
                foreach($team2_list as $playername => $playerid) {
                    if($goal['Goal']['player_id'] == $playerid){
                        $team2_list[$playername] = $goal['Goal']['golos'];
                    }
                }
            }
        } else {
            foreach($team1_list as $nome => $golos){$team1_list[$nome] = 0;}
            foreach($team2_list as $nome => $golos){$team2_list[$nome] = 0;}
        }

        //print_r($team1_list);
        //print_r($team2_list);
        //echo $team1_golos;
        //echo $team2_golos;

        // [Nome] => Golos
        // [Peej] => 3
        // [Far] => 2
        // [Fresco] => 5
        // ...

        // ----- Disponivel na View
        return array('team_1' => $team1_list,
            'team_2' => $team2_list,
            'team_1_goals' => $team_1_golos,
            'team_2_goals' => $team_2_golos);


    }

/**
 * invites method
 *
 * @param string $id
 * @return array
 */
    public function invites($id) {
        // ----- Invites
        $options = array('order' => array('Player.conv' => 'asc', 'Player.rating' => 'desc'), 'conditions' => array('game_id' => $id));
        $invites = $this->Game->Invite->find('all', $options);
        $players = $this->Player->find('list');

        foreach($invites as $invite) {
            $invite_list[$invite['Invite']['player_id']] = null;
        }
        foreach($players as $key => $player) {
            if(!array_key_exists($key, $invite_list)) {
                $notinvited[$key] = $player;
            }
        }

        return array('invites' => $invites,
            'notinvited' => $notinvited);

    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {

            $savegame['Game'] = array_slice($this->request->data['Game'], 0, 1);
            $savegame['Game']['estado'] = 0;

            $saveplayers = array_slice($this->request->data['Game'], 1);

            $this->Game->create();
            $gameid = $this->Game->save($savegame);

            foreach($saveplayers as $key => $player) {
                $saveplayer = array('Invite' => array(
                    'game_id' => $gameid['Game']['id'],
                    'player_id' => str_replace('jogador', '', $key)
                ));
                if($player) {
                    $this->Invite->Create();
                    if($this->Invite->save($saveplayer)) {
                        $this->Session->setFlash(__('The game has been saved'));
                    } else {
                        $this->Session->setFlash(__('The game could not be saved. Please, try again.'));
                    }
                }
            }
            $this->redirect(array('action' => 'index'));
        }

        $players = $this->Player->find('list');
        $this->set(compact('players'));
    }

    /**
     * edit method
     *
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Game->id = $id;
        if (!$this->Game->exists()) {
            throw new NotFoundException(__('Invalid game'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Game->save($this->request->data)) {
                $this->Session->setFlash(__('The game has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The game could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Game->read(null, $id);
        }
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Game->id = $id;
        if (!$this->Game->exists()) {
            throw new NotFoundException(__('Invalid game'));
        }
        if ($this->Game->delete()) {
            $this->Session->setFlash(__('Game deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Game was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

/**
 * admin method
 *
 * @param string $id
 * @return void
 */
    public function admin($id = null) {
        $this->Game->id = $id;
        if (!$this->Game->exists()) {
            throw new NotFoundException(__('Invalid game'));
        }
        $this->set('game', $this->Game->read(null, $id));

        //Invites - variaveis para a view
        $this->set($this->invites($id));

        //submitGoals
        //Find Teams
        $options = array('conditions' => array('Team.game_id' => $id));
        $teams = $this->Team->find('all', $options);
        $this->set('teams', $teams);
    }

/**
 * updatePlayerStats method
 *
 * @param string $id
 * @return void
 */
    public function updatePlayerStats($id = null) {

        $players = $this->Player->find('all');
        $games = $this->Game->find('list');

        foreach($games as $game_id => $game) {
            $game_options = array('conditions' => array('game_id' => $game_id));
            $teams = $this->Team->find('all', $game_options);


            //find winning team
            if($teams[0]['Team']['golos'] > $teams[1]['Team']['golos']) {
              $winning_team = $teams[0];
            }
            elseif($teams[0]['Team']['golos'] < $teams[1]['Team']['golos']){
              $winning_team = $teams[1];
            }
            //find players from winning teams
            $playerTeam_options = array('conditions' => array('team_id' => $winning_team['Team']['id']));
            $winning_players = $this->PlayersTeam->find('all', $playerTeam_options);

            //sum victories
            if(!($teams[0]['Team']['golos'] == 0 and $teams[1]['Team']['golos'] == 0)) {
                foreach($winning_players as $player) {
                    if(!isset($all_players[$player['PlayersTeam']['player_id']]['victorias'])) {
                        $all_players[$player['PlayersTeam']['player_id']]['victorias'] = 1;
                    }
                    else {
                        $all_players[$player['PlayersTeam']['player_id']]['victorias'] += 1;
                    }
                }
            }
        }

        foreach($players as $player) {

            //presenças
            $options = array('conditions' => array('player_id' => $player['Player']['id']));
            $all_players[$player['Player']['id']]['presencas'] = $this->PlayersTeam->find('count', $options);

            //vitorias


            //golos
            $goal_options = array('conditions' => array('player_id' => $player['Player']['id']));
            foreach($this->Goal->find('all', $goal_options) as $goal) {
                if(!isset($all_players[$player['Player']['id']]['golos'])) {
                   $all_players[$player['Player']['id']]['golos'] = $goal['Goal']['golos'];
                }
                else {
                $all_players[$player['Player']['id']]['golos'] += $goal['Goal']['golos'];
                }

            }
        }

        //adjustment array
        //games where no goals where saved, only the winning team
        $adjust = array(14 => 3,
                        15 => 3,
                        16 => 3,
                        17 => 1,
                        18 => 2,
                        19 => 2,
                        20 => 3,
                        21 => 3,
                        22 => 3,
                        23 => 2,
                        24 => 2,
                        25 => 0,
                        26 => 0,
                        27 => 0,
                        28 => 1,
                        29 => 0,
                        30 => 2,
                        31 => 0,
                        32 => 0,
                        33 => 0);

        //golos por jogo
        $top_goals_p_Game = 0;

        foreach($all_players as $id => $player) {
            if(isset($player['golos']) and $player['golos'] != 0) {
              $all_players[$id]['golos_p_jogo'] = round($player['golos'] / ($player['presencas'] - $adjust[$id]), 2);
            }
            else {
              $all_players[$id]['golos_p_jogo'] = 0;
            }

            //save a variable with the average topScorer
            if(($all_players[$id]['golos_p_jogo'] > $top_goals_p_Game) and ($all_players[$id]['presencas'] > self::N_MIN_PRE)) {
                $top_goals_p_Game = $all_players[$id]['golos_p_jogo'];
            }
        }


        //equipa marcados e sofridos
        $Teams = $this->Team->find('all');
        $ignoreTeams = array(5, 6, 7, 8, 9, 10);

        //$key => game_id $value => teams from that game
        foreach($Teams as $team) {
            $gameTeams[$team['Team']['game_id']][] = array('id' => $team['Team']['id'],
                                                           'golos' => $team['Team']['golos']);
        }

        foreach($players as $player) {
            //var simplification
            $player_id = $player['Player']['id'];

            foreach($player['Team'] as $team) {

                //declare variables
                $all_players[$player_id]['equipa_m'] = 0;
                $all_players[$player_id]['equipa_s'] = 0;

                 if(!array_search($gameTeams[$team['game_id']][0]['id'], $ignoreTeams)) {
                    if($gameTeams[$team['game_id']][0]['id'] == $team['id']) {
                        $all_players[$player_id]['equipa_m'] += $gameTeams[$team['game_id']][0]['golos'];
                    }
                    else {
                        $all_players[$player_id]['equipa_s'] += $gameTeams[$team['game_id']][0]['golos'];

                    }
                }

                if(!array_search($gameTeams[$team['game_id']][1]['id'], $ignoreTeams)) {
                    if($gameTeams[$team['game_id']][1]['id'] == $team['id']) {
                        $all_players[$player_id]['equipa_m'] += $gameTeams[$team['game_id']][1]['golos'];
                    }
                    else {
                        $all_players[$player_id]['equipa_s'] += $gameTeams[$team['game_id']][1]['golos'];
                    }
                }

            }

            //marcados por jogo
            if(($all_players[$player_id]['presencas'] - $adjust[$player_id]) == 0){
            $all_players[$player_id]['equipa_m_p_jogo'] = 0;
            $all_players[$player_id]['equipa_s_p_jogo'] = 0;
            }
            else{
                //marcados por jogo
                $all_players[$player_id]['equipa_m_p_jogo'] = round($all_players[$player_id]['equipa_m'] /
                ($all_players[$player_id]['presencas'] - $adjust[$player_id]), 2);

                //sofridos por jogo
                $all_players[$player_id]['equipa_s_p_jogo'] = round($all_players[$player_id]['equipa_s'] /
                    ($all_players[$player_id]['presencas'] - $adjust[$player_id]), 2);
            }



        }


        //debug($all_players);

        //debug($gameTeams);

        //save player data
        foreach($all_players as $player_id => $player_data) {

            //check if user has victories
            if(!isset($player_data['victorias'])){
              $vit_pre = 0;
              $player_data['victorias'] = 0;
            }
            else {
            $vit_pre = round($player_data['victorias']/$player_data['presencas'], 3);
            }

            //check if user has goals
            if(!isset($player_data['golos'])) {
              $player_data['golos'] = 0;
            }

            //generaterating
            $goalsRating = $player_data['golos_p_jogo'] / $top_goals_p_Game;
            $rating = round(0.75*$vit_pre + 0.25*$goalsRating, 3);


            $saveplayer = array('Player' => array('id' => $player_id,
                                                  'rating' => $rating,
                                                  'vit_pre' => $vit_pre,
                                                  'golos' => $player_data['golos'],
                                                  'golos_p_jogo' => $player_data['golos_p_jogo'],
                                                  'presencas' => $player_data['presencas'],
                                                  'vitorias' => $player_data['victorias'],
                                                  'equipa_m' => $player_data['equipa_m'],
                                                  'equipa_m_p_jogo' => $player_data['equipa_m_p_jogo'],
                                                  'equipa_s' => $player_data['equipa_s'],
                                                  'equipa_s_p_jogo' => $player_data['equipa_s_p_jogo']));
            $this->Player->save($saveplayer);


        }

        //$this->redirect(array('action' => 'view', $id));

    }

    public function updateInvites($id = null) {


        if($this->request->data) {

            //print_r($this->request->data);

            end($this->request->data);
            $playerAvailability = each($this->request->data);

            $options = array('conditions' => array('Invite.game_id' => $id, 'Invite.player_id' => $playerAvailability['key']));
            $currentInvite = $this->Invite->find('first', $options);

            if($currentInvite['Invite']['available'] != $playerAvailability['value']) {
                $currentInvite['Invite']['available'] = $playerAvailability['value'];
                $this->Invite->save($currentInvite);
                //print_r($currentInvite);
            }
        }

        $this->redirect('/games/view/'.$id);

    }

/**
 * addInvites method
 *
 * @param string $id
 * @return void
 */
    public function addInvites($id = null) {
        $this->Game->id = $id;

        $invites = $this->request->data['Game'];
        //print_r($invites);

        foreach($invites as $key => $invite) {
            //echo key($invites);
            $jogadorid = str_replace('jogador', '', $key);
            //echo $jogadorid.' => '.$invites['jogador'.$jogadorid].'<br/>';

            if($invite) {
                $saveinvite = array('Invite' => array('game_id' => $id, 'player_id' => $jogadorid, 'available' => null));

                $this->Invite->Create();
                if($this->Invite->save($saveinvite)) {
                    //$this->Session->setFlash(__('The invite has been saved'));
                } else {
                    //$this->Session->setFlash(__('The invite could not be saved. Please, try again.'));
                }
            }
        }

        $this->redirect('/games/view/'.$id);
    }

/**
 * generateTeams method
 *
 * @param string $id
 * @return void
 */
    public function generateTeams($id = null) {

        //Find Teams
        $teamOptions = array('conditions' => array('Team.game_id' => $id));
        $currentTeams = $this->Team->find('all', $teamOptions);

        //Create Teams if they don't exist
        for($i = count($currentTeams); $i < 2; $i++) {
            $this->Team->Create();
            $team = array('Team' => array('game_id' => $id));
            $currentTeams[$i] = $this->Team->save($team);
        }

        $invitedPlayers = $this->invites($id);


        //Array of Available Players
        $i = 0;

            foreach($invitedPlayers['invites'] as $invite) {

                    if($invite['Invite']['available'] === null) {
                        $available_list[$i++] = array('id' => $invite['Player']['id'],
                                                        'name' => $invite['Player']['nome'],
                                                        'rating' => $invite['Player']['rating'],
                                                        'presencas' => $invite['Player']['presencas'],
                                                        'available' => null);

                    }
                    elseif($invite['Invite']['available'] == 0) {

                    }
                    else {
                    $available_list[$i++] = array('id' => $invite['Player']['id'],
                                              'name' => $invite['Player']['nome'],
                                              'rating' => $invite['Player']['rating'],
                                              'presencas' => $invite['Player']['presencas'],
                                              'available' => 1);
                    }



            }


        if(!isset($available_list)) {
            return null;
        }

        //Creates empty spots in case players < 10
        while(count($available_list) < 10) {
            $available_list[$i++] = array('id' => 0,
                'name' => '__ ? __   ',
                'rating' => null,
                'presencas' => 0,
                'available' => null);
        }
        //Cut the array so it has max 10 players
        $available_list = array_slice($available_list, 0, 10);

        //Sort by rating
        foreach ($available_list as $key => $row) {
            $player_id[$key]  = $row['id'];
            $rating[$key] = $row['rating'];
        }

        array_multisort($rating, SORT_DESC, $player_id, SORT_ASC, $available_list);



        /*//Sort into teams
        foreach ($available_list as $key => $player) {
            if($key == 0 or $key == 3 or $key == 5 or $key == 7 or $key == 9){
                $teams['team_1'][$key + 1] = $player;
            }
            else {
                $teams['team_2'][$key + 1] = $player;
            }

        }*/

        if(count($available_list) >= 10)
        {
            //Sort into teams
            $teams['team_1'][1] = $available_list[0];
            $teams['team_2'][2] = $available_list[1];
            $teams['team_2'][3] = $available_list[2];
            $teams['team_1'][4] = $available_list[3];

            $teams['team_1_rating'] = $teams['team_1'][1]['rating'] + $teams['team_1'][4]['rating'];
            $teams['team_2_rating'] = $teams['team_2'][2]['rating'] + $teams['team_2'][3]['rating'];

            for($i = 5; $i <= 9; $i += 2) {

                //does a varition in case a player goes to either team
                $var_1[1] = $teams['team_1_rating'] + $available_list[$i]['rating'];
                $var_1[2] = $teams['team_2_rating'] + $available_list[$i-1]['rating'];
                $var_2[1] = $teams['team_1_rating'] + $available_list[$i-1]['rating'];
                $var_2[2] = $teams['team_2_rating'] + $available_list[$i]['rating'];

                //if the variation is the smallest
                if(abs($var_1[1] - $var_1[2]) < abs($var_2[1] - $var_2[2])) {
                    $teams['team_1'][$i+1] = $available_list[$i];
                    $teams['team_1_rating'] += $available_list[$i]['rating'];
                    $teams['team_2'][$i] = $available_list[$i-1];
                    $teams['team_2_rating'] += $available_list[$i-1]['rating'];

                }
                else {
                    $teams['team_1'][$i] = $available_list[$i-1];
                    $teams['team_1_rating'] += $available_list[$i-1]['rating'];
                    $teams['team_2'][$i+1] = $available_list[$i];
                    $teams['team_2_rating'] += $available_list[$i]['rating'];
                }
            }
        }

        //overall team rating
        /*if(isset($teams['team_1'])) {
            foreach($teams['team_1'] as $player){
                if(!isset($teams['team_1_rating'])) {
                  $teams['team_1_rating'] = $player['rating'];
                }
                else {
                  $teams['team_1_rating'] += $player['rating'];
                }
            }
        }
        else {
            $teams['team_1'] = null;
            $teams['team_1_rating'] = 0;
        }

        if(isset($teams['team_2'])) {
            foreach($teams['team_2'] as $player){
                if(!isset($teams['team_2_rating'])) {
                    $teams['team_2_rating'] = $player['rating'];
                }
                else {
                    $teams['team_2_rating'] += $player['rating'];
                }
            }
        }
        else {
            $teams['team_2'] = null;
            $teams['team_2_rating'] = 0;

        }*/

        //Team_id
        $teams['team_1_id'] = $currentTeams[0]['Team']['id'];
        $teams['team_2_id'] = $currentTeams[1]['Team']['id'];


        return $teams;
    }

    public function saveTeams() {
        $game_id = $this->request->data['game_id'];
        $teams = $this->generateTeams($game_id);

        for($i = 1; $i <= 2; $i++) {
            //team count
            $options = array('conditions' => array('team_id' => $teams['team_'.$i.'_id']));
            ${'team_'.$i.'_count'} = $this->PlayersTeam->find('count', $options);

            //validation
            if(${'team_'.$i.'_count'} == 0) {
                foreach ($teams['team_'.$i] as $teamplayer) {
                    $saveteamplayer = array('PlayersTeam' => array('team_id' => $teams['team_'.$i.'_id'], 'player_id' => $teamplayer['id']));
                    $this->PlayersTeam->create();
                    $this->PlayersTeam->save($saveteamplayer);
                    //debug($saveteamplayer);
                }
            }

        }

        //Change game state to 1
        $this->Game->id = $game_id;
        $this->Game->save(array('Game' => array('estado' => 1)));

        //Redirect
        $this->redirect(array('action' => 'view', $game_id));

    }

    public function submitGoals($id) {

        //variables
        $teamGoals[0] = null;
        $teamGoals[1] = null;

        //debug($this->request->data);
        $i = 1;

        foreach($this->request->data['Game'] as $player_id => $goals) {
            $playerGoals = array('Goal' => array('game_id' => $id, 'player_id' => $player_id, 'golos' => $goals));
            $this->Goal->create();
            $this->Goal->save($playerGoals);

            //First 5 are from team 1, last five from team 2
            if($i++ <= 5) {
                $teamGoals[0] += $goals;
            }
            else{
                $teamGoals[1] += $goals;
            }

        }

        //saveTeam result
        $options = array('conditions' => array('Team.game_id' => $id));
        $teams = $this->Team->find('all', $options);
        foreach($teams as $key => $team) {
            $this->Game->Team->id = $team['Team']['id'];
            $teamScore = array('Team' => array('golos' => $teamGoals[$key]));
            $this->Game->Team->save($teamScore);
        };

        //Change game state to 2
        $this->Game->id = $id;
        $this->Game->save(array('Game' => array('estado' => 2, 'resultado' => $teamGoals[0].'-'.$teamGoals[1])));

        //Update Player Stats
        $this->updatePlayerStats($id);

        //Redirect
        $this->redirect(array('action' => 'view', $id));
    }

    public function playerStats() {
        //rating
        $op_rating = array('order' => array('Player.rating' => 'desc'),
                         'conditions' => array('Player.presencas >' => 1));
        $players['ratingList'] = $this->Player->find('all', $op_rating);

        //topGoalscorer
        $op_topGoalscorer = array('order' => array('Player.golos_p_jogo' => 'desc'),
            'conditions' => array('Player.presencas >' => 1));
        $players['topGoalscorer'] = $this->Player->find('first', $op_topGoalscorer);

        //offensiveInfluence
        $op_offensive = array('order' => array('Player.equipa_m_p_jogo' => 'desc'),
            'conditions' => array('Player.presencas >' => 1));
        $players['offensiveInfluence'] = $this->Player->find('first', $op_offensive);

        //defensiveInfluence
        $op_defensive = array('order' => array('Player.equipa_s_p_jogo' => 'asc'),
            'conditions' => array('Player.presencas >' => 1));
        $players['defensiveInfluence'] = $this->Player->find('first', $op_defensive);

        return $players;
    }


}
