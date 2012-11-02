<?php

class User extends CI_Model {
    public function loginUser($id, $name, $email) {
        $users = $this->db->get_where('users', array('email' => $email, 'name' => $name), 6000, 0)->result();
        if(count($users) == 0) {
            $this->db->insert('users', array('id' => $id, 'name'=> $name, 'email' => $email));
            $users = $this->db->get_where('users', array('email' => $email, 'name' => $name), 6000, 0)->result();    
        }
    }   
    
}

?>
