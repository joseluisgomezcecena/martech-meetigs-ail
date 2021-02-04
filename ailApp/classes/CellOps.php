<?php

class CellOps
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
        if (isset($_POST["new_cell"])) {
            $this->newCell();
        }

        else if (isset($_POST["new_op"])) {
            $this->newOp();
        }
    }

   
    private function newCell()
    {
        if (empty($_POST['cell_name'])) 
        {
            $this->errors[] = "Empty Cell Name";
        }
        
        elseif (!empty($_POST['cell_name'])) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $cell_name              = $this->db_connection->real_escape_string(strip_tags($_POST['cell_name'], ENT_QUOTES));
               
                $sql = "SELECT * FROM cells WHERE cell_name = '" . $cell_name . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that cell is already registered.";
                } else {
                    $sql = "INSERT INTO cells (cell_name)
                            VALUES('" . $cell_name . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) {
                        $this->messages[] = "Cell upload successful.";
                    } else {
                        $this->errors[] = "Sorry, registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    }










    private function newOp()
    {
        $cell_id = $_GET['cell_id'];

        if (empty($_POST['op_name'])) 
        {
            $this->errors[] = "Empty Operation Name";
        }
        
        elseif (!empty($_POST['op_name'])) 
        {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {

                $op_name              = $this->db_connection->real_escape_string(strip_tags($_POST['op_name'], ENT_QUOTES));
               
                $sql = "SELECT * FROM ops WHERE op_name = '" . $op_name . "' AND cell_id = $cell_id;";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that operation is already registered.";
                } else {
                    $sql = "INSERT INTO ops (op_name, cell_id)
                            VALUES('" . $op_name . "', '" . $cell_id . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    if ($query_new_user_insert) {
                        $this->messages[] = "Operation upload successful.";
                    } else {
                        $this->errors[] = "Sorry, registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        } else {
            $this->errors[] = "An unknown error occurred.";
        }
    }
}











