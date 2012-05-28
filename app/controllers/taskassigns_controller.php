<?php
class TaskassignsController extends AppController {

	var $name = 'Taskassigns';

	function index() {
		$this->Taskassign->recursive = 0;
		$this->set('taskassigns', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid taskassign', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('taskassign', $this->Taskassign->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Taskassign->create();
			if ($this->Taskassign->save($this->data)) {
				$this->Session->setFlash(__('The taskassign has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The taskassign could not be saved. Please, try again.', true));
			}
		}
		$tasks = $this->Taskassign->Task->find('list');
		$users = $this->Taskassign->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid taskassign', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Taskassign->save($this->data)) {
				$this->Session->setFlash(__('The taskassign has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The taskassign could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Taskassign->read(null, $id);
		}
		$tasks = $this->Taskassign->Task->find('list');
		$users = $this->Taskassign->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for taskassign', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Taskassign->delete($id)) {
			$this->Session->setFlash(__('Taskassign deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Taskassign was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
