<div class="dprs index">
	<h2><?php __('Dpr');?></h2>
	 <div id="admintitle" >   <h2> All tasks</h2> </div>
    <table>
        <tr>

            <th>Task</th>
            <th> Created On </th>
  

        </tr>
        
	<?php

	foreach ($dprs as $dpr):
		
	?>
	
		

		<td><?php echo $dpr['Dpr']['task']; ?>&nbsp;</td>
		<td><?php echo date('jS M', $dpr['Dpr']['created_on']); ?>&nbsp;</td>
	
		
                <td class="actions">
          
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $dpr['Dpr']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $dpr['Dpr']['id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Todays Dpr', true), array('action' => 'add')); ?></li>
		 <li>
            <?php
            echo $this->Html->link(__('Home', true), array('controller' => 'tasks', 'action' => 'index'));
            ?>  
        </li>
	</ul>
</div>

