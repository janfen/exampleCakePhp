
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

    <?php foreach ($messages as $message): 
	
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