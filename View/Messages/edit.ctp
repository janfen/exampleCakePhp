<h1 class="help-block">Edit Message</h1>
<?php
echo $this->Form->create('Message');
echo $this->Form->input('message', array('rows' => '3', 'class'=>'form-control'));
echo $this->Form->submit(
		'Save Message', 
		array('class' => 'btn btn-default active')
	);
echo $this->Form->end();
?>