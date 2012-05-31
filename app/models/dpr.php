<?php

class Dpr extends AppModel {

    var $name = 'Dpr';
    var $displayField = 'task';
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    // this returns Dpr's for particualr user.
    function getUserDprs($user_id) {

        $recursive = -1;
        $conditions = array('Dpr.user_id' => $user_id);   // where user_id in dpr table is = to current logged in user (id we have passed)
        return $this->find('all', array('conditions' => $conditions, "recursive" => $recursive)); //fetching tasks from tasks table with where clause 
    }

// this function checks whther an entry exists for the user for the given date. 
// if not exists then return 0 else return its recored id.
    function checkRecordExists($user_id, $created_on) {   

        $conditions = array('Dpr.user_id' => $user_id, 'Dpr.created_on' => $created_on);
        $rec_id = $this->field('id', $conditions);

        if (!$rec_id) {
            return 0;
        } else {
            return $rec_id;
        }
    }

  // fetching users - so that admin can list all dpr for particualr user.
    
 function getUserdpr($user_id){
     
     $recursive = -1;
     $conditions = array('Dpr.user_id' => $user_id);  
     $order = array('Dpr.user_id Asc');
     return $this->find('all', array('conditions' => $conditions, "recursive" => $recursive, 'order'=> $order));
 }
  
    
}
