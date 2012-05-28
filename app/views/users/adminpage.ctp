<?php ?>
<?php ?>
<div class="tasks index">

    <h2>Admin Dashboard</h2> 
    <table cellpadding="0" cellspacing="0">
        <tr>


        </tr>
    </table>
    <div id="admintitle" >    <h2> All Tasks</h2>   </div>
    <table>
        <tr>

            <th>Subject</th>
            <th>Assigned To</th>
            <th>Created On</th>
            <th>Due date</th>

        </tr>

        <?php foreach ($tasks as $task): ?>


            
            <td> <?php echo $html->link($task['Task']['sub'],array("controller"=>"tasks","action"=>"view",$task["Task"]["id"])); ?> </td>
            <td></td>
            <td> <?php echo date('jS M', $task ['Task']['created_on']); ?> </td>
            <td> <?php echo date('jS M', $task ['Task']['due_date']); ?> </td>


            <td class="actions">
                
                <?php echo $this->Html->link(__('Edit', true), array('controller' => 'tasks', 'action' => 'edit', $task['Task']['id'])); ?>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'tasks', 'action' => 'delete', $task['Task']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $task['Task']['id'])); ?>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
<?php
echo $this->element("admin_menu"); ?>


