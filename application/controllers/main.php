<?php

 require('./PHPMailer_5.2.1/class.phpmailer.php');

class Main extends CI_Controller {
    public function index() {

        $this->load->view('questions/header.php', array('page' => 'main'));
        $this->load->view('questions/main.php');
        $this->load->view('questions/footer.php', array('display'=> false));
    }

    public function questions() { // should be main/questions eventually
    
        // loads all questions no matter what time it is
        $DEBUG = false;
        
        // number of questions to be emailed
        $COUNTER = 10;
        
        $this->load->model('Event');
        $this->load->model('Question');
        $id = $this->uri->segment(3);
        $questions = $this->Event->getQuestions($id);
        $users = array();
        foreach($questions as $question) {
            $user = $this->Question->getUser($question->id);
            array_push($users, $user);
        }
        $creators = $this->Event->getUser($id);
        foreach($creators as $c) {
            $creator = $c;
        }
        $eventTitle = $this->Event->getEventTitle($id);
        $this->load->view('questions/header.php', array('page' => 'questions'));
        $info = $this->Event->getInfo($id);
        foreach($info as $event) {
            $start_time = $event->start_time;
            $end_time = $event->end_time;
        }
        $now = date("Y-m-d H:i:s");
        if($now < $start_time) {
            $this->load->view('questions/early.php', array('eventTitle' => $eventTitle, 'startTime' => $start_time));
            $this->load->view('questions/footer.php', array('display' => false, 'page' => 'questions', 'id' => $id));
        }
        else if($DEBUG || $now > $start_time && $now < $end_time) {
            $this->load->view('questions/questions.php', array('eventTitle' => $eventTitle, 'questions' => $questions, 'startTime' => $start_time, 'endTime' => $end_time));
            $this->load->view('questions/footer.php', array('display' => true, 'page' => 'questions', 'id' => $id));
        }
        else {
            if($this->Event->email($id) != 1) {
                
                // Instantiate your new class
                $message = 'Thank you for using GoodQuestion for managing Q&A at '.$eventTitle.', here are the people who asked the highest-voted questions:' . "\n";
                if($COUNTER > sizeof($users)) {
                    $COUNTER = sizeof($users);
                }
                for($i = 0; $i < $COUNTER; $i++) {
                    $message .= $users[$i][0]->name;
                    $message .= ': ' . $questions[$i]->text;
                    if($i != $COUNTER - 1) {
                        $message .= "\n";
                    }
                }
                $mail = new PHPmailer;
                //$mail->IsSendmail();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->Username = 'goodquestion164@gmail.com';
                $mail->Password = 'goodquestion';
                $mail->From = 'goodquestion164@gmail.com';
                $mail->FromName = 'GoodQuestion';
                $mail->AddAddress($creator->email);
                foreach($users as $user) {
                    $mail->AddAddress($user[0]->email);
                }
                
                $mail->Subject = $eventTitle;
                $mail->Body = $message;
                $mail->Send(); // send message
                /*
                // send email to event creator and all participants.  Note that this will not work on the Harvard network due to restrictions on use of the mail() function.  We attempted to use PHPmailer to solve this, however without an SMTP server this also failed to yield any results.
                $this->load->library('email');
                $this->email->from('mlutsky@college.harvard.edu', 'GoodQuestion');
                $this->email->to($creator->email); 
                $this->email->subject($eventTitle);
                $message = 'Thank you for using GoodQuestion for managing Q&A at '.$eventTitle.', here are the people who asked the highest-voted questions:';
                if($COUNTER > sizeof($users)) {
                    $COUNTER = sizeof($users);
                }
                for($i = 0; $i < $COUNTER; $i++) {
                    $message .= $users[$i][0]->name;
                    if($i != $COUNTER - 1) {
                        $message .= ', ';
                    }   
                }
                // var_dump($message);        
                $this->email->message($message);	
                $this->email->send();
                // $this->email->print_debugger();
                
                foreach($users as $user) {
                    $this->email->clear();
                    $this->email->from('mlutsky@college.harvard.edu', 'GoodQuestion');
                    $this->email->to($user[0]->email);
                    $this->email->subject($eventTitle);
                    $this->email->message($message);	
                    $this->email->send();
                    // $this->email->print_debugger();
                } 
                */ 
            }
            $this->load->view('questions/late.php', array('eventTitle' => $eventTitle, 'users' => $users, 'questions' => $questions));
            $this->load->view('questions/footer.php', array('display' => false, 'page' => 'questions', 'id' => $id));
        }
    }
    
    public function newQuestion() {
        $id = $this->uri->segment(3);
        $this->load->view('questions/header.php', array('page' => 'newQuestion'));
        $this->load->view('questions/newQuestion.php', array('id' => $id));
        $this->load->view('questions/footer.php', array('display' => false));
    }

    public function createQuestion() {
        if ($this->_isAjax()) {
            $this->load->model('Question');
            $questionText = $this->input->post('text');
            $event_id = $this->input->post('eventId');
            $user_id = $this->input->post('userId');
            $this->Question->createQuestion($questionText, $user_id, $event_id);
        }
    }
    
    public function createUser() {
        if ($this->_isAjax()) {
            $this->load->model('User');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $id = $this->input->post('id');
            $this->User->loginUser($id, $name, $email);
        }
    }
    
    public function upVote() {
        $id = $this->input->post('id');
        $this->load->model('Question');
        $this->Question->vote($id, 1);
    }
    
    public function downVote () {
        $id = $this->input->post('id');
        $this->load->model('Question');
        $this->Question->vote($id, -1);
    }

    function _isAjax() 
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }
    
    public function questionsJson () { // will be used to constantly refresh the questions as they are added and voted up or down
        if ($this->_isAjax()) {
            $id = $this->input->post('id');
            //$id = $this->uri->segment(3);
            $this->load->model('Event');
            $questions = $this->Event->checkQuestions($id);
            echo json_encode($questions);
        }
    }
    
    public function searchEvents () {
        $code = $this->input->get('code');
        $this->load->model('Event');
        $events = $this->Event->findEvent($code);
        $this->load->view('questions/header.php', array('page' => 'searchEvents'));
        $this->load->view('questions/eventsearch.php', array('events' => $events));
        $this->load->view('questions/footer.php', array('display' => false));
    }
    
    public function newEvent() {
        $this->load->view('questions/header.php', array('page' => 'newEvent'));
        $this->load->view('questions/newEvent.php', array());
        $this->load->view('questions/footer.php', array('display' => false));
    }

    public function createEvent () {
        if ($this->_isAjax()) {
            $this->load->model('Event');
            $title = $this->input->post('title');
            $code = $this->input->post('code');
            $startTime = $this->input->post('startTime');
            $endTime = $this->input->post('endTime');
            $id = $this->input->post('creatorId');
            $this->Event->createEvent($title, $code, $startTime, $endTime, $id);
            echo $this->db->insert_id();
        }
    }
}
        

?>
