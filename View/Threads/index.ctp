
<p><?php echo 'Xin chao:'.$userID; ?> <?php echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout')); ?> <h1>List Threads</h1></p>
<p><?php echo $this->Html->link('Add Thread', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>User created</th>
        <th>Created</th>
        <th>Modified</th>
		<th>Action</>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($threads as $thread): ?>
    <tr>
        <td><?php echo $thread['Thread']['id']; ?></td>
        <td>
			<?php
                echo $this->Html->link(
                    $thread['Thread']['name'],
                    array('controller' => 'messages' , 'action' => 'index',$thread['Thread']['id'],)
                );
            ?>
			<?php echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout')); ?>
        </td>
        
		<td>
            <?php echo $thread['UserJoin']['username']; ?>
        </td>
		
        <td>
            <?php echo $thread['Thread']['created']; ?>
        </td>
		
		<td>
            <?php echo $thread['Thread']['modified']; ?>
        </td>
		
		<td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $thread['Thread']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>