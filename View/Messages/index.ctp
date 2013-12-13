
<p><?php echo 'Xin chao:'.$userID; ?> <?php echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout')); ?> <h1>List Message</h1></p>
<p><?php echo $this->Html->link('Add Message', array('action' => 'add', $thread_id)); ?></p>
<table>
    <tr>
        <th>Id</th>, 
        <th>Msg</th>
        <th>User created</th>
        <th>Created</th>
        <th>Modified</th>
		<th>Action</>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($messages as $message): ?>
    <tr>
        <td><?php echo $message['Message']['id']; ?></td>
        <td>
			<?php
                echo $message['Message']['message'];
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
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $message['Message']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>