<?php

class Site
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
        if (isset($_POST["add_site"])) {
            $this->addSite();
        }

        else if (isset($_POST["edit_site"])) {
            $this->editSite();
        }

        else if (isset($_POST["delete_site"])) {
            $this->deleteSite();
        }
    }

   
    private function addSite()
    {
        if (empty($_POST['site_name'])) 
        {
            $this->errors[] = "Empty Site Name, this field cannot be empty";
        }
        
        elseif (!empty($_POST['site_name'])) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $site_name = $this->db_connection->real_escape_string(strip_tags($_POST['site_name'], ENT_QUOTES));
               
                $sql = "SELECT * FROM andon_site WHERE site_name = '" . $site_name . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, that cell is already registered.";
                } 
                else 
                {
                    $sql = "INSERT INTO andon_site (site_name)
                            VALUES('" . $site_name . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) 
                    {
                        $this->messages[] = "Site registration successful.";
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
            $this->errors[] = "An validation error occurred.";
        }
    }








    private function editSite()
    {
        $site_id = $_GET['site_id'];

        if (empty($_POST['site_name'])) 
        {
            $this->errors[] = "Empty Site Name, this field cannot be empty";
        }
        
        elseif (!empty($_POST['site_name'])) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) 
            {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) 
            {
                $site_name = $this->db_connection->real_escape_string(strip_tags($_POST['site_name'], ENT_QUOTES));
               
                $sql = "SELECT * FROM andon_site WHERE site_name = '" . $site_name . "' AND site_id != $site_id;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) 
                {
                    $this->errors[] = "Sorry, that cell is already registered.";
                } 
                else 
                {
                    $sql = "UPDATE andon_site SET site_name = '" . $site_name . "'  WHERE site_id = $site_id;";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) 
                    {
                        header("Location: index.php?page=andon_sites");
                        //$this->messages[] = "Site update successful.";
                    } 
                    else 
                    {
                        $this->errors[] = "Sorry, update failed. Please go back and try again.";
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
            $this->errors[] = "An validation error occurred.";
        }
    }







    private function deleteSite()
    {
        $site_id = $_GET['site_id'];

        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) 
        {
            $this->errors[] = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) 
        {
            $site_name = $this->db_connection->real_escape_string(strip_tags($_POST['site_name'], ENT_QUOTES));
            
            
            $sql = "UPDATE andon_site SET site_active = 0 WHERE site_id = $site_id;";
            $query_new_user_insert = $this->db_connection->query($sql);

            if ($query_new_user_insert) 
            {
                header("Location: index.php?page=andon_sites");
                //$this->messages[] = "Site update successful.";
            } 
            else 
            {
                $this->errors[] = "Sorry, update failed. Please go back and try again.";
            }
            
        } 
        else 
        {
            $this->errors[] = "Sorry, no database connection.";
        } 
    }
}

