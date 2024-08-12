<?php
namespace Books;

use Libs\Database\MySQL;
use PDO;
use PDOException;


class AuthorsTable
{
    private $db;
    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function all()
    {
        $author = $this->db->query("SELECT * FROM authors");
        return $author->fetchAll();
    }

    public function insert($data)
    {
        try {
            $author = "INSERT INTO authors (name) VALUES (:name)";

            $statement = $this->db->prepare($author);

            $statement->execute($data);

            return $this->db->lastInsertId(); 
            
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        
    }

    public function delete($id)
    {
        $statement = $this->db->prepare("DELETE FROM authors WHERE id=:id");
        $statement->execute(['id' => $id]);
        return $statement->rowCount();
    }

    public function find($id)
    {
        $author = $this->db->prepare("SELECT * FROM authors WHERE id=?");
        $author->execute([$id]);
        return $author->fetch();
    }
    public function findd($key)
    {
        $author = $this->db->prepare("SELECT * FROM authors WHERE id=?");
        $author->execute([$key]);
        return $author->fetch();
    }

    public function update($id, $name)
    {
        $statement = $this->db->prepare("UPDATE authors SET name=:name WHERE id=:id");
        $statement->execute([
            'id' => $id,
            'name' => $name,
        ]);
    }
}