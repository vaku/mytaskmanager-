<div class="dprs index">
	<h2><?php __('Dprs List');?></h2>
	 <div id="admintitle" >   <h2> All Dprs</h2> </div>
    <table>
        <tr>

            <th>DPR</th>
            <th> Created On </th>
  

        </tr>
        
	<?php

	foreach ($dprs as $dpr):
		
	?>
	
	<?php $date = date('jS M', $dpr['Dpr']['created_on']); ?>	

		<td><?php echo $dpr['Dpr']['dpr']; ?>&nbsp;</td>
		<td><?php echo $html->link($date, array('action' => 'view', $dpr['Dpr']['id'])); ?>&nbsp;</td>
	
		
                <td class="actions">
          
			
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $dpr['Dpr']['id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
	 <li>
            <?php
            echo $this->Html->link(__('Home', true), array('controller' => 'tasks', 'action' => 'index'));
            ?>  
        </li>	
            
            <li><?php echo $this->Html->link(__('Todays Dpr', true), array('action' => 'add')); ?></li>
		
	</ul>
</div>

