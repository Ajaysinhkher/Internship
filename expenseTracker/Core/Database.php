<?php 
namespace Core;


use PDO;

class Database{

    public $connection;
    public $statement;

    // connect with db:
    public function __construct($config){
    
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";
        $this->connection = new PDO($dsn,'root','kher');
    }

    // fire query on db
    public function query($query,$params = []){
    
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function find(){
        return $this->statement->fetch();
    }

    public function get(){
        return $this->statement->fetchAll();
    }

    public function findOrFail(){
        $result = $this->find();

        if(! $result)
        {
            abort();
        }

        return $result;
    }
}



?>
