<div class="tasks form">
<?php echo $this->Form->create('Task');?>
	<fieldset>
		<legend><?php __('Edit Task'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('sub');
		echo $this->Form->input('content');
		echo $this->Form->input('created_on');
		echo $this->Form->input('due_date');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<?php

echo $this->element($menu_to_show); 
?>