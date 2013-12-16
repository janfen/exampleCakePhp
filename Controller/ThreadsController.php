<?php
class ThreadsController extends AppController {
    public $helpers = array('Html', 'Form');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('userID',$this->Auth->user('id'));
		$this->set('userName',$this->Auth->user('password'));
	}
	
    public function index() {		
        $this->set('threads', $this->Thread->getAllThread());
		
    }

	
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid thread'));
        }

        $thread = $this->Thread->findById($id);
        if (!$thread) {
            throw new NotFoundException(__('Invalid thread'));
        }
        $this->set('thread', $thread);
	}
	public function add() {
        if ($this->request->is('post')) {
            $this->Thread->create();
			$this->request->data['Thread']['user_id'] = $this->Auth->user('id');
            if ($this->Thread->save($this->request->data)) {
                $this->Session->setFlash(__('Your thread has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your thread.'));
        }
    }
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid thread'));
		}

		$thread = $this->Thread->findById($id);
		if (!$thread) {
			throw new NotFoundException(__('Invalid thread'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Thread->id = $id;
			if ($this->Thread->save($this->request->data)) {
				$this->Session->setFlash(__('Your thread has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your thread.'));
		}

		if (!$this->request->data) {
			$this->request->data = $thread;
		}
	}
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Thread->delete($id)) {
			$this->Session->setFlash(
				__('The thread with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('action' => 'index'));
		}
	}
	public function isAuthorized($user) {
		return parent::isAuthorized($user);
	}
}
?>