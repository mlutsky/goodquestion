<?php

class Question extends CI_Model {
    public function getInfo($id) {
        $info = $this->db->get_where('questions', array('id' => $id), 6000, 0)->result();
        return $info;
    }
    
    public function createQuestion($text, $userid, $eventid) {
        $this->db->insert('questions', array('text' => $text, 'user_id' => $userid, 'event_id' => $eventid));
    }
    
    public function vote($id, $voteValue) {
        $questions = $this->db->get_where('questions', array('id' => $id), 6000, 0)->result();
        // var_dump($questions[0]->votes);
        foreach( $questions as $question ) {
            $question->votes += $voteValue;
        }
        $this->db->update_batch('questions', $questions, 'id');
    }
    
    public function getUser($id) {
        return $this->db->select('*')->from('questions')->where('questions.id', $id)->join('users','users.id  = questions.user_id')->get()->result();
    }
 
}

?>
