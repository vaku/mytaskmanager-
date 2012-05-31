<?php

class User extends AppModel {

    var $name = 'User';
    var $displayField = 'username';
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Taskassign' => array(
            'className' => 'Taskassign',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Task' => array(
            'className' => 'Task',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    
    var $validate = array(
        'username' => array(
            'empty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Please enter a username'
            ),
            'length' => array(
                'rule' => array('minLength', 4),
                'required' => true,
                'allowEmpty' => true,
                'message' => 'Usernames must be at lest 4 characters long'
            ),
            'alphanum' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'allowEmpty' => true,
                'message' => 'Only letters and numbers are allowed in usernames'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => true,
                'allowEmpty' => true,
                'message' => 'That username is already in use by another user'
            )
        ),
       'password' => array(
            'empty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'allowEmpty' => false,
                'on' => 'create',
                'message' => 'Please enter a password'
            ),
            'length' => array(
                'rule' => array('minLength', 6),
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Passwords must be at lease 6 characters long'
            )
        )
    );

    
    function hashPasswords($data) {

        if (isset($this->data['User']['password'])) {

            $this->data['User']['password'] = Security::hash($this->data['User']['password'], NULL, TRUE);

            return $data;
        }

        return $data;
    }

    //fetching role from the database
    function getRole($id) {
        $conditions = array('User.id' => $id);
        return $this->field('role', $conditions);
    }
    
    // fetching only normaluser from database. 
    
    function getNormalUser($whether_list = false){
        $conditions = array("User.role"=>'normaluser','User.status'=>1);
        $recursive = -1;
        
        if($whether_list){
            return $this->find("list",array("conditions"=>$conditions,"recursive"=>$recursive));
        }else{
            return $this->find("all",array("conditions"=>$conditions,"recursive"=>$recursive));
        }
    }
    
    function getUsers($whether_list = false){
        $conditions = array('User.status'=>1);
        $recursive = -1;
        
        if($whether_list){
            return $this->find("list",array("conditions"=>$conditions,"recursive"=>$recursive));
        }else{
            return $this->find("all",array("conditions"=>$conditions,"recursive"=>$recursive));
        }
    }

}
