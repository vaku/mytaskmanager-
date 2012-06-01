<?php

class Taskassign extends AppModel {

    var $name = 'Taskassign';
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

    function getTaskAssignedTo($task_id) {
        $conditions = array("Taskassign.task_id" => $task_id);
        $recursive = 0;
        $fields = array("Taskassign.id", "User.id", "User.name");

        return $this->find("all", array("conditions" => $conditions, "fields" => $fields, "recursive" => $recursive));
    }

    //getting users task via taskassign where task_assign_to_user (user_id)
    function getUserTasks($user_id) {
        $conditions = array("Taskassign.user_id" => $user_id);
        $recursive = 0;
        $fields = array("Taskassign.id", "Task.id", "Task.sub","Task.created_on","Task.due_date",'Task.status' );

        return $this->find("all", array("conditions" => $conditions, "fields" => $fields, "recursive" => $recursive));
    }

}
