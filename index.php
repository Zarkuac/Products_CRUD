<?php 

  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $statement =  $pdo->prepare('SELECT * FROM products');
  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);

  /*echo '<pre>';
  var_dump($products);
  echo '<pre>';*/
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
    <h1>Products Crud</h1>

    <p> 
    <a href="create.php" type="button" class="btn btn-sm btn-success">Add Product</a>
    </p>
    
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Create Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php foreach($products as $i =>$product) { ?>
        <tr>
        <th scope="row"><?php echo $i + 1?></th>
        <td></td>
        <td><?php echo $product['title']?></td>
        <td><?php echo $product['price']?></td>
        <td><?php echo $product['create_date']?></td>
        <td> 
        <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
        <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
        </td>
      </tr>
  <?php }  ?>

  </tbody>
</table>

  </body>
</html>