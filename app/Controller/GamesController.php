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

        // ----- Invites
        $options = array('order' => array('Invite.available' => 'desc'), 'conditions' => array('game_id' => $id));
        $invites = $this->Game->Invite->find('all', $options);
        $players = $this->Player->find('list');

        foreach($invites as $invite) {
            $invite_list[$invite['Invite']['player_id']] = null;
        }
        foreach($players as $key => $player) {
            if(!array_key_exists($key, $invite_list)) {
                $notinvited[$key] = $player;
            }
        }

        // ----- Teams
        $teamoptions = array('conditions' => array('game_id' => $id));
        $teams = $this->Game->Team->find('all', $teamoptions);
        $i = 1;
        //if(count($teams) != 2) throw new NotFoundException(__('Teams dont exist.'));
        foreach($teams as $team) {
            foreach($team['Player'] as $player) {
                ${'team'.$i.'_list'}[$player['nome']] = $player['id'];
            }
            ${'team'.$i.'_golos'} = $team['Team']['golos'];
            $i++;
        }

        // ----- Goals
        $goaloptions = array('conditions' => array('game_id' => $id));
        $goals = $this->Game->Goal->find('all', $goaloptions);
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
            foreach($team1_list as $nome => $golos){
                $team1_list[$nome] = 0;
            }
            foreach($team2_list as $nome => $golos){
                $team2_list[$nome] = 0;
            }
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
        $this->set(compact('invites', 'notinvited', 'team1_list', 'team2_list', 'team1_golos', 'team2_golos'));
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
                $saveplayer = array('Invite' => array(
                    'game_id' => $gameid['Game']['id'],
                    'player_id' => str_replace('jogador', '', $key)
                ));
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

/**
 * updateInvites method
 *
 * @param string $id
 * @return void
 */
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

            print_r($currentInvite['Invite']);

            if($currentInvite['Invite']['available'] != $invites['jogador'.$jogadorid]) {
                $currentInvite['Invite']['available'] = $invites['jogador'.$jogadorid];
                if($this->Game->Invite->save($currentInvite)) {
                    //$this->Session->setFlash(__('Invite for player '.$jogadorid.' has been updated!'));
                } else {
                    //$this->Session->setFlash(__('Could not update invite for player '.$jogadorid));
                }
            }

            next($invites);
            $i++;
        }

        $this->redirect('/games/view/'.$id);
    }

/**
 * addInvites method
 *
 * @param string $id
 * @return void
 */
    public function addInvites($id = null) {
        $this->Game->id = $id;

        $invites = $this->request->data['Game'];
        //print_r($invites);

        foreach($invites as $key => $invite) {
            //echo key($invites);
            $jogadorid = str_replace('jogador', '', $key);
            //echo $jogadorid.' => '.$invites['jogador'.$jogadorid].'<br/>';

            if($invite) {
                $saveinvite = array('Invite' => array('game_id' => $id, 'player_id' => $jogadorid, 'available' => null));

                $this->Invite->Create();
                if($this->Invite->save($saveinvite)) {
                    //$this->Session->setFlash(__('The invite has been saved'));
                } else {
                    //$this->Session->setFlash(__('The invite could not be saved. Please, try again.'));
                }
            }
        }

        $this->redirect('/games/view/'.$id);
    }
}
