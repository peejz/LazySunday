<?php
App::uses('AppModel', 'Model');
/**
 * Game Model
 *
 * @property Goal $Goal
 * @property Invite $Invite
 * @property Team $Team
 */
class Game extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'data';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'data' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
			'foreignKey' => 'game_id',
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
			'foreignKey' => 'game_id',
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
		'Team' => array(
			'className' => 'Team',
			'foreignKey' => 'game_id',
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
 * teams_goals method
 *
 * @param string $id
 * @return array
 */

    public function teamsGoals($id){

        $goaloptions = array('conditions' => array('game_id' => $id));
        $goals = $this->Goal->find('all', $goaloptions);



        $i = 1;
        $team_1_score = 0;
        $team_2_score = 0;
        foreach($goals as $data){
            if($i <= 5){
                $team_1_data[$data['Player']['nome']]['golos'] = $data['Goal']['golos'];
                $team_1_data[$data['Player']['nome']]['assistencias'] = $data['Goal']['assistencias'];
                $team_1_data[$data['Player']['nome']]['player_points'] = $data['Goal']['player_points'];

                $team_1_score =+ $team_1_score + $data['Goal']['golos'];
            }
            else{
                $team_2_data[$data['Player']['nome']]['golos'] = $data['Goal']['golos'];
                $team_2_data[$data['Player']['nome']]['assistencias'] = $data['Goal']['assistencias'];
                $team_2_data[$data['Player']['nome']]['player_points'] = $data['Goal']['player_points'];

                $team_2_score =+ $team_2_score + $data['Goal']['golos'];
            }

            $i++;
        }

        //debug($team_1_data);

        return array('team_1_data' => $team_1_data,
                     'team_2_data' => $team_2_data,
                     'team_1_score' => $team_1_score,
                     'team_2_score' => $team_2_score);


    }


    /**
     * faz o rating de cada jogador no jogo seleccionado
     *
     * @param array $team
     * @return bool
     */

    public function playerPoints($id) {

        // Peso dos golos e assistências no rating final [0 a 1] ////
            $pointsWeight = 0.25;
        // Pontos por jogo
            $pointsPerGame = 5000;
        // Peso dos golos em relação às assistências [0 a 1]
            $goalAssistWeight = 0.618;
        //////////////////////////////////////////////

        $teams = $this->Team->find('all', array('conditions' => array('Team.game_id' => $id)));

        $totalGoals = $teams[0]['Team']['golos'] + $teams[1]['Team']['golos'];

        /* loop para cada equipa
           no 1º loop criam-se os pontos base para cada equipa
           no 2º loop fazem-se os pontos para cada jogador.
        */
        $i=0;
        foreach($teams as $team){
            //pontos totais de cada equipa
            $teamPoints[$i]['Team'] = ($teams[$i]['Team']['golos'] / $totalGoals) * $pointsPerGame;

            //pontos base, cada jogador recebe pelo menos estes pontos
            $teamPoints[$i]['Base'] = ($teamPoints[$i]['Team'] * (1 - $pointsWeight))/5;

            //pontos a serem distribuidos pelos jogadores que marcaram golos e fizeram assistências
            $teamPoints[$i]['specialPoints'] = $teamPoints[$i]['Team'] * $pointsWeight;

            //total de assistências nesta equipa
            $teams[$i]['Team']['assistencias'] = 0;

            foreach($team['Goal'] as $player){
                $teams[$i]['Team']['assistencias'] += $player['assistencias'];
            }

            //IMPORTANTE -> pontos por cada Golo. Segue a proporção indicada em $goalAssistWeight
            $pointsPerGoal = $teamPoints[$i]['specialPoints'] / ($teams[$i]['Team']['golos'] +
                                                                $teams[$i]['Team']['assistencias'] * $goalAssistWeight);
            //este valor descobre-se usando o ratio
            $pointsPerAssist = $pointsPerGoal * $goalAssistWeight;

          foreach($team['Goal'] as $player){

              $goalPoints = $player['golos'] * $pointsPerGoal;
              $assistPoints = $player['assistencias'] * $pointsPerAssist;

              //somar os pontos base mais os pontos especiais
              $playerPoints = $teamPoints[$i]['Base'] + ($goalPoints + $assistPoints);

              //$pointsSave = array('Goal' => array('game_id' => $id, 'player_id' => $player['player_id'], 'player_points' => $playerPoints));
              $pointsSave = array('Goal' => array('player_points' => $playerPoints));
              $this->Goal->id = $player['id'];
              $this->Goal->save($pointsSave);
          }

          $i++;
        }
    }

/**
 * calcula o player points para todos os jogos
 *
 * @param
 * @return
 */

    public function allPlayerPoints() {

        $games = $this->find('all');

        foreach($games as $game){

            $game['Game']['id'];
            $this->playerPoints($game['Game']['id']);
        }
    }

    /**
     * adiciona o team id a cada golo
     *
     * @param
     * @return
     */

    public function teamIdtoGoal() {

        $teams = $this->Team->find('all');

        foreach($teams as $team){

            foreach($team['Player'] as $player){
            $goals = array('Goal' => array('team_id' => $team['Team']['id']));

            $search = $this->Goal->find('first', array('conditions' => array('Goal.game_id' => $team['Team']['game_id'],
                                                                   'Goal.player_id' => $player['id'])));
            $this->Goal->id = $search['Goal']['id'];
            $this->Goal->save($goals);
            }

        }

        return $goal;
    }


}
