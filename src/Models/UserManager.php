<?php

namespace App\Models;

use PDO;

// id, username, password
class UserManager extends PDOManager
{
    // attribut  de type User
    private $user;

    // constructeur de la classe
    public function __construct()
    {
        // Appeler le constructeur parent pour initialiser la connexion à la base de données
        parent::__construct();

        // Instancier un objet de la classe User
        //$this->user = new User();
    }

    /**
     * Find All users
     */
    public function findAllUsers(): array
    {
        $query = 'SELECT u.username, t.task 
                  FROM user u 
                  INNER JOIN todolist t ON u.id = t.user_id 
                  ORDER BY u.username';

        $stmt = $this->bdd->prepare($query);
        $stmt->execute();

        $tasksByUser = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $username = $row['username'];
            $task = $row['task'];

            // Stocker les tâches dans un tableau associatif avec l'utilisateur comme clé
            if (!isset($tasksByUser[$username])) {
                $tasksByUser[$username] = [];
            }
            $tasksByUser[$username][] = $task;
        }

        return $tasksByUser;
    }


    public function findAllTest(): false|array
    {
        $query = 'SELECT * FROM user';
        $stmt = $this->bdd->query($query);
        return $stmt->fetchAll();
    }

    /**
     * Enregister un nouvel utilisateur
     */
    public function registerUser(User $user, string $password): int
    {
        $query = 'INSERT INTO user (username, password) VALUES (:username, :password)';

        $stmt = $this->bdd->prepare($query);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());

        $stmt->execute();

        //$user->setId((int)$this->bdd->lastInsertId());

        return $this->bdd->lastInsertId();
    }

}
