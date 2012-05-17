<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Invites Controller
 *
 * @property Invite $Invite
 */
class InvitesController extends AppController {

    public $helpers = array('Time');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Invite->recursive = 0;
		$this->set('invites', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Invite->id = $id;
		if (!$this->Invite->exists()) {
			throw new NotFoundException(__('Invalid invite'));
		}
		$this->set('invite', $this->Invite->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Invite->create();
            $this->request->data['Invite']['available'] = null;
			if ($this->Invite->save($this->request->data)) {
				$this->Session->setFlash(__('The invite has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invite could not be saved. Please, try again.'));
			}
		}
		$games = $this->Invite->Game->find('list');
		$players = $this->Invite->Player->find('list');
		$this->set(compact('games', 'players'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Invite->id = $id;
		if (!$this->Invite->exists()) {
			throw new NotFoundException(__('Invalid invite'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Invite->save($this->request->data)) {
				$this->Session->setFlash(__('The invite has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invite could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Invite->read(null, $id);
		}
		$games = $this->Invite->Game->find('list');
		$players = $this->Invite->Player->find('list');
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
		$this->Invite->id = $id;
		if (!$this->Invite->exists()) {
			throw new NotFoundException(__('Invalid invite'));
		}
		if ($this->Invite->delete()) {
			$this->Session->setFlash(__('Invite deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Invite was not deleted'));
		$this->redirect(array('action' => 'index'));
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

        foreach($invites as $key => $invite) {
            $jogadorId = str_replace('jogador', '', $key);

            if($invite) {
                $saveInvite = array('Invite' => array('game_id' => $id, 'player_id' => $jogadorId, 'available' => null));

                $this->Invite->Create();
                if($this->Invite->save($saveInvite)) {
                    //$this->Session->setFlash(__('The invite has been saved'));
                } else {
                    //$this->Session->setFlash(__('The invite could not be saved. Please, try again.'));
                }
            }
        }

        $this->redirect('/games/view/'.$id);
    }

/**
 * updateInvites method
 *
 * @param string $id
 * @return void
 */
    public function updateInvites($id = null) {


        if($this->request->data) {

            end($this->request->data);
            $playerAvailability = each($this->request->data);

            $options = array('conditions' => array('Invite.game_id' => $id, 'Invite.player_id' => $playerAvailability['key']));
            $currentInvite = $this->Invite->find('first', $options);

            if($currentInvite['Invite']['available'] != $playerAvailability['value']) {
                $currentInvite['Invite']['available'] = $playerAvailability['value'];
                $this->Invite->save($currentInvite);
            }
        }

        $this->redirect('/games/view/'.$id);

    }

/**
 * sendEmails method
 *
 * @param string $id - game_id
 * @return void
 *
 * Envia por email o template da convocatoria para todos os jogadores
 * convidados para um jogo.
 */
    public function sendEmails($id = null) {
        $invites = $this->Invite->invites($id);

        //debug($invites['invites'][0]);

        // init
        $email = new CakeEmail('gmail');
        $email->template('convocatoria', 'pbento');
        $email->emailFormat('html');
        $email->from(array('lazyfoot.noreply@gmail.com' => 'Lazyfoot Mailer'));
        $email->subject('Foste convocado!');

        // viewVars
        $email->viewVars(array('gameLink' => FULL_BASE_URL.'/lazysunday/Games/view/'.$id));

        // a data e' a mesma para todos os invites
        // TODO: formatar a data
        $gameDateSql = $invites['invites'][0]['Game']['data'];
        //echo $this->Time->format('d M, Y', $gameDateSql);
        $email->viewVars(array('gameDate' => $gameDateSql));

        //$email->to('pedrorodrigues@gmail.com');
        //$email->send();

        // not tested
        foreach($invites['invites'] as $invite) {
            $email->to($invite['Player']['email']);
            $email->send();
        }
    }
}


