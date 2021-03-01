<?php

class Meeting
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

   
    public function __construct()
    {
        if (isset($_POST["add_meeting"])) {
            $this->addMeeting();
        }

        if (isset($_POST["add_meeting_continue"])) {
            $this->addMeetingContinue();
        }

        else if (isset($_POST["edit_meeting"])) {
            $this->editMeeting();
        }

        else if (isset($_POST["delete_meeting"])) {
            $this->deleteMeeting();
        }

        else if (isset($_POST["complete_meeting"])) {
            $this->completeMeeting();
        }
    }

   
    private function addMeeting()
    {
        if (empty($_POST['meeting_name'])) 
        {
            $this->errors[] = "Empty Meeting Name, this field cannot be empty";
        }
       
        elseif (empty($_POST['meeting_user_id'])) 
        {
            $this->errors[] = "Meeting must have an organizer, please select one to continue.";
        }
        elseif (empty($_POST['meeting_department'])) 
        {
            $this->errors[] = "Meeting must have a responsible department, please select one to continue.";
        }

        elseif (empty($_POST['meeting_date'])) 
        {
            $this->errors[] = "Meeting must have a  date, please select one to continue.";
        }

        elseif (empty($_POST['responsible'])) 
        {
            $this->errors[] = "Meeting  must have at least one attendee, please select at least one to continue.";
        }

    
        
        elseif (
            !empty($_POST['meeting_name'])
            && !empty($_POST['meeting_user_id'])
            && !empty($_POST['meeting_date'])
            && !empty($_POST['responsible'])
            && !empty($_POST['meeting_department'])
        ) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $meeting_name         = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_name'], ENT_QUOTES));
                $meeting_user_id      = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_user_id'], ENT_QUOTES));
                $meeting_date         = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_date'], ENT_QUOTES));
                $meeting_department   = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_department'], ENT_QUOTES));
                $meeting_description  = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_description'], ENT_QUOTES));
             
                $meeting_date =  strtotime($meeting_date);
                $meeting_date = date('Y-m-d', $meeting_date);



                $sql = "SELECT * FROM meetings WHERE meeting_name = '" . $meeting_name . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, that meeting is already registered, choose a different name.";
                }
                /*
                elseif($meeting_date < date("Y-m-d"))
                {
                    $this->errors[] = "Dates dont make sense, please chek that your meeting date is correct.";
                } 
                */
                else 
                {
                    $sql = "INSERT INTO meetings (meeting_name, meeting_description, meeting_department_id, meeting_date, meeting_user_id)
                            VALUES('" . $meeting_name . "', '" . $meeting_description . "', '" . $meeting_department . "', '" . $meeting_date . "', '" . $meeting_user_id . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) 
                    {
                        $last_project = $this->db_connection->insert_id;
                        
                        foreach ($_POST['responsible'] as $phase)
                        {
                            //echo $phase;

                            //check if not i=empty
                            if($phase != "")
                            {
                                $iphase = $this->db_connection->real_escape_string(strip_tags($phase, ENT_QUOTES));
                                $sql = "INSERT INTO meeting_attendees (m_a_meeting_id, meeting_user_id) VALUES ($last_project, '".$iphase."')";
                                $query_new_user_insert = $this->db_connection->query($sql);
                            }
                        }

                        $this->messages[] = "Meeting saved successfuly.";
                    } 
                    else 
                    {
                        $this->errors[] = "Sorry, registration failed. Please go back and try again.";
                    }
                }
            } 
            else 
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        } 
        else 
        {
            $this->errors[] = "A validation error occurred.";
        }
    }



    private function addMeetingContinue()
    {
        if (empty($_POST['meeting_name'])) 
        {
            $this->errors[] = "Empty Meeting Name, this field cannot be empty";
        }
       
        elseif (empty($_POST['meeting_user_id'])) 
        {
            $this->errors[] = "Meeting must have an organizer, please select one to continue.";
        }
        elseif (empty($_POST['meeting_department'])) 
        {
            $this->errors[] = "Meeting must have a responsible department, please select one to continue.";
        }

        elseif (empty($_POST['meeting_date'])) 
        {
            $this->errors[] = "Meeting must have a  date, please select one to continue.";
        }

        elseif (empty($_POST['responsible'])) 
        {
            $this->errors[] = "Meeting  must have at least one attendee, please select at least one to continue.";
        }

    
        
        elseif (
            !empty($_POST['meeting_name'])
            && !empty($_POST['meeting_user_id'])
            && !empty($_POST['meeting_date'])
            && !empty($_POST['responsible'])
            && !empty($_POST['meeting_department'])
        ) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $meeting_name         = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_name'], ENT_QUOTES));
                $meeting_user_id      = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_user_id'], ENT_QUOTES));
                $meeting_date         = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_date'], ENT_QUOTES));
                $meeting_department   = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_department'], ENT_QUOTES));
                $meeting_description  = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_description'], ENT_QUOTES));

             
                $meeting_date =  strtotime($meeting_date);
                $meeting_date = date('Y-m-d', $meeting_date);



                $sql = "SELECT * FROM meetings WHERE meeting_name = '" . $meeting_name . "' AND meeting_active = 1;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, that meeting is already registered, choose a different name.";
                }
                /*
                elseif($meeting_date < date("Y-m-d"))
                {
                    $this->errors[] = "Dates dont make sense, please chek that your meeting date is correct.";
                } 
                */
                else 
                {
                    $sql = "INSERT INTO meetings (meeting_name, meeting_description, meeting_department_id, meeting_date, meeting_user_id)
                            VALUES('" . $meeting_name . "', '" . $meeting_description . "', '" . $meeting_department . "', '" . $meeting_date . "', '" . $meeting_user_id . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) 
                    {
                        $last_project = $this->db_connection->insert_id;
                        
                        foreach ($_POST['responsible'] as $phase)
                        {
                            //echo $phase;

                            //check if not i=empty
                            if($phase != "")
                            {
                                $iphase = $this->db_connection->real_escape_string(strip_tags($phase, ENT_QUOTES));
                                $sql = "INSERT INTO meeting_attendees (m_a_meeting_id, meeting_user_id) VALUES ($last_project, '".$iphase."')";
                                $query_new_user_insert = $this->db_connection->query($sql);
                            }
                        }

                        //header("Location: index.php?page=meeting_add&meeting_id=$last_project");
                        $this->messages[] = "Meeting saved successfuly.";
                    } 
                    else 
                    {
                        $this->errors[] = "Sorry, registration failed. Please go back and try again.";
                    }
                }
            } 
            else 
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        } 
        else 
        {
            $this->errors[] = "A validation error occurred.";
        }
    }



    private function editMeeting()
    {
        if (empty($_POST['meeting_name'])) 
        {
            $this->errors[] = "Empty Meeting Name, this field cannot be empty";
        }
       
        elseif (empty($_POST['meeting_user_id'])) 
        {
            $this->errors[] = "Meeting must have an organizer, please select one to continue.";
        }
        elseif (empty($_POST['meeting_department'])) 
        {
            $this->errors[] = "Meeting must have a responsible department, please select one to continue.";
        }

        elseif (empty($_POST['meeting_date'])) 
        {
            $this->errors[] = "Meeting must have a  date, please select one to continue.";
        }

        elseif (empty($_POST['responsible'])) 
        {
            $this->errors[] = "Meeting  must have at least one attendee, please select at least one to continue.";
        }

    
        
        elseif (
            !empty($_POST['meeting_name'])
            && !empty($_POST['meeting_user_id'])
            && !empty($_POST['meeting_date'])
            && !empty($_POST['responsible'])
            && !empty($_POST['meeting_department'])
        ) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $meeting_id           = $_GET['meeting_id'];
                $meeting_name         = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_name'], ENT_QUOTES));
                $meeting_user_id      = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_user_id'], ENT_QUOTES));
                $meeting_date         = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_date'], ENT_QUOTES));
                $meeting_department   = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_department'], ENT_QUOTES));
                $meeting_description  = $this->db_connection->real_escape_string(strip_tags($_POST['meeting_description'], ENT_QUOTES));

             
                $meeting_date =  strtotime($meeting_date);
                $meeting_date = date('Y-m-d', $meeting_date);



                $sql = "SELECT * FROM meetings WHERE meeting_name = '" . $meeting_name . "' AND meeting_id != $meeting_id;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, that meeting is already registered, choose a different name.";
                }
                
                else 
                {
                    $sql = "UPDATE meetings SET  meeting_name = '" . $meeting_name . "', meeting_description = '" . $meeting_description . "' , meeting_department_id = '" . $meeting_department . "', 
                    meeting_date = '" . $meeting_date . "', meeting_user_id = '" . $meeting_user_id . "' WHERE meeting_id = $meeting_id ";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) 
                    { 
                        
                        $delete_old = "DELETE FROM meeting_attendees WHERE m_a_meeting_id = $meeting_id";
                        $run = $this->db_connection->query($delete_old);
                        if($run)
                        {
                            foreach ($_POST['responsible'] as $phase)
                            {
                                if($phase != "")
                                {
                                    $iphase = $this->db_connection->real_escape_string(strip_tags($phase, ENT_QUOTES));
                                    $sql = "INSERT INTO meeting_attendees (m_a_meeting_id, meeting_user_id) VALUES ($meeting_id, '".$iphase."')";
                                    $query_new_user_insert = $this->db_connection->query($sql);
                                }
                            }
                            $this->messages[] = "Meeting saved successfuly.";
                        }
                        else
                        {
                            $this->errors[] = "Couldn't delete previous attendees.";
                        }
                    } 
                    else 
                    {
                        $this->errors[] = "Sorry, registration failed. Please go back and try again.";
                    }
                }
            } 
            else 
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        } 
        else 
        {
            $this->errors[] = "A validation error occurred.";
        }
    }




    private function deleteMeeting()
    {
        if (!is_numeric($_GET['meeting_id'])) 
        {
            $this->errors[] = "Invalid Parameter";
        }
        elseif (is_numeric($_GET['meeting_id'])) 
        {
            $today = date("Y-m-d H:i:s");
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $meeting_id           = $_GET['meeting_id'];
                
            
                $sql = "UPDATE meetings SET  meeting_active = 0 WHERE meeting_id = $meeting_id ";
                $query_new_user_insert = $this->db_connection->query($sql);

                $user_action = "INSERT INTO user_actions (u_a_description, u_a_meeting_id, u_a_date_time, u_a_user_id) 
                VALUES ('Deleted Meeting', $meeting_id, '$today', {$_SESSION['quatroapp_user_id']} )";
                $insert_user_action = $this->db_connection->query($user_action);

                if($query_new_user_insert)
                {
                    header("Location: index.php?page=meeting_list");
                }
                else
                {
                    $this->errors[] = "Sorry, couldnt delete meeting.";
                }
            } 
            else 
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        } 
        else 
        {
            $this->errors[] = "A validation error occurred.";
        }
    }



    private function completeMeeting()
    {
        if (empty($_GET['meeting_id'])) 
        {
            $this->errors[] = "Cant find Meeting. Please try again.";
        }
        elseif (!is_numeric($_GET['meeting_id'])) 
        {
            $this->errors[] = "Invalid format. Please try again.";
        }
        elseif (!empty($_GET['meeting_id']) && is_numeric($_GET['meeting_id'])) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $today = date("Y-m-d H:i:s");
                $meeting_id           = $_GET['meeting_id'];
                
                $count = 0;
                $query = "SELECT * FROM actions WHERE action_meeting_id = $meeting_id";
                $run = $this->db_connection->query($query);
                $num = $run->num_rows;
                while($result_row = $run->fetch_object())
                {
                    $completed = $result_row->action_complete;
                    //$aname = $result_row->action_complete;
                    if($completed == 1)
                    {
                       $count++;
                    }
                }

                if($num == 0)
                {
                    $this->errors[] = "This project has no actions, and it cannot be completed.";    

                }
                else
                {
                    if($count == $num)
                    {
                        //echo "c".$count."cou".$num;
                        $sql = "UPDATE meetings  SET meeting_complete = 1 WHERE meeting_id = $meeting_id";
                        $query_new_user_insert = $this->db_connection->query($sql);
        
                        if ($query_new_user_insert) 
                        {

                            $user_action = "INSERT INTO user_actions (u_a_description, u_a_meeting_id, u_a_date_time, u_a_user_id) 
                            VALUES ('Marked As Completed Meeting', $meeting_id, '$today', {$_SESSION['quatroapp_user_id']} )";
                            $insert_user_action = $this->db_connection->query($user_action);


                            $this->messages[] = "All actions for this meeting have been completed successfuly.";
                        } 
                        else 
                        {
                            $this->errors[] = "Sorry, registration failed. Please go back and try again.";
                        }
                    }
                    else
                    {
                        //echo "c".$completed."cou".$num;

                        $this->errors[] = "All Actions must be finished first.";    
                    }
                }
      
            } 
            else 
            {
                $this->errors[] = "Sorry, no database connection.";
            }
        } 
        else 
        {
            $this->errors[] = "A validation error occurred.";
        }
    }





}

