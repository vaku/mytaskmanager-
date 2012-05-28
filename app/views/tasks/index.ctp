<script>

function update_status(task_id,new_status){
        $("#"+task_id+"_mark_complete").hide();
        $("#"+task_id+"_mark_incomplete").hide();
        $("#"+task_id+"_updating_status").show();
        
        var url_to_call = "<?php echo $html->url(array("controller" => "tasks", "action" => "ajax_update_status")); ?>"+"/"+task_id+"/"+new_status;
        
        $.ajax({
            type:"POST",
            url: url_to_call,
            success : function(msg){
                if(new_status == 1){
                    $("#"+task_id+"_updating_status").hide();
                    $("#"+task_id+"_mark_incomplete").show();
                }else{
                    $("#"+task_id+"_updating_status").hide();
                    $("#"+task_id+"_mark_complete").show();
                }                                
            }
        })
    }



</script>



<div class="tasks index">
    <h2>Tasks</h2>
    <table cellpadding="0" cellspacing="0">
        <tr>

            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
    </table>
    <div id="admintitle" >   <h2> All tasks</h2> </div>
    <table>
        <tr>

            <th>Subject</th>
            <th>Task</th>
            <th> Created On </th>
            <th> Due date </th>

        </tr>
        <?php foreach ($tasks as $task) { ?>


            <td> <?php echo $html->link($task ['Task']['sub'], array('action' => 'view', $task ['Task']['id'])); ?> </td>
            <td> <?php echo $task ['Task']['content']; ?> </td>
            <td> <?php echo date('jS M', $task ['Task']['created_on']); ?> </td>
            <td> <?php echo date('jS M', $task ['Task']['due_date']); ?> </td>

            <td class="actions">

            <td>    <?php if ($task['Task']['status'] == 0) { ?>

                    <a href="javascript:void(0)" onclick="update_status(<?php echo $task["Task"]["id"]; ?>,1)" id="<?php echo $task["Task"]["id"]; ?>_mark_complete">
                        Mark as complete
                    </a>
                    <a style="display: none" href="javascript:void(0)" onclick="update_status(<?php echo $task["Task"]["id"]; ?>,0)" id="<?php echo $task["Task"]["id"]; ?>_mark_incomplete">
                        Mark as pending
                    </a>

                    <?php
                } else {
                    ?>
                    <a style="display: none" href="javascript:void(0)" onclick="update_status(<?php echo $task["Task"]["id"]; ?>,1)" id="<?php echo $task["Task"]["id"]; ?>_mark_complete">
                        Mark as complete
                    </a>
                    <a  href="javascript:void(0)" onclick="update_status(<?php echo $task["Task"]["id"]; ?>,0)" id="<?php echo $task["Task"]["id"]; ?>_mark_incomplete">
                        Mark as pending
                    </a>
                    <?php
                }
                ?>    <span id="<?php echo $task["Task"]["id"]; ?>_updating_status" style="display: none">Updating Status</span>


            </td>

            <?php
            if ($show_admin_links) {
                echo $this->Html->link(__('Edit', true), array('action' => 'edit', $task['Task']['id']));
            }
            ?>


            <?php
            if ($show_admin_links) {
                echo $this->Html->link(__('Delete', true), array('action' => 'delete', $task['Task']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $task['Task']['id']));
            }
            ?>

            </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

<?php echo $this->element("menu"); ?>