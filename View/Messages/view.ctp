
<p><?php echo 'Xin chao:'.$userName; ?> <?php echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout')); ?> <h1>List Message</h1></p>
<div class="chatboxContainer" id ="chatboxContainer">

<table class="table table-hover">
    <tr>
        <th>Id</th> 
        <th>Msg</th>
        <th>User created</th>
        <th>Created</th>
        <th>Modified</th>
		<th>Action</>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($listMessages as $message): 
	
		?>
    <tr>
        <td><?php echo $message['Message']['id']; ?></td>
        <td>
			<?php
				if($message['Message']['isDelete']){
					
						echo "Message has removed" ;

				}
				else{
					echo $message['Message']['message'];
				}
            ?>
        </td>
        
		<td>
            <?php echo $message['UserJoin']['username']; ?>
        </td>
		
        <td>
            <?php echo $message['Message']['created']; ?>
        </td>
		
		<td>
            <?php echo $message['Message']['modified']; ?>
        </td>
		
		<td>
            <?php
				if($message['Message']['isDelete']){
					echo "Deleted." ;
				}
				else{	
					if($userID==$message['Message']['user_id']){
						echo $this->Html->link(
							'Edit', array('action' => 'edit', $message['Message']['id'],$thread_id)
						);
						echo " ";
						echo $this->Form->postLink(
							'Delete',
							array('action' => 'delete', $message['Message']['id'], $thread_id),
							array('confirm' => 'Are you sure?')
						);
					}
					else{
						echo "Can't Delete";
					}
				}
            ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
</div>
<h1>Send Message</h1>
 <form id="mpost">
  <?php 
	   echo $this->Form->input('message',array('size'=>140, 'placeholder'=>'Input message','row'=>3, 'class'=>'form-control')); 
   echo $this->Form->input('thread_id', array("type" => "hidden", 'value'=>$thread_id)); 
  ?> 
 </form>
 <p><a id="sendMessage" class="btn btn-primary btn-lg" role="button">Send</a></p>
 
<script type="text/javascript">
	
	$("#sendMessage").click(function () {
		
		jQuery.ajax({
				type:'POST',
				url: '<?php echo Router::Url(array('controller' => 'messages', 'action' => 'add', '6' ), TRUE); ?>',
				success: function(response) {
					// do something here
				},
			data:jQuery('#mpost').serialize()
			});
	 });
	 
	var fReload=function(){
		var thread_id= "<?php echo $thread_id;?>"
;

		$.ajax({
            type:'POST',
            url: '<?php echo Router::Url(array('controller' => 'messages', 'action' => 'index',$thread_id), TRUE); ?>',
            success: function(response) {
				
                jQuery('#chatboxContainer').html(response);
				setTimeout(fReload,1000);
            }
        });
	};
	fReload();
</script>
