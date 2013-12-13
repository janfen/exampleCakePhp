<?php
class Thread extends AppModel {
    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        )
    );
	public function isOwnedBy($thread, $user) {
		return $this->field('id', array('id' => $thread, 'user_id' => $user)) === $thread;
	}
	public function getAllThread(){
		$condition =array(
			'joins' => array(
				array(
					'table' => 'users',
					'alias' => 'UserJoin',
					'type' => 'INNER',
					'conditions' => array(
						'UserJoin.id = Thread.user_id'
					)
				)
			),
/* 			'conditions' => array(
				'Message.to' => 4
			), */
			'fields' => array('UserJoin.username', 'Thread.*')
/* 			'order' => 'Message.datetime DESC' */
		);
		return $this->find('all',$condition);
	}
}
?>