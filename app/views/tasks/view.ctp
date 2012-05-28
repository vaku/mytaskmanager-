<script>
    function update_status(task_id,new_status){
        $("#mark_complete").hide();
        $("#mark_incomplete").hide();
        $("#updating_status").show();
        
        var url_to_call = "<?php echo $html->url(array("controller" => "tasks", "action" => "ajax_update_status")); ?>"+"/"+task_id+"/"+new_status;
        
        $.ajax({
            type:"POST",
            url: url_to_call,
            success : function(msg){
                if(new_status == 1){
                    $("#updating_status").hide();
                    $("#mark_incomplete").show();
                }else{
                    $("#updating_status").hide();
                    $("#mark_complete").show();
                }
                                
            }
        })
    }
</script>
<div class="tasks view">
    <h2 style ="color: #fffff">Task detail</h2> 

    <table>

        <tr>
            <td><h3 style="color:black;"> <?php echo $task['Task']['sub'] ?> </h3></td>
        </tr>


        <tr>
            <td><h5 style="color: black;">  <?php echo $task['Task']['content']; ?></h5> </td>
        </tr>


        <tr> <td> <h3 style="color:black;">Task status</h3></td> </tr>
        <tr>
            <td>    <?php
if ($task['Task']['status'] == 0) {
   ?>
        <a href="javascript:void(0)" onclick="update_status(<?php echo $task["Task"]["id"]; ?>,1)" id="mark_complete">
            Mark as complete
        </a>
        <a style="display: none" href="javascript:void(0)" onclick="update_status(<?php echo $task["Task"]["id"]; ?>,0)" id="mark_incomplete">
            Mark as pending
        </a>
    <?php
    } else {
        ?>
        <a style="display: none" href="javascript:void(0)" onclick="update_status(<?php echo $task["Task"]["id"]; ?>,1)" id="mark_complete">
            Mark as complete
        </a>
        <a  href="javascript:void(0)" onclick="update_status(<?php echo $task["Task"]["id"]; ?>,0)" id="mark_incomplete">
            Mark as pending
        </a>
        <?php
    }
    ?>  

                <span id="updating_status" style="display: none">Updating Status</span>
            </td>                



        </tr>

        <tr> <td> <h3 style="color:black;"> Comment </h3>
            </td>
        </tr>
        <tr> 
            <td>     <?php
                foreach ($comments as $comment):

                    echo $comment['Comment']['content'];
                    echo '<br />';

                    echo 'Comment by-';
                    echo $comment ['User']['username'];

                    echo '<br />';

                endforeach;
                ?>   </td> 

        </tr>

        <tr>
            <td colspan="2"> 
                <?php echo $this->Form->create('Comment', array('controller' => 'comments', 'action' => 'add'));  //form create to comment on tasks   ?>
                <fieldset>
                    <?php echo $this->Form->input('content'); ?>
                    <?php echo $this->Form->hidden('task_id', array('value' => $task['Task']['id'])); // passing id as hidden form  value   ?>      
                    <?php echo $this->Form->hidden('user_id', array('value' => $task['User']['id'])); ?>
                    <?php echo $this->Form->end(__('Submit', true)); ?>



                </fieldset>
            </td>
        </tr>

    </table>
</div>
<?php

echo $this->element($menu_to_show); 
?>



