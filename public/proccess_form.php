<?php 

require_once '../database.php';


  $email = $_POST['email'];

  $statement = $pdo->prepare("INSERT INTO save_cmails (email_address) VALUES ('$email')");
  $statement->execute();

  // echo '<script>alert("EMAIL SENT")</script>';
  // header('Location: index.php');
  echo '<script> alert("EMAIL SENT. Admin Will Contact You !");
        window.location.href="index.php";</script>';




        //SAVING EMAILS FROM FOOTER
?>
