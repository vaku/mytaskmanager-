<?php ?>
<div class="actions">
    <h3>Admin Actions</h3>
    <ul>
        <li><?php echo $this->Html->link(__('Home', true), array('controller' => 'users', 'action' => 'adminpage')); ?></li> 
        <li><?php echo $this->Html->link(__('New Task', true), array('controller' => 'tasks', 'action' => 'add')); ?></li> 
        <li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
         <li><?php echo $this->Html->link(__('View Dprs', true), array('controller' => 'dprs', 'action' => 'admindpr')); ?> </li>
    </ul>

</div>
