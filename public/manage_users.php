<?php 

require_once '../database.php';

$statement = $pdo->prepare('SELECT * FROM users');
 
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require_once '../views/partials/mange_users_view.php'; ?>
<p> 
    <a href="index.php" class="btn btn-secondary"> Back to products </a>
    </p>

<table class="table">
  <thead>
    <tr>
      <th scope="col">userID</th>
      <th scope="col">Username</th>
      <th scope="col">Role</th>
      <th scope="col">Password</th>
    </tr>
  </thead>

  <tbody class="table-group-divider">
    <?php foreach($users as $i =>$user) { ?>
        <tr>
        <th scope="row"><?php echo $i + 1?></th>
        <td><?php echo $user['username']?></td>
        <td><?php if($user['role']==1) {
          echo "Admin";}
          elseif($user['role']==2){echo "User";}?></td>
        <td>*********</td>
      </tr>
  <?php }  ?>

  </tbody>
</table>