<?php
 $email = test_input($_POST["email"]);
if (!empty($_POST["email"]) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($_POST["checkbox"]) && substr($email, -3) != ".co"){
$pdo = new PDO('mysql:host=localhost;dbname=magebit_test', 'root', '', array(PDO::ATTR_PERSISTENT => 'unbuff', PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false));

$sql = "INSERT INTO `emails` (email)
                                        VALUES (:email)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":email", $email);


$email = $_POST['email'];

$form = $_POST;
$id = $form[ 'email' ];                    


$result = $stmt->execute();

if($result) {
    echo "Your text has been posted";

    }// end if
else {
    echo '0 results';
    }// end else
}




    // define variables and set to empty values
   
    



