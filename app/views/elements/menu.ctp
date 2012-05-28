<?php ?>

<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>

        <li>
            <?php
            echo $this->Html->link(__('Home', true), array('controller' => 'tasks', 'action' => 'index'));
            ?>  
        </li>


        <li><?php echo $this->Html->link(__('New Task', true), array('action' => 'add_my_task')); ?></li>




    </ul>
</div>
