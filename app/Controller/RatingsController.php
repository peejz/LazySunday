<?php
App::uses('AppController', 'Controller');

/**
 * This class calculates ratings based on the Elo system used in chess.
 *
 * @author Priyesh Patel <priyesh@pexat.com> & Michal Chovanec <michalchovaneceu@gmail.com>
 * @copyright Copyright (c) 2011 onwards, Priyesh Patel
 * @license Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License
 */
class RatingsController extends AppController
{
    public $uses = array('Rating', 'Game', 'Team', 'Player', 'Goal');

    /**
     * @var int The K Factor used.
     */


    const KFACTOR = 1000;

    /**
     * Protected & private variables.
     */
    protected $_ratingA;
    protected $_ratingB;
    
    protected $_scoreA;
    protected $_scoreB;

    protected $_expectedA;
    protected $_expectedB;

    protected $_newRatingA;
    protected $_newRatingB;

    public function index() {



        $games = $this->Game->find('all', array('conditions' => array('Game.estado' => 2)));

        $playersList = $this->Player->find('all');

        foreach($playersList as $player) {

            //$player['rating'] = 1200;

            $saveplayer = array('Player' => array('id' => $player['Player']['id'],
            //  'rating' => $player['rating'] + $ratingAdjByPlayer[$i]));
            'ratingElo' => 1200));
            //debug($saveplayer);
            $this->Player->save($saveplayer);
        }


        foreach($games as $key => $game) {



            //Find Teams for this game
            $teams = $this->Team->find('all', array('conditions' => array('Team.game_id' => $game['Game']['id'])));

            //reset var $rating
            $rating[0] = null;
            $rating[1] = null;
            $i = 0;

            foreach($teams as $team) {

                foreach($team['Player'] as $player) {

                    $rating[$i] += $player['ratingElo'];

                }
                $teamGoals[$i] = $team['Team']['golos'];
                $i++;

            }


            //Team ratings
            $ratingA = $rating[0];
            $ratingB = $rating[1];
            $teamRating = $rating[0]." - ".$rating[1];
            //Game Score
            $scoreA = $teamGoals[0];
            $scoreB = $teamGoals[1];
            $scoreTotal = $scoreA + $scoreB;

            if($scoreA > $scoreB){
                $scoreA = 1;
                $scoreB = 0;
            }
            else{
                $scoreA = 0;
                $scoreB = 1;
            }

            //Goal percentage
           /* if($scoreTotal != 1) {
                $percent_A = $scoreA / $scoreTotal;
                $percent_B = $scoreB / $scoreTotal;
            }
            else {
                if($scoreA == 1) {
                    $percent_A = 0.666;
                    $percent_B = 0.333;
                }
                else {
                    $percent_A = 0.333;
                    $percent_B = 0.666;
                }
            }*/


            //calculate ratings adjustement
            $this->construct($ratingA,$ratingB,$scoreA,$scoreB);
            $newRatings = $this->getNewRatings();

            //debug($rating);

            //what to adjust each player to
            $ratingAdjByPlayer[0] = round(($newRatings['a'] - $ratingA)/5);
            $ratingAdjByPlayer[1] = round(($newRatings['b'] - $ratingB)/5);

            $i=0;

            //debug($teams);
            foreach($teams as $team) {

                foreach($team['Player'] as $player) {



                    $saveplayer = array('Player' => array('id' => $player['id'],
                                                          'ratingElo' => $player['ratingElo'] + $ratingAdjByPlayer[$i]));
                                                           // 'rating' => 1200));
                    //debug($saveplayer);
                    $this->Player->save($saveplayer);


                    $players[$player['nome']] = ($player['ratingElo'] + $ratingAdjByPlayer[$i])." ".$teamRating." "." adjust: ".$ratingAdjByPlayer[$i];

                }
                //$teamGoals[$i] = $team['Team']['golos'];
                $teamList[$i] = $players;
                unset($players);
                $i++;

            }

            $gameList[] = $teamList;

            //echo $ratingAdjByPlayer."</br>";

            //echo ($newRatings['a'] - $ratA) / 5;
            //debug($this->getNewRatings());


        }
        //debug($gameList);
        $this->set('gameList', $gameList);
    }

    /**
     * Costructor function which does all the maths and stores the results ready
     * for retrieval.
     *
     * @param int Current rating of A
     * @param int Current rating of B
     * @param int Score of A
     * @param int Score of B
     */
    public function construct($ratingA,$ratingB,$scoreA,$scoreB)
    {
        $this->_ratingA = $ratingA;
        $this->_ratingB = $ratingB;
        $this->_scoreA = $scoreA;
        $this->_scoreB = $scoreB;

        $expectedScores = $this -> _getExpectedScores($this -> _ratingA,$this -> _ratingB);
        $this->_expectedA = $expectedScores['a'];
        $this->_expectedB = $expectedScores['b'];

        $newRatings = $this ->_getNewRatings($this -> _ratingA, $this -> _ratingB, $this -> _expectedA, $this -> _expectedB, $this -> _scoreA, $this -> _scoreB);
        $this->_newRatingA = $newRatings['a'];
        $this->_newRatingB = $newRatings['b'];
    }

    /**
     * Set new input data.
     *
     * @param int Current rating of A
     * @param int Current rating of B
     * @param int Score of A
     * @param int Score of B
     */
    public function setNewSettings($ratingA,$ratingB,$scoreA,$scoreB)
    {
        $this -> _ratingA = $ratingA;
        $this -> _ratingB = $ratingB;
        $this -> _scoreA = $scoreA;
        $this -> _scoreB = $scoreB;

        $expectedScores = $this -> _getExpectedScores($this -> _ratingA,$this -> _ratingB);
        $this -> _expectedA = $expectedScores['a'];
        $this -> _expectedB = $expectedScores['b'];

        $newRatings = $this ->_getNewRatings($this -> _ratingA, $this -> _ratingB, $this -> _expectedA, $this -> _expectedB, $this -> _scoreA, $this -> _scoreB);
        $this -> _newRatingA = $newRatings['a'];
        $this -> _newRatingB = $newRatings['b'];
    }

    /**
     * Retrieve the calculated data.
     *
     * @return Array An array containing the new ratings for A and B.
     */
    public function getNewRatings()
    {
        return array (
            'a' => $this -> _newRatingA,
            'b' => $this -> _newRatingB
        );
    }

    /**
     * Protected & private functions begin here
     */

    protected function _getExpectedScores($ratingA,$ratingB)
    {
        $expectedScoreA = 1 / ( 1 + ( pow( 10 , ( $ratingB - $ratingA ) / 400 ) ) );
        $expectedScoreB = 1 / ( 1 + ( pow( 10 , ( $ratingA - $ratingB ) / 400 ) ) );

        return array (
            'a' => $expectedScoreA,
            'b' => $expectedScoreB
        );
    }

    protected function _getNewRatings($ratingA,$ratingB,$expectedA,$expectedB,$scoreA,$scoreB)
    {
        $newRatingA = $ratingA + ( self::KFACTOR * ( $scoreA - $expectedA ) );
        $newRatingB = $ratingB + ( self::KFACTOR * ( $scoreB - $expectedB ) );

        return array (
            'a' => $newRatingA,
            'b' => $newRatingB
        );
    }

}