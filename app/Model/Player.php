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

            //vitorias


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


        }

        //$this->redirect(array('action' => 'view', $id));

    }



}
