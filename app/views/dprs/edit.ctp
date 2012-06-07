

<div class="dprs form">
<?php echo $this->Form->create('Dpr');?>
	<fieldset>
		<legend><?php echo 'Edit Dpr for :'. date('jS M',$this->data['Dpr']['created_on']); ?></legend>
	<?php
            echo $this->Form->input('created_on');
            echo $this->Form->input('dpr');
            echo $this->Form->input('id')
            
                 
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		
		<li><?php echo $this->Html->link(__('List Dprs', true), array('action' => 'index'));?></li>
		
	</ul>
</div>