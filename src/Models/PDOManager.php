<?php
namespace App\models;

use PDO;
use PDOException;
/**
 * Utilise le pattern Singleton pour s'assurer qu'une seule connexion PDO est créée et utilisée.
 */

class PDOManager
{
    /** Connection PDO **/
    // la variable $bdd représente la connexion à la base de données. Elle est de type PDO et est protégée pour que les classes filles puissent y accéder.
    protected PDO $bdd;

    //  la  variable  $pdo  est  une  propriété  statique  de  la  classe  PDOManager.  Elle  est  initialisée  à  null  et  est  de  type  PDO.  Elle  est  privée  pour  que  l'on  ne  puisse  pas  y  accéder  directement  depuis  l'extérieur  de  la  classe.  Elle  est  statique  pour  que  l'on  puisse  la  partager  entre  toutes  les  instances  de  PDOManager.
    private static ?PDO $pdo = null;

    public function __construct()
    {
         $this->bdd = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
         $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //  Si la  propriété  $pdo  est  égale  à  null,  cela  signifie  qu'aucune  connexion  PDO  n'a  encore  été  créée.  Dans  ce  cas,  on  crée  une  nouvelle  connexion  PDO  en  utilisant  les  constantes  définies  dans  le  fichier  de  configuration  config.php.  Cela  permet d'éviter de créer plusieurs connexions PDO inutilement. (optilisation des ressources) 
        if (self::$pdo === null) {

            // le bloc try/catch permet de capturer les erreurs qui pourraient survenir lors de la connexion à la base de données. Si une erreur survient, un message d'erreur est affiché et le script s'arrête.
            try {
                self::$pdo = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD, [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }      
    }
}