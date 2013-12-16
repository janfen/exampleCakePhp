<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User', array('class'=>'form-horizontal')); ?>
	
    <fieldset>
        <legend><span class="help-block"><?php echo __('Please enter your username and password'); ?></span></legend>
        <?php echo $this->Form->input('username', array('class'=>'form-control'));
        echo $this->Form->input('password', array('class'=>'form-control '));
    ?>
    </fieldset>
<?php

	echo $this->Form->button('Login', array('type'=>'submit', 'class'=>'btn btn-default active'));
	echo ' ';
	echo $this->Html->link(
		'Create User',
		array('action' => 'add'), array('class' => 'btn btn-default active' ,'role'=>'button', 'margin-left'=> '10px')
	);

	echo $this->Form->end();
?>

</div>

