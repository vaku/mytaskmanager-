<?php

?>

<?php ?>
<?php ?>
<script>
    $(document).ready(function() {
        $("#created_on").datepicker();
        $("#due_date").datepicker();
        /* $( "input.datepicker" ).datepicker({
      dateFormat: 'dd.mm.yy', 
      altFormat: 'yy-mm-dd'
   });*/ 
    });

    function validate_form(){               // to validate form fields via jquery
        $("#validation_error").html("").hide();  //hide if anything  displayed
        var created_on = $("#created_on").val(); // saving value into variable for further check.
        var due_date = $("#due_date").val();
        var sub  = $("#sub").val();
        
        if(created_on == "" || due_date == "" || sub == ""){
            $("#validation_error").html("Fields marked * are mandatory").show();
            return false;
        }else{
            return true;
        }
        
    }
</script>

<div class="tasks form">
    <div id="validation_error" style="display:none;background-color:#fff"></div>
    <?php echo $this->Form->create('Task', array("controller" => "tasks", "action" => "add_my_task", "onsubmit" => "return validate_form()")); ?>
    <fieldset>
        <legend><?php __('Add Task'); ?></legend>
        <?php
        
        echo $this->Form->input('sub', array(
             'id' => 'sub'
         ));
        echo $this->Form->input('content');
        echo $this->Form->input('created_on', array(
            'class' => 'datepicker',
            'type' => 'text', 'id' => 'created_on',
            'readonly'=>'readonly'
                )
        );
        echo $this->Form->input('due_date', array(
            'class' => 'datepicker',
            'type' => 'text', 'id' => 'due_date',
            'readonly'=>'readonly'
                )
        );

        ?>
    </fieldset>
        <?php echo $this->Form->end(__('Submit', true)); ?>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Tasks', true), array('action' => 'index')); ?></li>
      


    </ul>
</div>

