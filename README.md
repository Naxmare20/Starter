# MVC_starter_template


##  Utilisation de l'héritage et gestion des erreurs

/!\ Principe de Responsabilité Unique (Single Responsibility Principle) : chaque classe ne s'occupe que d'une seule chose.
Le code est plus simple à : maintenir, tester, réutiliser, faire évoluer 

> ConnexionPDO.php

Se charge uniquement de la  création et de la gestion de la connexion à la base de données.

Utilise le **pattern Singleton** pour s'assurer qu'une seule connexion PDO est créée et utilisée.
La méthode getPdo retourne la connexion PDO, en la créant si elle n'existe pas encore.

Le bloc 'try ... catch' permet de gérer les  éventuelles erreurs lors de la  connection à la BDD. 

>  Le **pattern Singleton** est un modèle de conception qui restreint l'instanciation d'une classe à une seule instance. Cela peut être particulièrement utile pour la gestion de la connexion à une base de données, car cela garantit qu'il n'y a qu'une seule connexion active à la fois, économisant ainsi des ressources

> ConnexionManager.php

Fournit un point d'accès à la connexion PDO pour les classes qui en héritent ('extends').

> UserManager.php

Hérite de ConnexionManager, ce qui lui permet d'utiliser la connexion PDO fournie par ConnexionManager.
Ainsi, la méthode findAllUsers utilise $this->connexion pour interagir avec la BDD.


---

## Enregistrement d'un nouvel utilisateur

> FormRegister.php
> Formulaire d'inscription

```php
<?php
include_once ('Header.php');
?>
    <main>
        <h2>Register new magical user</h2>
        <form action="/register" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" value="Register">
    </form>
    </main>

<?php
include_once ('Footer.php');
```


> UserManager.php

```php
/**
 * Enregister un nouvel utilisateur
 */
public function registerUser(User $user, string $password): int
    {
        $query = 'INSERT INTO user (username, password) VALUES (:username, :password)';

        $stmt = $this->bdd->prepare($query);
        $stmt->bindValue('username', $user->getUsername());
        $stmt->bindValue('password', $user->getPassword());
        // $stmt->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));

        $stmt->execute();

        $user->setId((int)$this->bdd->lastInsertId());

        return $this->bdd->lastInsertId();
    }
````


> UserController.php

- méthode pour gérer l'affichage du formulaire 
- méthode pour gérer l'enregistrement d'un nouvel utilisateur


```php
// Afficher  le formulaire d'inscription  (page d'inscription)
    public function registerForm(): void
    {
        require VIEWS . 'FormRegister.php';
    }

    // Enregistrer un nouvel utilisateur
    public function registerUser(): void
    {
        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);

        $userManager = new UserManager();
        $userManager->registerUser($user, $_POST['password']);

        header('Location: /');
    }
```

> index.php

On ajoute les routes que l'on vient de créer dans le UserController pour afficher le formulaire d'inscription et pour traiter l'inscription
```php
// Route pour afficher le formulaire d'inscription
$router->get('/register', 'UserController@registerForm');

// Route pour traiter l'inscription
$router->post('/register', 'UserController@registerUser');
```


