<?php
App::uses('AppController', 'Controller');
/**
 * Goals Controller
 *
 * @property Goal $Goal
 */
class GoalsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Goal->recursive = 0;
		$this->set('goals', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Goal->id = $id;
		if (!$this->Goal->exists()) {
			throw new NotFoundException(__('Invalid goal'));
		}
		$this->set('goal', $this->Goal->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Goal->create();
			if ($this->Goal->save($this->request->data)) {
				$this->Session->setFlash(__('The goal has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The goal could not be saved. Please, try again.'));
			}
		}
		$players = $this->Goal->Player->find('list');
		$games = $this->Goal->Game->find('list');
		$this->set(compact('players', 'games'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Goal->id = $id;
		if (!$this->Goal->exists()) {
			throw new NotFoundException(__('Invalid goal'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Goal->save($this->request->data)) {
				$this->Session->setFlash(__('The goal has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The goal could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Goal->read(null, $id);
		}
		$players = $this->Goal->Player->find('list');
		$games = $this->Goal->Game->find('list');
		$this->set(compact('players', 'games'));
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
		$this->Goal->id = $id;
		if (!$this->Goal->exists()) {
			throw new NotFoundException(__('Invalid goal'));
		}
		if ($this->Goal->delete()) {
			$this->Session->setFlash(__('Goal deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Goal was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
