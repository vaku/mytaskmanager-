<div class="users index">
	<h2><?php __('Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
      <th class="actions"><?php __('Actions');?></th>
        </tr>
             </table>
        <h2> User Lists</h2>
        <table>
            <tr>
            <th>User ID</th>
            <th>User Name </th>
            <th>Password</th>
            <th>Role</th>
            
            </tr>
            
                <?php foreach($users as $user): ?>
            
		<td><?php echo $user['User']['id']; ?> </td>
		<td><?php echo $user['User']['username']; ?> </td>
		<td><?php echo $user['User']['password']; ?> </td>
		<td><?php echo $user['User']['role']; ?> </td>
                
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	hello	</p>

	
</div>
<?php echo $this->element("admin_menu"); ?> 