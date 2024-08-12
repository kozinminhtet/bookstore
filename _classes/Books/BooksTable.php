<?php
namespace Books;

use Libs\Database\MySQL;
use PDO;
use PDOException;

class BooksTable
{
    private $db;
    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function insert($data)
    {
        try {
            $query = "INSERT INTO books (title, author_id, description, category_id, cover, file, created_at) VAlUES (:title, :author_id, :description, :category_id, :cover, :file, NOW())";

            $statement = $this->db->prepare($query);

            $statement->execute($data);

            return $this->db->lastInsertId();

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function AuthorAll()
    {
        $statement = $this->db->query("SELECT books.*, authors.name FROM books 
        LEFT JOIN authors ON books.author_id = authors.id 
        LEFT JOIN categories ON books.category_id = categories.id ORDER BY id ASC");

        return $statement->fetchAll();
    }

    public function delete($id)
    {
        $statement = $this->db->prepare("DELETE FROM books WHERE id=:id");
        $statement->execute(['id' => $id]);
        return $statement->rowCount();
    }

    public function find($id)
    {
        $author = $this->db->prepare("SELECT * FROM books WHERE id=?");
        $author->execute([$id]);
        return $author->fetch();
    }

    public function updateBook($id, $title, $description, $author_id, $category_id, $cover, $file) {
        $sql = "UPDATE books SET title = :title, description = :description, author_id = :author_id, category_id = :category_id, cover = :cover, file = :file WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            ':id' => $id,
            ':title' => $title,
            ':description' => $description,
            ':author_id' => $author_id,
            ':category_id' => $category_id,
            ':cover' => $cover,
            ':file' => $file,
        ]);
        return $statement->rowCount();
    }

    public function search($key)
    {
        $key = "%{$key}%";

        $sql = "SELECT books.*, authors.name AS author_name, categories.name AS category_name
                FROM books
                LEFT JOIN authors ON books.author_id = authors.id
                LEFT JOIN categories ON books.category_id = categories.id
                WHERE books.title LIKE ? OR books.description LIKE ? 
                OR authors.name LIKE ? OR categories.name LIKE ?";
        
        $statement = $this->db->prepare($sql);
        $statement->execute([$key, $key, $key, $key]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function bookByCategory($id)
    {
        $author = $this->db->prepare("SELECT * FROM books WHERE category_id=?");
        $author->execute([$id]);
        return $author->fetchAll();
    }
    public function bookByAuthor($id)
    {
        $author = $this->db->prepare("SELECT * FROM books WHERE author_id=?");
        $author->execute([$id]);
        return $author->fetchAll();
    }

    public function login($email, $psd)
    {
        try {
            //for injection ==> use prepare();
            $statement = $this->db->prepare("SELECT * FROM admins WHERE email=:email and password=:password");
            $statement->execute(['email' => $email , 'password' => $psd]);
            $user = $statement->fetchAll();

            //to verify password ===> password_verify()
            // if($user){
            //     if(password_verify($psd, $user->password)){
            //         return $user;
            //     }
            // }

            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
}