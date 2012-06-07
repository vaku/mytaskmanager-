<?php  ?>
<script>

    $(document).ready(function() {
        $("#created_on").datepicker();
        
        /* $( "input.datepicker" ).datepicker({
      dateFormat: 'dd.mm.yy', 
      altFormat: 'yy-mm-dd'
   });*/ 
    });
    
     function validate_form(){               // to validate form fields via jquery
        $("#validation_error").html("").hide();  //hide if anything  displayed
        var created_on = $("#created_on").val(); // saving value into variable for further check.
        var dpr = $("mydpr").val(); 
    
        
        if(created_on == ""|| dpr == ""){
            $("#validation_error").html("Fields marked * are mandatory").show();
             $('html, body').animate({scrollTop:0}, 'slow');
            return false;
        }else{
            return true;
        }
        
    }
    
</script>


<div class="dprs form">
    <?php echo $this->Form->create('Dpr'); ?>
    <fieldset>
        <legend><?php __('Add Dpr'); ?></legend>
        <?php
    
        echo $this->Form->input('dpr', array('id'=> 'dpr', 'style'=>'width:500px;'));
        echo $this->Form->input('created_on', array('class' => 'datepicker',
            'type' => 'text', 'id' => 'created_on',
            'readonly' => 'readonly')
        );

       
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>

         <li>
            <?php
            echo $this->Html->link(__('Home', true), array('controller' => 'tasks', 'action' => 'index'));
            ?>  
        </li>
        
        <li><?php echo $this->Html->link(__('List Dprs', true), array('action' => 'index')); ?></li>
       

    </ul>
</div>