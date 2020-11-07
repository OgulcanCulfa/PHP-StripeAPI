<?php 
	

	class Customer {

		private $datab;




		public function __construct() {

			$this->datab = new Database;
		}

		public function addCustomer($data) {

			// db conn

			$this->datab->connect();

			// Prepare Query

			$this->datab->create_query("INSERT INTO customers (ID, first_name, last_name, email) VALUES(`:id`,` :first_name`, `:last_name`, `:email`)");

			// Bind Values

			$this->datab->bind(':id', $data['id'],PDO::PARAM_STR);
			$this->datab->bind(':first_name', $data['first_name'],PDO::PARAM_STR);
			$this->datab->bind(':last_name', $data['last_name'],PDO::PARAM_STR);
			$this->datab->bind(':email', $data['email'],PDO::PARAM_STR);

			// Execute

			$this->datab->execute();


        	

        	$this->datab->close_connect();

	}
			

		
}	

?>