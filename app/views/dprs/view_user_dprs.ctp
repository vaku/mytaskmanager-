<?php
?>

<div class="dprs index">
	<h2><?php __('Dpr');?></h2>
	 <div id="admintitle" >   <h2> All Dprs</h2> </div>
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
          
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
</div>
 <?php echo $this->element("admin_menu"); ?>