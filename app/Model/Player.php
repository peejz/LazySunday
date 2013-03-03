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
 * countPresencas method
 *
 * @param string $id
 * @return int
 */
    public function countPresencas($id = null, $gameID = null) {
        //find all presencas
        if(!isset($gameID)){
            $options = array('conditions' => array('player_id' => $id));
            return $this->PlayersTeam->find('count', $options);
        }
        //find presencas until designated gameID
        else{

            //data
            $player = $this->findById($id);
            //debug($player);

            //var
            $presencas = 0;

            //
            foreach($player['Team'] as $team){
                if($team['game_id'] <= $gameID){
                $presencas += 1;
                }
            }

            return $presencas;
        }

    }

/**
 * wins method
 *
 * @param string $id
 * @return int
 */
    public function countWins($id = null) {
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
    public function countGoals($id = null) {
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
 * goalEvo method
 *
 * @param string $id
 * @return array
 *
 * key   gameID
 * value bestGoalAverage at that time
 */

    public function goalEvo(){
        //data
        $allGoals = $this->Goal->find('all');

        //cycle through all goals and create and array with this form $array[gameID][playerID][current]
        //                                                                                    [total]
        //                                                                                    [golos_p_jogo]
        foreach($allGoals as $goal){

            //variables
            $gameID = $goal['Goal']['game_id'];
            $playerID = $goal['Goal']['player_id'];
            $golos = $goal['Goal']['golos'];

            //data
            $player = $this->findById($playerID);

            //playerGoals Array keeps the total of goals game by game
            if(!isset($playerGoals[$playerID])){
                $playerGoals[$playerID] = $golos;
            }
            else{
                $playerGoals[$playerID] += $golos;
            }

            //save array
            $gameList[$gameID][$playerID]['current'] = $golos;
            $gameList[$gameID][$playerID]['total'] = $playerGoals[$playerID];
            $gameList[$gameID][$playerID]['golos_p_jogo'] = round($playerGoals[$playerID] /
                                                                ($this->countPresencas($playerID, $gameID)), 2);

        }

        //cycle trhough previous array and create $goalEvo[gameID][bestGoalAverage]
        foreach($gameList as $gameID => $game){

            $bestGoal['average'] = 0;

            foreach($game as $playerID => $player){
                if($player['golos_p_jogo'] > $bestGoal['average']){
                    $bestGoal['average'] = $player['golos_p_jogo'];
                    $bestGoal['id'] = $playerID;
                }

            }

            if(isset($goalEvoID)){
                $lastEntry = end($goalEvoID);
                $key = key($lastEntry);
                $value = $lastEntry[$key];


                if(!array_key_exists($key, $game)){
                    if($value > $bestGoal['average']){
                        $bestGoal['average'] = $value;
                        $bestGoal['id'] = $key;
                    }
                }
            }

            //var used for loop
            $goalEvoID[$gameID] = array($bestGoal['id'] => $bestGoal['average']);
            //return var
            $goalEvo[$gameID] = $bestGoal['average'];

        }

        //return end($goalEvo_);
        return $goalEvo;
    }

/**
 * equipaMS method
 *
 * @param string $id
 * @return array
 */
    public function equipaMS($id = null) {

        //data
        $player = $this->findById($id);
        $presencas = $this->countPresencas($id);
        $games = ClassRegistry::init('Game')->find('all');
        $ignoreTeams = array(5, 6, 7, 8, 9, 10);

        //init var
        $equipaMS['M'] = 0;
        $equipaMS['S'] = 0;

        //create arrays of the games played by this player and the teams he belonged to
        foreach($player['Team'] as $team){
            if(!in_array($team['id'], $ignoreTeams)) {
            $gamesPlayed[] = $team['game_id'];
            $teamsPlayed[] = $team['id'];
            }
        }

        //in case player is not on any teams return 0
        if(!isset($teamsPlayed)){
            return array('M' => 0, 'S' => 0, 'M_p_jogo' => 0, 'S_p_jogo' => 0);
        }

        //cycle game by game
        foreach($games as $game){
            //cycle both teams of that game
            foreach($game['Team'] as $team){
                //If the player played in this game...
                if((!in_array($team['id'], $ignoreTeams)) and (in_array($team['game_id'], $gamesPlayed) )) {

                    //... and played in this team
                   if(in_array($team['id'], $teamsPlayed)){
                       $equipaMS['M'] += $team['golos'];
                   }
                   else{
                       $equipaMS['S'] += $team['golos'];
                   }
                }

            }
        }

        //Calculate p_jogo
        $equipaMS['M_p_jogo'] = round($equipaMS['M']/$presencas, 2);
        $equipaMS['S_p_jogo'] = round($equipaMS['S']/$presencas, 2);

        return $equipaMS;
    }

/**
 * updateStats method
 *
 * @param string $id
 * @return void
 */
    public function updateStats() {

        //player array
        $players = $this->find('all');

        //construct allPlayers array
        foreach($players as $player) {
            //var
            $playerID = $player['Player']['id'];

            $allPlayers[$playerID]['victorias'] = $this->countWins($playerID);
            $allPlayers[$playerID]['golos'] = $this->countGoals($playerID);
            $allPlayers[$playerID]['presencas'] = $this->countPresencas($playerID);

            if($allPlayers[$playerID]['golos'] != 0) {
                $allPlayers[$playerID]['golos_p_jogo'] = round($allPlayers[$playerID]['golos'] /
                                                             $allPlayers[$playerID]['presencas'], 2);
            }
            else {
                $allPlayers[$playerID]['golos_p_jogo'] = 0;
            }

            $equipaMS = $this->equipaMS($playerID);
            $allPlayers[$playerID]['equipa_m'] = $equipaMS['M'];
            $allPlayers[$playerID]['equipa_m_p_jogo'] = $equipaMS['M_p_jogo'];
            $allPlayers[$playerID]['equipa_s'] = $equipaMS['S'];
            $allPlayers[$playerID]['equipa_s_p_jogo'] = $equipaMS['S_p_jogo'];
        }

        //var init
        $bestGoalAverage = 0;
        //find current topGoalscorer
        foreach($allPlayers as $player){
            if($player['golos_p_jogo'] > $bestGoalAverage){
                $bestGoalAverage = $player['golos_p_jogo'];
            }
        }

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

            //generateRating
            $goalsRating = $data['golos_p_jogo'] / $bestGoalAverage;
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
            $rating *= 1000;



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
        $player['Player']['ratingLouie'] = 0;
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
                    $player['Player']['rating'] = round($player['Player']['vitorias']/$player['Player']['presencas'], 3)*1000;

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

/**
 * faz a média dos ratings dos ultimos x jogos
 *
 * @param array $team
 * @return bool
 */
    public function averageRating($id) {

        $lastGames = 20;

        $ratings = $this->Goal->find('all', array('conditions' => array('Goal.player_id' => $id),
                                                   'order' => array('Goal.game_id DESC'),
                                                   'limit' => $lastGames));

        $nRatings = count($ratings);

        $sumRatings = 0;
        foreach($ratings as $rating){
            $sumRatings += $rating['Goal']['player_points'];
        }

        if($nRatings == 0){
            return 0;
        }
        else
        {
            return ($sumRatings / $nRatings);
        }

    }

/**
 * faz a média dos ratings dos ultimos x jogos para todos os jogadores
 *
 * @param array $team
 * @return bool
 */
    public function allAverageRating() {

       $players = $this->find('all');

        foreach($players as $player){

            //get average
           $rating = $this->averageRating($player['Player']['id']);

            //save
            $save = array('Player' => array('ratingLouie' => $rating));
            $this->id = $player['Player']['id'];
            $this->save($save);
        }
    }

/**
 * calcula as assistências de um determinado jogador
 *
 * @param none
 * @return none
 */
    public function assists($playerId) {

        //jogo a partir do qual se começou a contar as assistências
        $gameId = 59;

        //encontrar as assistências que são guardadas na tabela dos golos
        $games = $this->Goal->find('all', array('conditions' => array('game_id >=' => $gameId, 'player_id =' => $playerId)));

        //nº de jogos com assistências
        $nGames = count($games);

        //somar assistências
        $assists['assist'] = 0;
        foreach($games as $game){
            $assists['assist'] += $game['Goal']['assistencias'];
        }

        //assistências por jogo
        if($assists['assist'] != 0){
        $assists['assist_p_jogo'] = round($assists['assist'] / $nGames, 2);
        }
        else
        {
        $assists['assist_p_jogo'] = 0;
        }


        return $assists;
    }

/**
 * calcula as assistências para todos os jogadores e salva para a tabela Players
 * assist e assist_p_jogo
 *
 * @param none
 * @return none
 */
    public function allAssists() {

        $players = $this->find('all');

        foreach($players as $player){

            //get average
            $assists = $this->assists($player['Player']['id']);

            //save
            $save = array('Player' => array('assist' => $assists['assist'], 'assist_p_jogo' => $assists['assist_p_jogo']));
            $this->id = $player['Player']['id'];
            $this->save($save);
        }
    }

/**
 * chart method
 *
 * Cria um gráfico highcharts com a evolução simultânea de
 * todos os jogadores usando o sistema do Louie
 *
 * @param none
 * @return array
 */
    public function chart() {

        //criar uma lista de jogadores com mais de X presenças
        $playersBulk = $this->find('all', array('conditions' => array('presencas >=' => self::N_MIN_PRE)));

        foreach($playersBulk as $player){
            $players[$player['Player']['id']][0]=500;
        }

        //passar jogo a jogo, golo a golo e verificar se o jogador faz parte
        //não fazendo copia-se o rating anterior
        $gamesBulk = ClassRegistry::init('Game')->find('all');

        $i = 1;
        foreach($gamesBulk as $game){

            foreach($game['Goal'] as $goal){
                if(array_key_exists($goal['player_id'], $players)){
                $players[$goal['player_id']][$i] = $goal['player_points'];
                }
            }

            foreach($players as $id => $player){
                if(!isset($player[$i])){
                    $players[$id][$i] = $player[($i - 1)];
                }
            }

            $i++;
        }

        //debug($players);

        return $players;
    }




}
