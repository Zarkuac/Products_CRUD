<?php 
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

    if ($image) {
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

  function randomString($n) {
    $characters= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $str = '';
    for ($i = 0 ; $i < $n; $i++){
      $index = rand(0, strlen($characters) - 1);
      $str .= $characters[$index];
    }
    return $str;
  }
            
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products Crud</title>
    <link href="app.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <h1>Create new Product</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
    <?php foreach ($errors as $error): ?>
      <div> <?php echo $error ?></div>  
      <?php endforeach;?>
    </div>
    <?php endif; ?>


    <form method='post' enctype="multipart/form-data">
  <div class="form-group">
    <label>Product Image</label> <br>
      <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
    <label>Product title</label>
      <input type="text" class="form-control" name="title" value="<?php echo $title?>">
    </div>
    <div class="form-group">
    <label>Product Description</label>
      <textarea type="text" class="form-control" name="description"><?php echo $description ?> </textarea>
    </div>
    <div class="form-group">
    <label>Product price</label>
      <input type="decimal" class="form-control" name="price" value="<?php echo $price?>">
    </div>
<br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

  </body>
</html>