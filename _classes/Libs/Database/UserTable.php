<?php
namespace Libs\Database;

use PDOException;

class UserTable
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function insert($data)
    {
        try {
            $query = "INSERT INTO admins (name, email, password, created_at) VALUES (:name, :email, :password, NOW())";

            $statement = $this->db->prepare($query);
            $statement->execute($data);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function find($email, $password)
    {
        try {
            //for injection ==> use prepare();
            $statement = $this->db->prepare("SELECT * FROM users WHERE email=:email");
            $statement->execute(['email' => $email]);
            $user = $statement->fetch();

            //to verify password ===> password_verify()
            if($user){
                if(password_verify($password, $user->password)){
                    return $user;
                }
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function all()
    {
        $statement = $this->db->query("SELECT * FROM admins");
        return $statement->fetchAll();
    }


}