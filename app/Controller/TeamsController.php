<?php
App::uses('AppController', 'Controller');
/**
 * Teams Controller
 *
 * @property Team $Team
 */
class TeamsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		$this->set('team', $this->Team->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Team->create();
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		}
		$games = $this->Team->Game->find('list');
		$players = $this->Team->Player->find('list');
		$this->set(compact('games', 'players'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Team->read(null, $id);
		}
		$games = $this->Team->Game->find('list');
		$players = $this->Team->Player->find('list');
		$this->set(compact('games', 'players'));
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
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		if ($this->Team->delete()) {
			$this->Session->setFlash(__('Team deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Team was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * saveTeams method
 *
 * @param string $id
 * @return array
 */
    public function saveTeams($id) {
        //fetch genereated teams
        $teams = $this->Team->generate($id, $this->Invite->invites($id));

        //check if there are 10 players who said yes, otherwise exit
        if($teams['available'] != 10){
            throw new ForbiddenException(__('Só podes gravar equipas com 10 jogadores'));
        }

        for($i = 1; $i <= 2; $i++) {
            //team count
            $options = array('conditions' => array('team_id' => $teams['team_'.$i.'_id']));
            ${'team_'.$i.'_count'} = $this->PlayersTeam->find('count', $options);

            //validation
            if(${'team_'.$i.'_count'} == 0) {
                foreach ($teams['team_'.$i] as $teamPlayer) {
                    $player = array('PlayersTeam' => array('team_id' => $teams['team_'.$i.'_id'], 'player_id' => $teamPlayer['id']));
                    $this->PlayersTeam->create();
                    $this->PlayersTeam->save($player);
                }
            }
        }

        //change game state to 1
        $this->Game->id = $id;
        $this->Game->save(array('Game' => array('estado' => 1)));

        //redirect
        $this->redirect(array('controller' => 'Games', 'action' => 'view', $id));

    }

}
