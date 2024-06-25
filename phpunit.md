# Les tests unitaires avec PHPUnit

## Installation
installez PHPUnit via Composer :

```bash
composer require --dev phpunit/phpunit
```

Le fichier composer.json doit maintenant contenir la dépendance suivante :

```json
{
    "require-dev": {
        "phpunit/phpunit": "^11.2"
    }
}
```


## Créer un répertoire de tests
   
Créez un répertoire tests à la racine de votre projet pour y placer vos tests unitaires.

## Créer une classe de test pour l'enregistrement d'un utilisateur
   
Dans le répertoire tests, créez un fichier nommé UserManagerTest.php pour tester l'enregistrement d'un utilisateur.

```php
<?php

declare(strict_types=1);

require 'src/config/config.php';

use PHPUnit\Framework\TestCase;
use App\Models\UserManager;
use App\Models\User;

// les noms des classes de test doivent se terminer par Test
final class UserManagerTest extends TestCase
{
    private ?UserManager $userManager = null;
    private ?PDO $pdo = null;

    protected function setUp(): void
    {
        parent::setUp();

        // Initialiser UserManager sans transaction
        $this->userManager = new UserManager();
    }

    public function testRegisterUser(): void
    {
        $username = 'testuserPHPunit';
        $password = 'testpassword';

        // Créer un objet User
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);

        // Appeler la méthode registerUser
        $generatedId = $this->userManager->registerUser($user, $password);

        // Vérifier que l'ID retourné est un entier positif
        $this->assertIsInt($generatedId);
        $this->assertGreaterThan(0, $generatedId);

        // EXO : Vérifier que l'utilisateur est bien enregistré en le trouvant dans la base de données
        // avant, vous devez créer une méthode findUserByUsername dans UserManager
        /*
        $foundUser = $this->findUserByUsername($username);
        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($username, $foundUser->getUsername());
        */
    }

}

```

## Exécuter les tests

Pour exécuter les tests, utilisez la commande suivante :

```bash
./vendor/bin/phpunit tests
```

Résultat attendu :

```bash
PHPUnit 9.5.0 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.3.1

.                                                                   1 / 1 (100%)

Time: 00:00.005, Memory: 6.00 MB

OK (1 test, 2 assertions)
```

## Les  différentes assertions pour PHPUnit

Il  existe plusieurs méthodes pour tester les résultats de vos fonctions. Voici quelques exemples :

```php
$this->assertTrue(true);
$this->assertFalse(false);
$this->assertEquals('foo', 'foo');
$this->assertNotEquals('foo', 'bar');
$this->assertNull(null);
$this->assertNotNull('foo');
$this->assertIsArray([]);
$this->assertIsString('foo');
$this->assertIsInt(42);
$this->assertIsFloat(4.2);
$this->assertIsNumeric('42');
$this->assertIsBool(true);
$this->assertInstanceOf(User::class, $user);
$this->assertGreaterThanOrEqual(3, 3);
$this->assertGreaterThan(3, 2);
$this->assertLessThanOrEqual(3, 3);
$this->assertLessThan(3, 4);
$this->assertCount(3, [1, 2, 3]);
$this->assertEmpty([]);
$this->assertNotEmpty([1, 2, 3]);
$this->assertStringContainsString('foo', 'foobar');
$this->assertStringNotContainsString('bar', 'foo');
$this->assertStringEndsWith('bar', 'foobar');
$this->assertStringStartsWith('foo', 'foobar');
$this->assertMatchesRegularExpression('/foo/', 'foobar');
$this->assertDoesNotMatchRegularExpression('/baz/', 'foobar');
$this->assertFileExists('index.php');
$this->assertFileDoesNotExist('index.html');
$this->assertDirectoryExists('src');
$this->assertDirectoryDoesNotExist('app');
$this->assertGreaterThan(0, $user->getId());
$this->assertMatchesRegularExpression('/^[0-9]+$/', $user->getId());
$this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $user->getUsername());
$this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $user->getPassword());
```

## Exercice

Ajoutez le code nécessaire pour vérifier que l'utilisateur est bien enregistré en le trouvant dans la base de données.

Pour cela, vous devez créer une méthode findUserByUsername dans UserManager :

```php
public function findUserByUsername(string $username): ?User
{
    $query = 'SELECT * FROM user WHERE username = :username';

    $stmt = $this->bdd->prepare($query);
    $stmt->bindValue('username', $username);
    $stmt->execute();

    $user = $stmt->fetchObject(User::