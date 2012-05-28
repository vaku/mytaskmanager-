<?php

class CommentsController extends AppController {

    var $name = 'Comments';
    var $uses = array('User', 'Task', 'Taskassign', 'Comment');

    function index() {
        $this->Comment->recursive = 0;
        $this->set('comments', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid comment', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('comment', $this->Comment->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->Comment->create();
            if ($this->Comment->save($this->data)) {
                $this->Session->setFlash(__('The comment has been saved', true));
                $this->redirect(array('controller' => 'tasks', 'action' => 'view', $this->data['Comment']['task_id']));
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
            }
        }
        $tasks = $this->Comment->Task->find('list');
        $users = $this->Comment->User->find('list');
        $this->set(compact('tasks', 'users'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid comment', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Comment->save($this->data)) {
                $this->Session->setFlash(__('The comment has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Comment->read(null, $id);
        }
        $tasks = $this->Comment->Task->find('list');
        $users = $this->Comment->User->find('list');
        $this->set(compact('tasks', 'users'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for comment', true));
            $this->redirect(array('action' => 'index'));
        }

        $userrole = $this->User->getRole($this->Auth->user('id')); // getting userrole and check access.

        if ($userrole != 'admin') {
            $this->Session->setFlash('admin access only');
            $this->redirect(array("controller" => "comments", "action" => "index"));

            exit();
        } else {
            if ($this->Comment->delete($id)) {
                $this->Session->setFlash(__('Comment deleted', true));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Comment was not deleted', true));
            $this->redirect(array('action' => 'index'));
        }
    }

}
