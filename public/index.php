<?php 

  require_once '../database.php';

  $statement =  $pdo->prepare('SELECT * FROM products
                               order by create_date desc');
  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);

  /*echo '<pre>';
  var_dump($products);
  echo '<pre>';*/
?>

  <?php require_once '../views/partials/header.php'; ?>
      
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
        <td>
        <?php if ($product['image']): ?>
                    <img src="<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>" class="product-img">
                <?php endif; ?>
        </td>
        <td><?php echo $product['title']?></td>
        <td><?php echo $product['price']?></td>
        <td><?php echo $product['create_date']?></td>
        <td> 
        <a href="update.php?id=<?php echo $product['id'] ?>"
        class="btn btn-sm btn-outline-primary">Edit</a>
        <form method="post" action="delete.php" style="display: inline-block">
        <input type="hidden" name="id" value="<?php echo $product['id'] ?>"/>
        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
        </form>  
      </td>
      </tr>
  <?php }  ?>

  </tbody>
</table>

  </body>
</html>
