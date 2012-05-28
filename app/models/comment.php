<?php
class Comment extends AppModel {
	var $name = 'Comment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'task_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

        
        function getBytask($id){
            $recursive = 0;   // -1 bydefault fetch only given data from another table and if 0 it joins fields data from belonging table.
            $conditions  = array ('task_id' => $id); // where condition -- where task_id in comment table refer to current task id passed in task table 
            $order = "Comment.content DESC";
            return $this->find('all',array ("conditions"=>$conditions,"recursive"=>$recursive, 'order'=>$order)); //find all comments belong to current task id passed 
        }
        
}