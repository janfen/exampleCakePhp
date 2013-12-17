<?php
class MessagesController extends AppController {
    public $helpers = array('Html', 'Form');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('userID',$this->Auth->user('id'));
		$this->set('userName',$this->Auth->user('username'));
	}
	
    public function index($thread_id=null) {
		$this->set('thread_id',$thread_id);
        $this->set('messages', $this->Message->getAllMessage($thread_id));
		
    }

    public function view($thread_id = null) {
		$this->set('thread_id',$thread_id);
        	$this->set('listMessages', $this->Message->getAllMessage($thread_id));
	}
	/* public function add($thread_id=null) {
        if ($this->request->is('post')) {
            $this->Message->create();
			$this->request->data['Message']['user_id'] = $this->Auth->user('id');
			$this->request->data['Message']['thread_id'] = $thread_id;
            if ($this->Message->save($this->request->data)) {
                $this->Session->setFlash(__('Your message has been saved.'));
                return $this->redirect(array('action' => 'index', $thread_id));
            }
            $this->Session->setFlash(__('Unable to add your message.'));
        }
    } */
	public function add() {
		$this->Message->create();
		 $userid = $this->Auth->user("id");
		
		$this->request->data["user_id"] = $userid;
		if (empty($this->request->data["thread_id"])) {
			$this->request->data["thread_id"] = 1;
		}  
		$this->Message->save($this->request->data);
	 }
	public function edit($id, $thread_id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid message'));
		}

		$message = $this->Message->findById($id);
		if (!$message) {
			throw new NotFoundException(__('Invalid message'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Message->id = $id;
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Your message has been updated.'));
				return $this->redirect(array('action' => 'view', $thread_id));
			}
			$this->Session->setFlash(__('Unable to update your message.'));
		}

		if (!$this->request->data) {
			$this->request->data = $message;
		}
	}
	public function delete($id, $thread_id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		/* $message = $this->Message->findById($id);
		$message -> isDelete =true; */
		$this->Message->id = $id;
		if($this->Message->saveField('isDelete', true)){
			$this->Session->setFlash(__('Your message has been updated.'));
			return $this->redirect(array('action' => 'view', $thread_id));
		}
		/* if ($this->Message->save($message)) {
				$this->Session->setFlash(__('Your message has been updated.'));
				return $this->redirect(array('action' => 'index', $thread_id));
		} */
		/* if ($this->Message->delete($id)) {
			$this->Session->setFlash(
				__('The message with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('action' => 'index', $thread_id));
		} */
	}
	public function isAuthorized($user) {
		return parent::isAuthorized($user);
	}
}
?>
