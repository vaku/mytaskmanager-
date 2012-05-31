<?php

?>


<div class="users index">

	<table cellpadding="0" cellspacing="0">
	     </table>
        <h2> Click on users to view Dprs </h2>
        <table>
            <tr>

            <th>Users </th>
       
            <th>Role</th>
            
            </tr>
            
                <?php foreach($users as $user): ?>
            
		
		<td><?php echo $html->link($user['User']['username'],array('controller'=> 'dprs', 'action'=>'view_user_dprs', $user['User']['id'])); ?> </td>
		
		<td><?php echo $user['User']['role']; ?> </td>
                
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	hello	</p>

	
</div>
 <?php echo $this->element("admin_menu"); ?>