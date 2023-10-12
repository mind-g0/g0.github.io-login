<?php
require('DbConfig.php');
class DbHandler extends DbConfig{
    public $conn;
    protected $databaseName;
    protected $hostName;
    protected $uName;
    protected $passCode;

    public function __construct(){
       
        $dbPara = new DbConfig();
        $this->databaseName = $dbPara->dbName;
        $this->hostName = $dbPara->serverName;
        $this->uName = $dbPara->userName;
        $this->passCode = $dbPara->passCode;
        $dbPara = NULL;
    }

    public function dbConnect(){
        try{
            $this->conn = new mysqli($this->hostName, $this->uName, $this->passCode, $this->databaseName);

            if (mysqli_connect_errno()){
                throw new Exception('Could not connect to database.');
            }else{
                return true;
            }
            } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function insert($id,$name){

        try {
            $sql = "INSERT INTO pets (id , name) VALUES (?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('is', $id, $name);    

            return ($stmt->execute()) ? true : false;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function retrieve(){
        try {
            $sql = "SELECT * FROM pets";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

			return $result;

        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }  
    }

	public function search_id($id){
		try {
			$sql = "SELECT * FROM pets WHERE id =?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param('i',$id);
			$stmt->execute();
			$result = $stmt->get_result();

			return $result;

		}catch (Exception $e) {
            throw new Exception($e->getMessage());
        }	
	}

    public function search_name($name){
		try {
			$sql = "SELECT * FROM pets WHERE name =?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param('s',$name);
			$stmt->execute();
			$result = $stmt->get_result();

			return $result;

		}catch (Exception $e) {
            throw new Exception($e->getMessage());
        }	
	}


	public function update_n($id, $name){

		try{
			$sql = "UPDATE  pets SET name=? WHERE id =?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param('si',$name,$id);
			$stmt->execute();

			return  ($stmt)? true : false;

		}catch (Exception $e) {
            throw new Exception($e->getMessage());
        }		
	}

    public function update_i($id, $name){

		try{
			$sql = "UPDATE  pets SET id=? WHERE name =?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param('is',$id,$name);
			$stmt->execute();

			return  ($stmt)? true : false;

		}catch (Exception $e) {
            throw new Exception($e->getMessage());
        }		
	}

    
    
    public function delete($id){
        try{
        $sql = "DELETE FROM pets WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i',$id);
        $stmt->execute();
		$result = $stmt->get_result();
		
		return $result;
        
    }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    function login($username, $password){
        try{
        $sql ="SELECT * FROM users WHERE username =? AND password =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss',$username,$password);
        $stmt->execute();
        $result = $stmt->get_result();      
        return $result;
    }catch(Exception $e){
            throw new Exception($e->getMessage());
        }       

    }
   public function updateAccess($auth_code,$username) {
        try{
            $sql ="UPDATE users SET accessescode = ? WHERE username =?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ss',$auth_code,$username);
         //   $stmt->bind_param('is',$accessescode,$username);
         return  ($stmt->execute())? true : false;
        }catch(Exception $e){
            throw new Exception($e->getMessage());

            
        }
    }
    public function access($username){
        try{
            $sql="SELECT accessescode FROM users WHERE username =?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s',$username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }catch(Exception $e){
            throw new Exception($e->getMessage());

        }
    }


}

?>

