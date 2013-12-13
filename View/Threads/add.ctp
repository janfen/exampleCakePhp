<h1>Add Thread</h1>
<?php
echo $this->Form->create('Thread');
echo $this->Form->input('name');
echo $this->Form->end('Save Thread');
?>