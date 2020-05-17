<?php
include_once './Controllers/Product.controller.php';


class ManageProductsView extends ProductController
{
    public function calculateDiscount($discount, $price){
        return $price - ($price*($discount/100));
    }

    public function showProducts()
    {
        $products = $this->getProducts();
        // var_dump($products);

        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>" . $product['ProductID'] . "</td> ";
            echo "<td>" . $product['Name'] . "</td>  ";
            echo "<td>" . $product['Price'] . " kr </td> ";

            echo "<td>"; if($product['Discount'] !== NULL){ echo"" . $product['Discount'] . " % "; } else{ echo "<i class='text-muted'>None</i>  ";}  echo" </td> ";
            echo "<td>"; if($product['Discount'] !== NULL){ echo"" . $this->calculateDiscount($product['Discount'], $product['Price']) . " kr "; }else{ echo "<i class='text-muted'>None</i>  ";}  echo"</td> ";

            echo "<td> #" . $product['Code'] . "  </td> ";
            echo "<td> <img style='width:40px; height: 40px' src='./assets/images/{$product['Image']}'> </td> ";
            echo "<td><button type='button' class='btn btn-primary open-update-modal' data-toggle='modal' data-target='#updateProductModal' data-product='".base64_encode(json_encode($product))."'><i class='fas fa-pen' ></i></button></td> ";
            echo "<td><button type='button' class='btn btn-primary open-delete-modal' data-toggle='modal' data-target='#deleteProductModal' data-product-id='".$product['ProductID']."'><i class='fas fa-trash'></i></button</td> ";
            echo "</tr>";
        }
    }


    public function createProductView($name, $price, $discount, $description, $code, $imageName){
      $this->createProduct($name, $price, $discount, $description, $code, $imageName);
    }


    public function updateProductView($id, $name, $price, $discount, $description, $code, $image){
      $this->updateProduct($id, $name, $price, $discount, $description, $code, $image);
    }


    public function deleteProductView($id){
      $this->deleteProduct($id);
    }
}

$manageProductsView = new ManageProductsView();


$page_title = "Admin Panel";
include_once "./assets/layout/header.php";


// ACTIONS 
if($_POST){
  // var_dump($_POST);
  // var_dump($_SESSION);

  if (!empty($_POST['token']) && hash_equals($_SESSION['token'], $_POST['token'])) {
    

   



      switch($_POST['action'])
      {

        case 'createProduct':
          $_SESSION['token'] = bin2hex(random_bytes(32));
            // set product property values from form
            $name = $_POST['name'];
            $price = $_POST['price'];
            $discount = $_POST['discount'];
            $description = $_POST['description'];
            $code = $_POST['code'];
            $image = $_FILES['image'];

            $imageName = $_FILES['image']['name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageSize = $_FILES['image']['size'];
            $imageError = $_FILES['image']['error'];
            $imageType = $_FILES['image']['type'];
          
            $imageExt = explode('.', $imageName);
            $imageActualExt = strtolower(end($imageExt));
            $imageNameNew = uniqid('', true).".".$imageActualExt;


            $allowedImages = array('jpg','jpeg', 'png');

            if(in_array($imageActualExt, $allowedImages)){
              if($imageError === 0){

                if($imageSize < 1000000){
                  $imageDestination = './assets/images/'.$imageNameNew;
                  move_uploaded_file($imageTmpName,$imageDestination);

                }else{
                echo "Your image is too big!";
                }

              }else{
                echo "There was an error uloading your image!";

              }
            }else {
              echo "You cannot upload images of this type! Only jpg, jpeg and png allowed.";
            }

            // create the product
            $manageProductsView->createProductView($name, $price, $discount, $description, $code, $imageNameNew);
        break;


        case 'deleteProduct':
            $id = $_POST['productID'];
            $_SESSION['token'] = bin2hex(random_bytes(32));
            // var_dump($_POST);
            // die();

            $manageProductsView->deleteProductView($id);
        break;


        case 'updateProduct':
          
          $_SESSION['token'] = bin2hex(random_bytes(32));
          $id = $_POST['productID'];
          $name = $_POST['name'];
          $price = $_POST['price'];
          $discount = $_POST['discount'];

          $description = $_POST['description'];
          $code = $_POST['code'];
          
          

          if($_FILES['image']['name'] != ''){
          

            $image = $_FILES['image'];
            $imageName = $_FILES['image']['name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageSize = $_FILES['image']['size'];
            $imageError = $_FILES['image']['error'];
            $imageType = $_FILES['image']['type'];

            $imageExt = explode('.', $imageName);
            $imageActualExt = strtolower(end($imageExt));
            $imageNameNew = uniqid('', true).".".$imageActualExt;
            $allowedImages = array('jpg','jpeg', 'png');
           

            if(in_array($imageActualExt, $allowedImages)){
          

              if($imageError === 0){

                if($imageSize < 1000000){
                  $imageDestination = './assets/images/'.$imageNameNew;
                  move_uploaded_file($imageTmpName,$imageDestination);

                }else{
                echo "Your image is too big!";
                }

              }else{
                echo "There was an error uloading your image!";

              }
            }else {
              echo "You cannot upload images of this type! Only jpg, jpeg and png allowed.";
            }
          }else{
            $imageNameNew = '';
          }
          
      
          
          

          $manageProductsView->updateProductView($id, $name, $price, $discount, $description, $code, $imageNameNew);
        break;
    }
  }

 
 }
// MANAGE PRODUCTS TABLE
echo "
      <div class='row mb-4'>

        <div class='col'>
          <h4><b>Manage Products</b></h4>
        </div>

        <div class='col d-flex justify-content-end'>
          <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#createProductModal'>Create Product</button>  
        </div>

      </div>

      <table class='table table-responsive-sm  table-borderless'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Original Price</th>
                <th>Discount</th>
                <th>Price after Discount</th>
                <th>Code</th>
                <th>Image</th>
                <th></th>
                <th></th>
            </tr>
        </thead>";

$manageProductsView->showProducts();

echo "</table>";


// FOOTER
include_once "./assets/layout/footer.php";
?>




<!-- CREATE PRODUCT ---------------------------------------------------------------------------------------------------------------------------------------------->

<div class="modal fade bd-example-modal-lg" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content p-5">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create new Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="admin-panel" method="post" enctype="multipart/form-data">

          <input type='hidden' name='action' value='createProduct'>
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />

          

        <div class="form-group">
          <label for="name">Product Name</label>
          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name='name' placeholder="Product Name">
          <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group">
          <label for="price">Product Price</label>
          <input type="number" class="form-control" id="price" name='price' placeholder="Price">
        </div>

        <div class="form-group">
          <label  for="discount">Discount</label>
          <div class="input-group ">
            <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount">
            <div class="input-group-prepend">
              <div class="input-group-text">%</div>
            </div>
          </div>
        </div>

        <div class="form-group">
        <label for="description">Product Description</label>
        <textarea class="form-control" id="description" name='description' rows="3"></textarea>
        </div>

        <div class="form-group">
        <label for="code">Product Code</label>
        <input class="form-control" id="code" name='code' rows="3"></input>
        </div>

        <div class="form-group" >
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name='image'>
            <label for="image" class="custom-file-label">Select Product Image (MAX 1MB)</label>
          </div>
        </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div> 
        </form>
      </div>

    </div>
  </div>
</div>




<!-- DELETE PRODUCT -------------------------------------------------------------------------------------------------------------------------------------->

<script>
$(document).on("click", ".open-delete-modal", function() {

    // //get data-id attribute of the clicked element
    // var productID = $(e.relatedTarget).data('product-id');

    // //populate the textbox
    // $(e.currentTarget).find('input[name="productID"]').val(productID);


    var productID = $(this).data('product-id');
     $("#deleteProductModal input[name='productID']").val( productID );
});
</script>

<div class="modal fade " id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteProductModal">Delete Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="admin-panel" method="post">

      <input type='hidden' name='action' value='deleteProduct'>
      <input type='hidden' name='productID'>
      <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />



      <p>Are you sure you want to delete this?</p>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Delete</button>
      </div>
      </form>
      </div>
      
    </div>
  </div>
</div>




<!-- UPDATE PRODUCT -------------------------------------------------------------------------------------------------------------------------------------->

<script>
$(document).on("click", ".open-update-modal", function() {

var productB64 = $(this).data('product');
var productJSON = atob(productB64);
var product = JSON.parse(productJSON);
console.log(product);
console.log(productJSON);
console.log(productB64);

$("#updateProductModal input[name='productID']").val( product.ProductID );
$("#updateProductModal input[name='name']").val( product.Name );
$("#updateProductModal input[name='price']").val( product.Price );
$("#updateProductModal input[name='discount']").val( product.Discount );
$("#updateProductModal textarea[name='description']").val( product.Description );
$("#updateProductModal input[name='code']").val( product.Code );
$("#updateProductModal input[name='image']").val( product.Image );
});
</script>

<div class="modal fade bd-example-modal-lg" id="updateProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content p-5">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="admin-panel" method="post" enctype="multipart/form-data">

          <input type='hidden' name='action' value='updateProduct'>
          <input type='hidden' name='productID'>
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />


        <div class="form-group">
          <label for="name">Product Name</label>
          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name='name' placeholder="Product Name">
          <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group">
          <label for="price">Product Price</label>
          <input type="text" class="form-control" id="price" name='price' placeholder="Price">
        </div>

        <div class="form-group">
          <label for="discount">Discount</label>
          <div class="input-group ">
            <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount">
            <div class="input-group-prepend">
              <div class="input-group-text">%</div>
            </div>
          </div>
        </div>

        <div class="form-group">
        <label for="description">Product Description</label>
        <textarea class="form-control" id="description" name='description' rows="3"></textarea>
        </div>

        <div class="form-group">
        <label for="code">Product Code</label>
        <input type="text" class="form-control" id="code" name='code' rows="3"></input>
        </div>

        <!-- <div class="form-group" >
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name='image'>
            <label for="image" class="custom-file-label">Select Product Image (MAX 1MB)</label>
          </div>
        </div> -->

        <div class="form-group">
          <label for="image">Select Image</label>
          <input type="file" class="form-control-file" id="image" name='image'>
        </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div> 
        </form>
      </div>

    </div>
  </div>
</div>