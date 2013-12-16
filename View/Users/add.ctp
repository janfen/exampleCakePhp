<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><span class="help-block"><?php echo __('Add new User'); ?></span></legend>
        <?php echo $this->Form->input('username', array('class'=>'form-control'));
        echo $this->Form->input('password', array('class'=>'form-control'));
    ?>
    </fieldset>
	
<?php 
	echo $this->Form->submit(
		'Create', 
		array('class' => 'btn btn-default active')
	);
	echo $this->Form->end(); ?>
</div>