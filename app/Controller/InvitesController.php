<?php
App::uses('AppController', 'Controller');
/**
 * Invites Controller
 *
 * @property Invite $Invite
 */
class InvitesController extends AppController {


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
}
