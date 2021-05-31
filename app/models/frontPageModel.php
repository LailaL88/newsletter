<?php 

namespace FrontPage;
use \PDO;

class Model
{
    public $email = "";
    public $emptyEmailErr = "";
    public $unvalidEmailErr = "";
    public $colombiaEmailErr = "";
    public $checkboxErr = "";
    public $check;
    private static $pdo;

    public function addToDataBase()
    {
        $email = $this->email ?? null;
        if (!empty($_POST["email"]) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($_POST["checkbox"]) && substr($email, -3) != ".co") {
            self::$pdo = new PDO('mysql:host=localhost;dbname=magebit_test', 'root', '', array(PDO::ATTR_PERSISTENT => 'unbuff', PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false));
            $sql = "INSERT INTO `emails` (email) VALUES (:email)";
            $stmt =  self::$pdo->prepare($sql);
            $stmt->bindParam(":email", $email);                  
            $result = $stmt->execute();
        }
    }

    public function checkEmail()
    {
        self::$pdo = new PDO("mysql:host=localhost;dbname=magebit_test", "root", "");
        $sql = "SELECT * FROM emails ORDER BY id DESC LIMIT 1";
        $q =  self::$pdo->query($sql);
        $q ->setFetchMode(PDO::FETCH_ASSOC);
        $lastRow = $q->fetch();
        if ( $lastRow["email"] == htmlspecialchars($_POST["email"])) {
            $this->check = "added";
        }
    }
}
