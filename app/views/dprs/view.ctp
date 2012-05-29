
<div class="tasks view">
    <h2 style ="color: #fffff">Task detail</h2> 

    <table>

        <tr>
            <td><h3 style="color:black;"> <?php echo $dpr['Dpr']['task'] ?> </h3></td>
        </tr>

    </table>
</div>
        
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dpr', true), array('action' => 'edit', $dpr['Dpr']['id'])); ?> </li>
		
		<li><?php echo $this->Html->link(__('List Dprs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dpr', true), array('action' => 'add')); ?> </li>
		
	</ul>
</div>
