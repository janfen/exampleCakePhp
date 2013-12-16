<?php
class Message extends AppModel {
    public $validate = array(
        'message' => array(
            'rule' => 'notEmpty'
        )
    );
	public function isOwnedBy($message, $user) {
		return $this->field('id', array('id' => $message, 'user_id' => $user)) === $message;
	}
	public function getAllMessage($thread_id){
		$condition =array(
			'joins' => array(
				array(
					'table' => 'users',
					'alias' => 'UserJoin',
					'type' => 'INNER',
					'conditions' => array(
						'UserJoin.id = Message.user_id'
					)
				)
			),
 			'conditions' => array(
				'Message.thread_id ='. $thread_id,
			), 
			'fields' => array('UserJoin.username', 'Message.*')
/* 			'order' => 'Message.datetime DESC' */
		);
		return $this->find('all',$condition);
	}
}
?>