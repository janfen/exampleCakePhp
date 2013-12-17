<script type="text/javascript">
	var fReload=function(){
		console.log('fReload run');
		setTimeout(fReload,1000);
		$.ajax({
            type:'POST',
            url: '<?php echo Router::Url(array('controller' => 'messages', 'action' => 'index',8), TRUE); ?>',
            success: function(response) {
                jQuery('#chatboxContainer').html(response);
            },
			data:jQuery('#threadid').serialize()
        });
	};
	fReload();
</script>
<p><?php echo 'Xin chao:'.$userName; ?> <?php echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout')); ?> <h1>List Message</h1></p>
<p><?php echo $this->Html->link('Add Message', array('action' => 'add', $thread_id)); ?></p>
<div class="chatboxContainer" id ="content">