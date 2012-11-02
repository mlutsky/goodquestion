<?php

class Event extends CI_Model {
    public function createEvent($title, $code, $startTime, $endTime, $id) {
        $this->db->insert('events', array('title' => $title, 'code' => $code, 'start_time' => $startTime, 'end_time' => $endTime, 'creator_id' => $id));
    }
    
    public function findEvent($code) {
        return $this->db->select('*')->from('events')->where('code', $code)->get()->result();
    }
    
    public function getInfo($id) {
        return $this->db->select('*')->from('events')->where('id', $id)->get()->result();
    }
    
    public function getEventTitle($id) {
        $events = $this->db->get_where('events', array('id' => $id), 6000, 0)->result();
        foreach($events as $event) {
            return $event->title;
        }
    }
    
    public function getQuestions($id) {
        return $this->db->select('*')->from('events')->where('events.id', $id)->join('questions','questions.event_id = events.id')->order_by('votes', 'desc')->get()->result();
    }

    public function checkQuestions($id) {
        return $this->db->select('questions.id, votes')->from('events')->where('events.id', $id)->join('questions','questions.event_id = events.id')->order_by('votes', 'desc')->get()->result();
    }    
    
    public function email($id) {
        $events = $this->db->get_where('events', array('id' => $id), 6000, 0)->result();
        foreach($events as $event) {
            if($event->email_sent != 1) {
                $this->db->where('id', $id)->update('events', array('email_sent' => 1));
                return 0;
            }
            else {
                return $this->email_sent;
            }
        }
        
    }
    
    
    public function getUser($id) {
        return $this->db->select('*')->from('events')->where('events.id', $id)->join('users','users.id  = events.creator_id')->get()->result();
    }
    
}

?>
