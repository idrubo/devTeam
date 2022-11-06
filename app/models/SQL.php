<?php

class SQL
{
  private $srv, $user, $pass, $db;
  private $conn;

  public function __construct ($s = 'localhost', $u = 'ita', $p = 'ita', $d = 'taskUpdt')
  {
    $this->srv  = $s;
    $this->user = $u;
    $this->pass = $p;
    $this->db   = $d;

    $this->setUpDB ();
  }

  private function setUpDB ()
  {
    $conn = $this->connectSQL ();

    $where = " WHERE schema_name = \"$this->db\"";
    $select = "SELECT SCHEMA_NAME FROM information_schema.schemata";
    $cmd = "$select" . "$where" . ";";

    try
    {
      $stmt = $conn->prepare ("$cmd");
      $stmt->execute ();
      $stmt->setFetchMode (PDO::FETCH_ASSOC);
      $data = $stmt->fetchAll ();
    }
    catch (PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage () . "<br>";
    }

    if (! count ($data)) $this->createDB ($conn);

    $this->connectDB ();

    $conn = null;
  }

  private function connectSQL ()
  {
    try
    {
      $conn = new PDO ("mysql:host=$this->srv", $this->user, $this->pass);
      $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage () . "<br>";
    }

    return $conn;
  }

  private function createDB ($conn)
  {
    $cmd = "CREATE DATABASE $this->db;";

    try 
    {
      $conn->exec ($cmd);
    }
    catch(PDOException $e)
    {
      echo $cmd . "<br>" . $e->getMessage() . "<br>";
    }

    $cmd = "USE $this->db;";

    try 
    {
      $conn->exec ($cmd);
    }
    catch(PDOException $e)
    {
      echo $cmd . "<br>" . $e->getMessage() . "<br>";
    }

    $this->createTbl ($conn);
  }

  private function createTbl ($conn)
  {
    $create = "CREATE TABLE user (";
    $id     = "id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY";
    $user   = "user VARCHAR (50) NOT NULL";
    $close  = ");";

    $cmd = $create . "\n" . $id . ",\n" . $user . "\n" . $close;

    try 
    {
      $conn->exec ($cmd);
    }
    catch(PDOException $e)
    {
      echo $cmd . "<br>" . $e->getMessage() . "<br>";
    }

    $create   = "CREATE TABLE task (";

    $id         = "id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY";
    $idtasuse   = "idtasuse INT UNSIGNED NOT NULL";
    $task       = "task     VARCHAR (50) NOT NULL";
    $startD     = "startD   DATETIME         NULL";
    $finishD    = "finishD  DATETIME         NULL";
    $status     = "status   ENUM ('pending', 'running', 'finished') NOT NULL";

    $constraint = "CONSTRAINT idtas_iduse FOREIGN KEY (idtasuse)";
    $references = "REFERENCES user (id)";
    $onDelete   = "ON DELETE RESTRICT";
    $onUpdate   = "ON UPDATE CASCADE";

    $close    = ");";

    $cmd  = $create . "\n";
    $cmd .= $id . ",\n" . $idtasuse . ",\n" . $task . ",\n";
    $cmd .= $startD . ",\n" . $finishD . ",\n" . $status . ",\n";
    $cmd .= $constraint . " \n" . $references . " \n";
    $cmd .= $onDelete . " \n" . $onUpdate . " \n";
    $cmd .= $close;

    try 
    {
      $conn->exec ($cmd);
    }
    catch(PDOException $e)
    {
      echo $cmd . "<br>" . $e->getMessage() . "<br>";
    }
  }

  public function connectDB ()
  {
    try
    {
      $this->conn = new PDO ("mysql:host=$this->srv;dbname=$this->db", $this->user, $this->pass);
      $this->conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage () . "<br>";
    }
  }

  public function getConn () { return $this->conn; }

  public function insert ($table, $fields, $values)
  {
    $values = " VALUES $values";
    $insert = "INSERT INTO $table $fields";
    $cmd = "$insert" . "$values" . ";";

    try 
    {
      $this->conn->exec ($cmd);
    }
    catch(PDOException $e)
    {
      echo $cmd . "<br>" . $e->getMessage() . "<br>";
    }
  }

  public function select ($table, $field, $cond)
  {
    $where = " WHERE $cond";
    $select = "SELECT $field FROM $table";
    $cmd = "$select" . "$where" . ";";

    try 
    {
      $stmt = $this->conn->prepare ("$cmd");
      $stmt->execute ();
      $stmt->setFetchMode (PDO::FETCH_ASSOC);
      $data = $stmt->fetchAll ();
    }
    catch(PDOException $e)
    {
      echo $cmd . "<br>" . $e->getMessage() . "<br>";
    }

    return $data;
  }
}
?>

