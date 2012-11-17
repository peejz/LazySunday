<?php
App::uses('AppModel', 'Model');
/**
 * Team Model
 *
 * @property Game $Game
 * @property Player $Player
 */
class Team extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'game_id' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Game' => array(
			'className' => 'Game',
			'foreignKey' => 'game_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
        'Goal' => array(
            'className' => 'Goal',
            'foreignKey' => 'team_id',
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
		'Player' => array(
			'className' => 'Player',
			'joinTable' => 'players_teams',
			'foreignKey' => 'team_id',
			'associationForeignKey' => 'player_id',
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

/**
 * generate method
 *
 * @param string $id
 * @return array
 */
    public function generate($id = null, $invitedPlayers) {

        //Find Teams
        $options = array('conditions' => array('Team.game_id' => $id));
        $currentTeams = $this->find('all', $options);

        //Create Teams if they don't exist
        for($i = count($currentTeams); $i < 2; $i++) {
            $this->Create();
            $team = array('Team' => array('game_id' => $id));
            $currentTeams[$i] = $this->save($team);
        }

        //Array of Available Players
        $i = 0;
        $teams['available'] = 0;
        foreach($invitedPlayers['invites'] as $invite) {

            if($invite['Invite']['available'] === null) {
                $availableList[$i++] = array('id' => $invite['Player']['id'],
                    'name' => $invite['Player']['nome'],
                    'rating' => $invite['Player']['rating'],
                    'presencas' => $invite['Player']['presencas'],
                    'available' => null);

            }
            elseif($invite['Invite']['available'] == 0) {

            }
            else {
                $availableList[$i++] = array('id' => $invite['Player']['id'],
                    'name' => $invite['Player']['nome'],
                    'rating' => $invite['Player']['rating'],
                    'presencas' => $invite['Player']['presencas'],
                    'available' => 1);

                    //sum players that said yes
                    $teams['available'] += 1;
            }
        }


        if(!isset($availableList)) {
            return null;
        }

        //Creates empty spots in case players < 10
        while(count($availableList) < 10) {
            $availableList[$i++] = array('id' => 0,
                'name' => '__ ? __   ',
                'rating' => null,
                'presencas' => 0,
                'available' => null);
        }
        //Cut the array so it has max 10 players
        $availableList = array_slice($availableList, 0, 10);

        //Sort by rating
        foreach ($availableList as $key => $row) {
            $player_id[$key]  = $row['id'];
            $rating[$key] = $row['rating'];
        }

        array_multisort($rating, SORT_DESC, $player_id, SORT_ASC, $availableList);


        $ratingTotal = 0;
        $i = 1;
        //Find the overall rating of the 10 players
        foreach($availableList as $player) {
            $ratingTotal += $player['rating'];
            $players[$i++] = $player;
        }
        //ideal ranking for each team
        $idealTeamRating = $ratingTotal / 2;


        $len = count($players);
        $bestComb = $ratingTotal;
        //do all combinations of players and save the best one
        for ($i = 1; $i < $len - 2; $i++)
        {
            for ($j = $i + 1; $j < $len - 1; $j++)
            {
                for ($k = $j + 1; $k < $len; $k++) {

                    for ($m = $k + 1; $m < $len; $m++) {

                        for ($n = $m + 1; $n < $len; $n++) {
                            //Team Rating
                            $teamRating = $players[$i]['rating'] + $players[$j]['rating'] + $players[$k]['rating'] + $players[$m]['rating'] + $players[$n]['rating'];
                            //If the difference between this Team rating and the ideal rating is smaller, save as best combination
                            if(abs($idealTeamRating - $teamRating) < $bestComb) {
                                $bestComb = abs($idealTeamRating - $teamRating);

                                unset($teams['team_1']);
                                $teams['team_1'][$i] = $players[$i];
                                $teams['team_1'][$j] = $players[$j];
                                $teams['team_1'][$k] = $players[$k];
                                $teams['team_1'][$m] = $players[$m];
                                $teams['team_1'][$n] = $players[$n];

                                $teams['team_1_rating'] = $teamRating;
                            }
                        }
                    }
                }
            }
        }


        //remove players from team_1 from the available list to end up with team 2
        for ($i = 1; $i <= 10; $i++) {
            foreach($teams['team_1'] as $key => $team_1){
                if(isset($players[$i]) and ($i == $key)){

                    unset($players[$i]);
                }
            }
        }
        //setup variables for team_2
        $teams['team_2'] = $players;
        $teams['team_2_rating'] = $ratingTotal - $teams['team_1_rating'];

        //Team_id
        $teams['team_1_id'] = $currentTeams[0]['Team']['id'];
        $teams['team_2_id'] = $currentTeams[1]['Team']['id'];

        return $teams;
    }

    public function players($id = null){

        $options = array('conditions' => array('team_id' => $id));
        return $this->PlayersTeam->find('all', $options);
    }







}
