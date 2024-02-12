<?php
   
   require_once '../database.php';
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if($role == "admin") {$role = 1;} 
    elseif($role == "user") {$role = 2;}; 

    if($role==1) {       
    $statement1 = $pdo->prepare("INSERT INTO users (username, password, role)
    VALUES (:username, :password, 1)");
         $statement1->bindValue(':username', $username);
$statement1->bindValue(':password', $password);
$statement1->execute();
     }
    else if ($role==2) {
        
    $statement2 = $pdo->prepare("INSERT INTO users (username, password, role)
    VALUES (:username, :password, 2)");
$statement2->bindValue(':username', $username);
$statement2->bindValue(':password', $password); 
        $statement2->execute();
    }

    header('Location: index.php');
}
?>
