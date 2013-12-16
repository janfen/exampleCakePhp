
<p><?php echo 'Xin chao:'.$userName; ?> <?php echo $this->Html->link('Logout', array('controller'=>'users','action' => 'logout')); ?> <h1>List Threads</h1></p>
<p><?php echo $this->Html->link('Add Thread', array('action' => 'add')); ?></p>
<table class="table table-hover">
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
                    array('controller' => 'messages' , 'action' => 'index',$thread['Thread']['id'])
                );
            ?>
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
				if($userID==$thread['Thread']['user_id']){
					echo $this->Form->postLink(
						'Delete',
						array('action' => 'delete', $thread['Thread']['id']),
						array('confirm' => 'Are you sure?')
					);
				}
				else{
					echo "Can't Delete";
				}
            ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>