<?php
App::uses('AppModel', 'Model');
/**
 * Player Model
 *
 * @property Goal $Goal
 * @property Invite $Invite
 * @property Team $Team
 */
class Player extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nome';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nome' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'presencas' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'vitorias' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'golos' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Goal' => array(
			'className' => 'Goal',
			'foreignKey' => 'player_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Invite' => array(
			'className' => 'Invite',
			'foreignKey' => 'player_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Team' => array(
			'className' => 'Team',
			'joinTable' => 'players_teams',
			'foreignKey' => 'player_id',
			'associationForeignKey' => 'team_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

//Minimum number of attendances required to be accepted in the rating table
const N_MIN_PRE = 5;

/**
 * presencas method
 *
 * @param string $id
 * @return int
 */
    public function presencas($id = null) {
        $options = array('conditions' => array('player_id' => $id));
        return $this->PlayersTeam->find('count', $options);
    }

/**
 * wins method
 *
 * @param string $id
 * @return int
 */
    public function wins($id = null) {
        $options = array('conditions' => array('player_id' => $id));
        $presencas = $this->PlayersTeam->find('all', $options);

        $wins = 0;
        foreach($presencas as $team){
        $options = array('conditions' => array('Team.id' => $team['PlayersTeam']['team_id'], 'winner' => 1));
            if($this->Team->find('first', $options)) {
                $wins += 1;
            }

        }

        return $wins;
    }

/**
 * goals method
 *
 * @param string $id
 * @return int
 */
    public function goals($id = null) {
        $options = array('conditions' => array('player_id' => $id));
        $goals = $this->Goal->find('all', $options);

        $total = 0;
        foreach($goals as $goal) {
            $total += $goal['Goal']['golos'];
        }

        return $total;
    }

/**
 * bestGoalAverage method
 *
 * @param string $id
 * @return float
 */
    public function bestGoalAverage() {
        $options = array('order' => array('Player.golos_p_jogo' => 'desc', 'Player.presencas' => 'desc'),
            'conditions' => array('Player.presencas >=' => self::N_MIN_PRE));
        return $this->find('first', $options);
    }

/**
 * updateStats method
 *
 * @param string $id
 * @return void
 */
    public function updateStats() {

        $players = $this->find('all');
        $games = ClassRegistry::init('Game')->find('list');

        foreach($games as $gameId => $game) {
            $options = array('conditions' => array('game_id' => $gameId));
            $teams = $this->Team->find('all', $options);


            //find winning team
            if($teams[0]['Team']['golos'] > $teams[1]['Team']['golos']) {
                $winningTeam = $teams[0];
            }
            elseif($teams[0]['Team']['golos'] < $teams[1]['Team']['golos']){
                $winningTeam = $teams[1];
            }
            //find players from winning teams
            $options = array('conditions' => array('team_id' => $winningTeam['Team']['id']));
            $winningPlayers = $this->PlayersTeam->find('all', $options);

            //sum victories
            if(!($teams[0]['Team']['golos'] == 0 and $teams[1]['Team']['golos'] == 0)) {
                foreach($winningPlayers as $player) {
                    if(!isset($allPlayers[$player['PlayersTeam']['player_id']]['victorias'])) {
                        $allPlayers[$player['PlayersTeam']['player_id']]['victorias'] = 1;
                    }
                    else {
                        $allPlayers[$player['PlayersTeam']['player_id']]['victorias'] += 1;
                    }
                }
            }
        }

        foreach($players as $player) {

            //presenças
            $options = array('conditions' => array('player_id' => $player['Player']['id']));
            $allPlayers[$player['Player']['id']]['presencas'] = $this->PlayersTeam->find('count', $options);




            //golos
            $options = array('conditions' => array('player_id' => $player['Player']['id']));
            foreach($this->Goal->find('all', $options) as $goal) {
                if(!isset($allPlayers[$player['Player']['id']]['golos'])) {
                    $allPlayers[$player['Player']['id']]['golos'] = $goal['Goal']['golos'];
                }
                else {
                    $allPlayers[$player['Player']['id']]['golos'] += $goal['Goal']['golos'];
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
            33 => 0,
            34 => 0,
            35 => 0);

        //golos por jogo
        $top_goals_p_Game = 0;

        foreach($allPlayers as $id => $player) {
            if(isset($player['golos']) and $player['golos'] != 0) {
                $allPlayers[$id]['golos_p_jogo'] = round($player['golos'] / ($player['presencas'] - $adjust[$id]), 2);
            }
            else {
                $allPlayers[$id]['golos_p_jogo'] = 0;
            }

            //save a variable with the average topScorer
            if(($allPlayers[$id]['golos_p_jogo'] > $top_goals_p_Game) and ($allPlayers[$id]['presencas'] > self::N_MIN_PRE)) {
                $top_goals_p_Game = $allPlayers[$id]['golos_p_jogo'];
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
            $id = $player['Player']['id'];

            //declare variables
            $allPlayers[$id]['equipa_m'] = 0;
            $allPlayers[$id]['equipa_s'] = 0;
            foreach($player['Team'] as $team) {



                if(!array_search($gameTeams[$team['game_id']][0]['id'], $ignoreTeams)) {
                    if($gameTeams[$team['game_id']][0]['id'] == $team['id']) {
                        $allPlayers[$id]['equipa_m'] += $gameTeams[$team['game_id']][0]['golos'];
                    }
                    else {
                        $allPlayers[$id]['equipa_s'] += $gameTeams[$team['game_id']][0]['golos'];

                    }
                }

                if(!array_search($gameTeams[$team['game_id']][1]['id'], $ignoreTeams)) {
                    if($gameTeams[$team['game_id']][1]['id'] == $team['id']) {
                        $allPlayers[$id]['equipa_m'] += $gameTeams[$team['game_id']][1]['golos'];
                    }
                    else {
                        $allPlayers[$id]['equipa_s'] += $gameTeams[$team['game_id']][1]['golos'];
                    }
                }

            }

            //marcados por jogo
            if(($allPlayers[$id]['presencas'] - $adjust[$id]) == 0){
                $allPlayers[$id]['equipa_m_p_jogo'] = 0;
                $allPlayers[$id]['equipa_s_p_jogo'] = 0;
            }
            else{
                //marcados por jogo
                $allPlayers[$id]['equipa_m_p_jogo'] = round($allPlayers[$id]['equipa_m'] /
                    ($allPlayers[$id]['presencas'] - $adjust[$id]), 2);

                //sofridos por jogo
                $allPlayers[$id]['equipa_s_p_jogo'] = round($allPlayers[$id]['equipa_s'] /
                    ($allPlayers[$id]['presencas'] - $adjust[$id]), 2);
            }



        }


        //debug($allPlayers);

        //debug($gameTeams);

        //save player data
        foreach($allPlayers as $id => $data) {

            //check if user has victories
            if(!isset($data['victorias'])){
                $vit_pre = 0;
                $data['victorias'] = 0;
            }
            else {
                $vit_pre = round($data['victorias']/$data['presencas'], 3);
            }

            //check if user has goals
            if(!isset($data['golos'])) {
                $data['golos'] = 0;
            }

            //generaterating
            $goalsRating = $data['golos_p_jogo'] / $top_goals_p_Game;
            //in case player has less than N_MIN_PRE
            //e.g. player did 1 game and won
            //$estimate = (5 - 1)/5 * 0.5
            //$real = 1/5 * 0.876
            if($data['presencas'] < self::N_MIN_PRE){
                $estimate = ((self::N_MIN_PRE - $data['presencas'])/self::N_MIN_PRE)*0.5;
                $real = ($data['presencas']/self::N_MIN_PRE)*$vit_pre;
                $vit_pre = $estimate + $real;

            }

            $rating = round(0.75*$vit_pre + 0.25*$goalsRating, 3);



            $saveplayer = array('Player' => array('id' => $id,
                'rating' => $rating,
                'vit_pre' => $vit_pre,
                'golos' => $data['golos'],
                'golos_p_jogo' => $data['golos_p_jogo'],
                'presencas' => $data['presencas'],
                'vitorias' => $data['victorias'],
                'equipa_m' => $data['equipa_m'],
                'equipa_m_p_jogo' => $data['equipa_m_p_jogo'],
                'equipa_s' => $data['equipa_s'],
                'equipa_s_p_jogo' => $data['equipa_s_p_jogo']));
            $this->save($saveplayer);

            //array_push($rankingEvolution[$i], $saveplayer);
        }

        //$this->redirect(array('action' => 'view', $id));

    }

/**
 * getPlayerRankingEvo devolve um array com o historico de um jogador.
 * o tamanho deste array e' igual ao nr de jogos em que o jogador participou.
 *
 * @param string $id - player_id
 * @return array $playerEvo
 */
    public function getPlayerRankingEvo($id=null) {
        $playerEvo = array();
        $player = $this->read(null, $id);

        //$player['Player']['presencas'] = 0;
        $player['Player']['presencas'] = 0;
        $player['Player']['rating'] = 0;
        $player['Player']['ratingElo'] = 0;
        $player['Player']['vitorias'] = 0;
        $player['Player']['vit_pre'] = 0;
        $player['Player']['golos'] = 0;
        $player['Player']['golos_p_jogo'] = 0;
        $player['Player']['equipa_m'] = 0;
        $player['Player']['equipa_m_p_jogo'] = 0;
        $player['Player']['equipa_s'] = 0;
        $player['Player']['equipa_s_p_jogo'] = 0;


        // jogos terminados
        $games = ClassRegistry::init('Game')->find('list', array('conditions' => array('Game.estado' => 2)));
        // para cada jogo
        foreach($games as $gameId => $game) {
            //echo "gameid=".$gameId.'<br/>';

            // encontrar as equipas onde jogou e actualizar o seu ranking
            $options = array('conditions' => array('game_id' => $gameId));
            $teams = $this->Team->find('all', $options);

            // para cada equipa
            foreach($teams as $team) {

                // se jogou
                if($this->belongsToTeam($team, $player)) {

                    // actualizar presencas do jogador
                    $player['Player']['presencas'] += 1;

                    // actualizar vitorias do jogador se a equipa ganhou
                    if($this->isTeamWinner($team)) {
                        $player['Player']['vitorias'] += 1;
                    }

                    // actualizar ranking
                    $player['Player']['rating'] = round($player['Player']['vitorias']/$player['Player']['presencas'], 3);

                    //debug($player);

                    // adicionar este jogador/ranking ao array $evo
                    array_push($playerEvo, $player);
                }
            }
        }

        return $playerEvo;
    }

/**
 * verifica se um jogador percente a uma equipa
 *
 * @param array $team, array $player
 * @return bool
 */
    private function belongsToTeam($team, $player) {
        foreach($team['Player'] as $teamPlayer) {
            if($teamPlayer['id'] == $player['Player']['id']) {
                return true;
            }
        }
        return false;
    }

/**
 * verifica se uma equipa foi vencedora
 *
 * @param array $team
 * @return bool
 */
    private function isTeamWinner($team) {
        if($team['Team']['winner']) { return true; } else { return false; }
    }

}
