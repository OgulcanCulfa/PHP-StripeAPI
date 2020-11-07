<?php

class Database {
 
    private $db;
    private $dsn;
    private $user;
    private $password;
    private $stmt;

    function __construct() {      
        $this->dsn = 'mysql:host=localhost;dbname=paypage;port=3308;charset=utf8;';
        $this->user = 'root';
        $this->password = '';
    }

    public function connect() {

        try { $this->db = new PDO($this->dsn, $this->user, $this->password); 
        }
        catch (PDOException $e) { echo 'Veritabanı bağlantısı başarısız oldu: ' . $e->getMessage(); 
        }
    }

    public function create_query($query) {
            
        $this->stmt = $this->db->prepare($query);

    }


    // Binding

    public function bind($param, $value, $type = null) {

        /*if (is_null ($type)) {

            switch (true) {

                case is_int ($value):

                    $type = PDO::PARAM_INT;
                    break;

                case is_bool ($value):

                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null ($value):

                    $type = PDO::PARAM_NULL;
                    break;

                default :
                    $type = PDO::PARAM_STR;

            }
        }
*/
        $this->stmt->bindValue($param, $value, $type);
    }


    // Execute the prepared statement

    public function execute(){
        return $this->stmt->execute();
    }
    
    // Get result set as array of objects

    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Get single record as object
    public function single(){

        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
    // Get record row count

    public function rowCount(){
        return $this->stmt->rowCount();
    }
    
    // Returns the last inserted ID

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    // Close the connection

    public function close_connect() {
        $this->db = null;
    }

}

   

?>