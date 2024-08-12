<?php
namespace Books;

use Libs\Database\MySQL;
use PDO;
use PDOException;

class CategorysTable
{
    private $db;
    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function insert($data)
    {
        try {
            $author = "INSERT INTO categories (name) VALUES (:name)";
            $statement = $this->db->prepare($author);
            $statement->execute($data);

            return $this->db->lastInsertId(); 
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        
    }

    public function all()
    {
        $category = $this->db->query("SELECT * FROM categories");
        return $category->fetchAll();
    }

    public function find($id)
    {
        $category = $this->db->prepare("SELECT * FROM categories WHERE id=?");
        $category->execute([$id]);
        return $category->fetch();
    }

    public function update($id, $name)
    {
        $statement = $this->db->prepare("UPDATE categories SET name=:name WHERE id=:id");
        $statement->execute([
            'id' => $id,
            'name' => $name,
        ]);
    }

    public function delete($id)
    {
        $statement = $this->db->prepare("DELETE FROM categories WHERE id=:id");
        $statement->execute(['id' => $id]);
        return $statement->rowCount();
    }
}