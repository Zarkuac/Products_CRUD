<?php 

  require_once "../functions.php";
  require_once '../database.php';

  /*echo '<pre>';
  var_dump($_POST);
  echo '<pre>';*/

  /*echo '<pre>';
  var_dump($_SERVER);
  echo '<pre>';
  exit;*/

  //echo $_SERVER['REQUEST_METHOD']. '<br>';
  
  $errors = [];

  $title = '';
  $description = '';
  $price = '';

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];



    $image = $_FILES['image'] ?? null;
    $imagePath = '';

    if (!is_dir('images')) {
      mkdir('images');
    }

    if ($image && $image['tmp_name']) {
      $imagePath = 'images/'.randomString(8).'/'.$image['name'];
      mkdir(dirname($imagePath));
      move_uploaded_file($image['tmp_name'], $imagePath);
    }


    if(!$title) {
      $errors[] = 'Product title is required!';
    }

    if(!$price) {
      $errors[] = 'Product price is required!';
    }

    if (empty($errors)) {

      $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
                 VALUES (:title, :image, :description, :price, :date)");
  $statement->bindValue(':title', $title);
  $statement->bindValue(':image', $imagePath);
  $statement->bindValue(':description', $description);
  $statement->bindValue(':price', $price);
  $statement->bindValue(':date', date('Y-m-d H:i:s'));
  
  $statement->execute();

  header('Location: index.php');
  }  
  }
           
?>

<?php require_once '../views/partials/header.php'; ?>
    <p> 
    <a href="index.php" class="btn btn-secondary"> Back to products </a>
    </p>
    <h1>Create new Product</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
    <?php foreach ($errors as $error): ?>
      <div> <?php echo $error ?></div>  
      <?php endforeach;?>
    </div>
    <?php endif; ?> 
    <?php 
    $product = [
      'image' => ''
    ];
    ?>
    <?php require_once '../views/products/form.php' ?>

  </body>
</html>