<?php

class Project
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
        if (isset($_POST["add_project"])) {
            $this->addProject();
        }

        else if (isset($_POST["edit_project"])) {
            $this->editProject();
        }

        else if (isset($_POST["delete_project"])) {
            $this->deleteProject();
        }

        else if (isset($_POST["complete_project"])) {
            $this->completeProject();
        }
    }

   
    private function addProject()
    {
        if (empty($_POST['project_name'])) 
        {
            $this->errors[] = "Empty Project Name, this field cannot be empty";
        }
        elseif (empty($_POST['project_description'])) 
        {
            $this->errors[] = "Empty Description, this field cannot be empty";
        }
        elseif (empty($_POST['project_owner'])) 
        {
            $this->errors[] = "Project must have an owner, please select one to continue.";
        }
        elseif (empty($_POST['project_department'])) 
        {
            $this->errors[] = "Project must have a responsible department, please select one to continue.";
        }
        elseif (empty($_POST['project_start_date'])) 
        {
            $this->errors[] = "Project must have a start date, please select one to continue.";
        }
        elseif (empty($_POST['project_promise_date'])) 
        {
            $this->errors[] = "Project must have a promise date, please select one to continue.";
        }
        elseif (empty($_POST['phase'])) 
        {
            $this->errors[] = "Project must have at least one phase, please select one to continue.";
        }

        /*
        elseif ($_POST['project_start_date'] > $_POST['project_start_date']) 
        {
            $this->errors[] = "Dates dont make sense, please chek that your start date is before your end date.";
        }
        */

        
        elseif (
            !empty($_POST['project_name'])
            && !empty($_POST['project_description'])
            && !empty($_POST['project_owner'])
            && !empty($_POST['project_start_date'])
            && !empty($_POST['project_promise_date'])
            && !empty($_POST['project_department'])
            && !empty($_POST['phase'])
            //&& ($_POST['project_start_date'] <= $_POST['project_promise_date'])
        ) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $project_name         = $this->db_connection->real_escape_string(strip_tags($_POST['project_name'], ENT_QUOTES));
                $project_description  = $this->db_connection->real_escape_string(strip_tags($_POST['project_description'], ENT_QUOTES));
                $project_owner        = $this->db_connection->real_escape_string(strip_tags($_POST['project_owner'], ENT_QUOTES));
                $project_support      = $this->db_connection->real_escape_string(strip_tags($_POST['project_support'], ENT_QUOTES));
                $project_start_date   = $this->db_connection->real_escape_string(strip_tags($_POST['project_start_date'], ENT_QUOTES));
                $project_promise_date = $this->db_connection->real_escape_string(strip_tags($_POST['project_promise_date'], ENT_QUOTES));
                $project_department   = $this->db_connection->real_escape_string(strip_tags($_POST['project_department'], ENT_QUOTES));
                
             
                $project_start_date =  strtotime($project_start_date);
                $project_start_date = date('Y-m-d', $project_start_date);

                $project_promise_date =  strtotime($project_promise_date);
                $project_promise_date = date('Y-m-d', $project_promise_date);
                


                $sql = "SELECT * FROM projects WHERE project_name = '" . $project_name . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, that project is already registered, choose a different name.";
                }
                elseif($project_start_date > $project_promise_date)
                {
                    $this->errors[] = "Dates dont make sense, please chek that your start date is before your end date.";
                } 
                else 
                {
                    $sql = "INSERT INTO projects (project_name, project_description, project_owner, project_start_date, project_promise_date, project_department, project_support)
                            VALUES('" . $project_name . "', '" . $project_description . "', '" . $project_owner . "', '" . $project_start_date . "', '" . $project_promise_date . "', '" . $project_department . "', '" . $project_support . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) 
                    {
                        $last_project = $this->db_connection->insert_id;
                        
                        foreach ($_POST['phase'] as $phase)
                        {
                            //echo $phase;

                            //check if not i=empty
                            if($phase != "")
                            {
                                $iphase = $this->db_connection->real_escape_string(strip_tags($phase, ENT_QUOTES));
                                $sql = "INSERT INTO project_phase (project_id, phase_name) VALUES ($last_project, '".$iphase."')";
                                $query_new_user_insert = $this->db_connection->query($sql);
                            }
                        }

                        $this->messages[] = "Project saved successfuly.";
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







    private function editProject()
    {
        if (empty($_POST['project_name'])) 
        {
            $this->errors[] = "Empty Project Name, this field cannot be empty";
        }
        elseif (empty($_POST['project_description'])) 
        {
            $this->errors[] = "Empty Description, this field cannot be empty";
        }
        elseif (empty($_POST['project_owner'])) 
        {
            $this->errors[] = "Project must have an owner, please select one to continue.";
        }
        elseif (empty($_POST['project_department'])) 
        {
            $this->errors[] = "Project must have a responsible department, please select one to continue.";
        }
        elseif (empty($_POST['project_start_date'])) 
        {
            $this->errors[] = "Project must have a start date, please select one to continue.";
        }
        elseif (empty($_POST['project_promise_date'])) 
        {
            $this->errors[] = "Project must have a promise date, please select one to continue.";
        }
        elseif (empty($_POST['phase'])) 
        {
            $this->errors[] = "Project must have at least one phase, please select one to continue.";
        }

        /*
        elseif ($_POST['project_start_date'] > $_POST['project_start_date']) 
        {
            $this->errors[] = "Dates dont make sense, please chek that your start date is before your end date.";
        }
        */

        
        elseif (
            !empty($_POST['project_name'])
            && !empty($_POST['project_description'])
            && !empty($_POST['project_owner'])
            && !empty($_POST['project_start_date'])
            && !empty($_POST['project_promise_date'])
            && !empty($_POST['project_department'])
            && !empty($_POST['phase'])
            //&& ($_POST['project_start_date'] <= $_POST['project_promise_date'])
        ) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $project_id           = $_GET['project_id'];
                $project_name         = $this->db_connection->real_escape_string(strip_tags($_POST['project_name'], ENT_QUOTES));
                $project_description  = $this->db_connection->real_escape_string(strip_tags($_POST['project_description'], ENT_QUOTES));
                $project_owner        = $this->db_connection->real_escape_string(strip_tags($_POST['project_owner'], ENT_QUOTES));
                $project_support      = $this->db_connection->real_escape_string(strip_tags($_POST['project_support'], ENT_QUOTES));
                $project_start_date   = $this->db_connection->real_escape_string(strip_tags($_POST['project_start_date'], ENT_QUOTES));
                $project_promise_date = $this->db_connection->real_escape_string(strip_tags($_POST['project_promise_date'], ENT_QUOTES));
                $project_department   = $this->db_connection->real_escape_string(strip_tags($_POST['project_department'], ENT_QUOTES));
                
             
                $project_start_date =  strtotime($project_start_date);
                $project_start_date = date('Y-m-d', $project_start_date);

                $project_promise_date =  strtotime($project_promise_date);
                $project_promise_date = date('Y-m-d', $project_promise_date);
                


                $sql = "SELECT * FROM projects WHERE project_name = '" . $project_name . "' AND project_id != $project_id;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, that project is already registered, choose a different name.";
                }
                elseif($project_start_date > $project_promise_date)
                {
                    $this->errors[] = "Dates dont make sense, please chek that your start date is before your end date.";
                } 
                else 
                {
                    $sql = "UPDATE projects  SET project_name = '" . $project_name . "', project_description = '" . $project_description . "', 
                    project_owner = '" . $project_owner . "', project_start_date = '" . $project_start_date . "', 
                    project_promise_date = '" . $project_promise_date . "', project_department = '" . $project_department . "', 
                    project_support = '" . $project_support . "' 
                    WHERE project_id = $project_id";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) 
                    {
                        foreach ($_POST['phase'] as $phase)
                        {
                            //echo $phase;
                            if($phase != "")
                            {
                                $iphase = $this->db_connection->real_escape_string(strip_tags($phase, ENT_QUOTES));
                                $sql = "INSERT INTO project_phase (project_id, phase_name) VALUES ($project_id, '".$iphase."')";
                                $query_new_user_insert = $this->db_connection->query($sql);
                            }
                        }

                        

                        $this->messages[] = "Project saved successfuly.";
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






    private function deleteProject()
    {
        if (empty($_GET['project_id'])) 
        {
            $this->errors[] = "Empty Project, this field cannot be empty";
        }
        
        elseif (!empty($_GET['project_id'])) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $project_id           = $_GET['project_id'];
                
                $sql = "UPDATE projects  SET project_active = 0 WHERE project_id = $project_id";
                $query_new_user_insert = $this->db_connection->query($sql);

                if ($query_new_user_insert) 
                {
                    $this->messages[] = "Project deleted successfuly.";
                } 
                else 
                {
                    $this->errors[] = "Sorry, registration failed. Please go back and try again.";
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











    private function completeProject()
    {
        if (empty($_GET['project_id'])) 
        {
            $this->errors[] = "Empty Project, this field cannot be empty";
        }
        
        elseif (!empty($_GET['project_id'])) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $project_id           = $_GET['project_id'];
                
                $count = 0;
                $query = "SELECT * FROM actions WHERE action_project_id = $project_id";
                $run = $this->db_connection->query($query);
                $num = $run->num_rows;
                while($result_row = $run->fetch_object())
                {
                    $completed = $result_row->action_complete;
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
                    if($completed == $num)
                    {
                        //echo "c".$completed."cou".$count;
                        $sql = "UPDATE projects  SET project_status = 2 WHERE project_id = $project_id";
                        $query_new_user_insert = $this->db_connection->query($sql);
        
                        if ($query_new_user_insert) 
                        {
                            $this->messages[] = "Project completed successfuly.";
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

