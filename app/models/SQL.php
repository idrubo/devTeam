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

    $stmt = $conn->prepare ("$cmd");
    $stmt->execute ();
    $stmt->setFetchMode (PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll ();

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
      echo "Connection failed: " . $e->getMessage () . "\n";
    }

    return $conn;
  }

  private function createDB ($conn)
  {
    $sql = "CREATE DATABASE $this->db;";
    $conn->exec($sql);

    $sql = "USE $this->db;";
    $conn->exec($sql);

    $this->createTbl ($conn);
  }

  private function createTbl ($conn)
  {
    $create = "CREATE TABLE user (";
    $id     = "id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY";
    $user   = "user VARCHAR (50) NOT NULL";
    $close  = ");";

    $cmd = $create . "\n" . $id . ",\n" . $user . "\n" . $close;

    $conn->exec ($cmd);

    $create   = "CREATE TABLE task (";

    $id         = "id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY";
    $idtasuse   = "idtasuse INT UNSIGNED NOT NULL";
    $task       = "task     VARCHAR (50) NOT NULL";
    $startD     = "startD   DATE             NULL";
    $finishD    = "finishD  DATE             NULL";
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

    $conn->exec ($cmd);
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
      echo "Connection failed: " . $e->getMessage () . "\n";
    }
  }
}

?>

