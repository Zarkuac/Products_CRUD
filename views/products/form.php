<?php 

?>


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