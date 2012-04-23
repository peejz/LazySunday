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
        // ----- Teams
        $teamoptions = array('conditions' => array('game_id' => $id));
        $teams = $this->Team->find('all', $teamoptions);
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
        $goals = $this->Goal->find('all', $goaloptions);
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

}
