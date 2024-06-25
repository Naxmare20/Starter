<?php

declare(strict_types=1);

require 'src/config/config.php';

use PHPUnit\Framework\TestCase;
use App\Models\UserManager;
use App\Models\User;

final class UserManagerTest extends TestCase
{
    private ?UserManager $userManager = null;
    private ?PDO $pdo = null;

    protected function setUp(): void
    {
        parent::setUp();

        // Initialiser UserManager
        $this->userManager = new UserManager();
    }

    public function testRegisterUser(): void
    {
        $username = 'Ziyad';
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
    }

    public function FindUserByNameTest (): void

{
       // EXO : Vérifier que l'utilisateur est bien enregistré en le trouvant dans la base de données
        // avant, vous devez créer une méthode findUserByUsername dans UserManager
        /*
        $foundUser = $this->findUserByUsername($username);
        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($username, $foundUser->getUsername());
        */
    }

}
