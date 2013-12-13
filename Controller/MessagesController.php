<?php
class MessagesController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index($thread_id=null) {
		$this->set('thread_id',$thread_id);
		$this->set('userID',$this->Auth->user('username'));
        $this->set('messages', $this->Message->getAllMessage($thread_id));
		
    }

    public function view($id = null) {
        /* if (!$id) {
            throw new NotFoundException(__('Invalid message'));
        }

        $message = $this->Thread->findById($id);
        if (!$thread) {
            throw new NotFoundException(__('Invalid thread'));
        }
        $this->set('thread', $thread); */
	}
	public function add($thread_id=null) {
        if ($this->request->is('post')) {
            $this->Message->create();
			$this->request->data['Message']['user_id'] = $this->Auth->user('id');
			$this->request->data['Message']['thread_id'] = $thread_id;
            if ($this->Message->save($this->request->data)) {
                $this->Session->setFlash(__('Your message has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your thread.'));
        }
    }
	public function edit($thread_id=null, $id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid thread'));
		}

		$message = $this->Message->findById($id);
		if (!$thread) {
			throw new NotFoundException(__('Invalid thread'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Message->id = $id;
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Your message has been updated.'));
				return $this->redirect(array('action' => 'index', $thread_id));
			}
			$this->Session->setFlash(__('Unable to update your message.'));
		}

		if (!$this->request->data) {
			$this->request->data = $thread;
		}
	}
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Message->delete($id)) {
			$this->Session->setFlash(
				__('The message with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('action' => 'index'));
		}
	}
	public function isAuthorized($user) {
		return parent::isAuthorized($user);
	}
}
?>