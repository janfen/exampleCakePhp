<h1 class="help-block">Add Thread</h1>
<?php
echo $this->Form->create('Thread');
echo $this->Form->input('name', array('class'=>'form-control'));
echo $this->Form->submit(
		'Save Thread', 
		array('class' => 'btn btn-default active')
	);
echo $this->Form->end();
?>