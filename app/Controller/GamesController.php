<?php
App::uses('AppController', 'Controller');
/**
 * Games Controller
 *
 * @property Game $Game
 */
class GamesController extends AppController {

    public $uses = array('Game', 'Invite', 'Goal', 'Team', 'Player');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Game->recursive = 0;
		$this->set('games', $this->paginate());
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

        $options = array('order' => array('Invite.available' => 'desc'), 'conditions' => array('game_id' => $id));
        $invites = $this->Game->Invite->find('all', $options);

        $players = $this->Player->find('list');
        print_r($players);

        /*foreach($players as $key => $player) {
            if(!array_key_exists($key, $invitelist)) {
                echo 'o mambo esta la dentro<br/>';
            }
        }*/

        $notinvited = array();
        $this->set(compact('invites', 'notinvited'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

            $savegame['Game'] = array_slice($this->request->data['Game'], 0, 1);

            $saveplayers = array_slice($this->request->data['Game'], 1);

			$this->Game->create();
            $gameid = $this->Game->save($savegame);

            foreach($saveplayers as $key => $player) {
                $saveplayer = array('Invite' => array('game_id' => $gameid['Game']['id'], 'player_id' => str_replace('jogador', '', $key)));
                //print_r($saveplayer);
                //echo '<br/>';
                if($player) {
                    $this->Invite->Create();
                    if($this->Invite->save($saveplayer)) {
                        $this->Session->setFlash(__('The game has been saved'));
                    } else {
                        $this->Session->setFlash(__('The game could not be saved. Please, try again.'));
                    }
                }
            }

            //$this->redirect(array('action' => 'index'));
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

    public function updateInvites($id = null) {
        $this->Game->id = $id;

        $numInvites = count($this->request->data['Game']);
        $invites = $this->request->data['Game'];
        print_r($invites);
        $i=0;
        while($i != $numInvites) {
            //echo key($invites);

            $jogadorid = str_replace('jogador', '', key($invites));
            //echo $jogadorid.' => '.$invites['jogador'.$jogadorid].'<br/>';

            $options = array('conditions' => array('Invite.game_id' => $id, 'Invite.player_id' => $jogadorid));
            $currentInvite = $this->Game->Invite->find('first', $options);

            //print_r($currentInvite['Invite']);

            // $invites[jogadorID] => 1
            // $invites[jogadorID] => 0
            // $invites[jogadorID] => null
            /*if($invites['jogador'.$jogadorid]) {
                $currentInvite['Invite']['available'] = true;
                $currentInvite['Invite']['answered'] = true;
            } else if(!$invites['jogador'.$jogadorid] && !$currentInvite['Invite']['answered']) {
                $currentInvite['Invite']['available'] = false;
                $currentInvite['Invite']['answered'] = true;
            } else if(is_null($invites['jogador'.$jogadorid])) {
                $currentInvite['Invite']['answered'] = false;
            }*/

            if($currentInvite['Invite']['available'] != $invites['jogador'.$jogadorid]) {
                $currentInvite['Invite']['available'] = $invites['jogador'.$jogadorid];
                $this->Game->Invite->save($currentInvite);
            }




            /*if($this->Game->Invite->save($currentInvite)) {
                $this->Session->setFlash(__('Invite for player '.$jogadorid.' has been updated!'));
            } else {
                $this->Session->setFlash(__('Could not update invite for player '.$jogadorid));
            }*/


            next($invites);
            $i++;
        }

        $this->redirect('/games/view/'.$id);
    }
}
