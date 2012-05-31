<script>

 function validate_form(){               // to validate form fields via jquery
        $("#validation_error").html("").hide();  //hide if anything  displayed
        var username = $("#username").val(); // saving value into variable for further check.
        var passwd = $("#passwd").val();

        
        if(username == "" || passwd == ""){
            $("#validation_error").html("Fields marked * are mandatory").show();
             $('html, body').animate({scrollTop:0}, 'slow');
            return false;
        }else{
            return true;
        }
        
    }



</script>




<div class="users form">
     <div id="validation_error" style="display:none;background-color:#fff"></div>
<?php echo $this->Form->create('User',array("controller"=>"users","action"=>"add","onsubmit"=>"return validate_form()"));?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username', array('id'=>'username'));
		echo $this->Form->input('password', array('id'=> 'passwd'));
		echo $this->Form->input('role');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

 <?php echo $this->element("admin_menu"); ?>