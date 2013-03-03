<?php
App::uses('AppController', 'Controller');
/**
 * Players Controller
 *
 * @property Player $Player
 */
class PlayersController extends AppController {

    public function beforeFilter() {

        if ($this->action == 'view')
        {
            //$this->Player->setPlayersRankingEvo();

        }
    }
/**
 * index method
 *
 * @return void
 */
	public function index($nPre=null) {
		$this->Player->recursive = 0;

        if($nPre != null){
            $this->paginate = array('conditions' => array('Player.presencas >=' => $nPre));
        }

		$this->set('players', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Player->id = $id;
		if (!$this->Player->exists()) {
			throw new NotFoundException(__('Invalid player'));
		}
		$this->set('player', $this->Player->read(null, $id));

        $this->set('playerEvo', $this->Player->getPlayerRankingEvo($id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Player->create();
			if ($this->Player->save($this->request->data)) {
				$this->Session->setFlash(__('The player has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The player could not be saved. Please, try again.'));
			}
		}
		$teams = $this->Player->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Player->id = $id;
		if (!$this->Player->exists()) {
			throw new NotFoundException(__('Invalid player'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Player->save($this->request->data)) {
				$this->Session->setFlash(__('The player has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The player could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Player->read(null, $id);
		}
		$teams = $this->Player->Team->find('list');
		$this->set(compact('teams'));
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
		$this->Player->id = $id;
		if (!$this->Player->exists()) {
			throw new NotFoundException(__('Invalid player'));
		}
		if ($this->Player->delete()) {
			$this->Session->setFlash(__('Player deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Player was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * sidebarStats method
 *
 * @param string $id
 * @return array
 */
    public function sidebarStats() {
        //min presencas
        $players['n_min_pre'] = self::N_MIN_PRE;

        //rating
        $op_rating = array('order' => array('Player.rating' => 'desc'),
            'conditions' => array('Player.presencas >=' => self::N_MIN_PRE));
        $players['ratingList'] = $this->Player->find('all', $op_rating);

        //topGoalscorer
        $op_topGoalscorer = array('order' => array('Player.golos_p_jogo' => 'desc', 'Player.presencas' => 'desc'),
            'conditions' => array('Player.presencas >=' => self::N_MIN_PRE));
        $players['topGoalscorer'] = $this->Player->find('first', $op_topGoalscorer);

        //offensiveInfluence
        $op_offensive = array('order' => array('Player.equipa_m_p_jogo' => 'desc', 'Player.presencas' => 'desc'),
            'conditions' => array('Player.presencas >=' => self::N_MIN_PRE));
        $players['offensiveInfluence'] = $this->Player->find('first', $op_offensive);

        //defensiveInfluence
        $op_defensive = array('order' => array('Player.equipa_s_p_jogo' => 'asc'),
            'conditions' => array('Player.presencas >=' => self::N_MIN_PRE));
        $players['defensiveInfluence'] = $this->Player->find('first', $op_defensive);

        //allGoals
        $goals = $this->Goal->find('all');
        $players['allGoals'] = 0;
        foreach ($goals as $goal) {
            $players['allGoals'] += $goal['Goal']['golos'];
        }

        return $players;
    }

/**
 * updateStats method
 *
 * @param string $id
 * @return array
 */
    public function stats() {
        $this->Player->updateStats();
        //$this->redirect(array('action' => 'index'));
    }

/**
 * allAverageRating method
 *
 * Calcula o louie rating para a tabela dos jogadores
 * Tb calcula as assistências
 *
 * @param
 * @return
 */
    public function allAverageRating() {
        $this->Player->allAverageRating();
        $this->Player->allAssists();
    }

/**
 * chart method
 *
 * @param
 * @return
 */
    public function chart() {

        $this->set('players', $this->Player->chart());
    }



 /**
 * teste method
 *
 * @param string $id
 * @return array
 */
    public function teste() {
        //debug($this->Player->countPresencas(21,10));
        //debug($this->Player->bestGoalAverage(true));
        //debug($this->Player->gameRating(56));

        //$teste = $this->Player->averageRating(15);
        //$teste = $this->Player->allAverageRating();

        //$this->set('teste', $teste);

        $this->Player->assists(15);
    }



}
