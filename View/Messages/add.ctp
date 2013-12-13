<h1>Add Message</h1>
<?php
echo $this->Form->create('Message');
echo $this->Form->input('Message');
echo $this->Form->end('Save Message');
?>