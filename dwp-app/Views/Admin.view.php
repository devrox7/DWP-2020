<?php
include_once './Controllers/Product.controller.php';


class AdminView extends ProductController
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

    public function createProductView($name, $price, $discount, $description, $code, $image){
      $this->createProduct($name, $price, $discount, $description, $code, $image);
    }

    public function updateProductView($name, $price, $discount, $description, $code, $image){
      $this->updateProduct($name, $price, $discount, $description, $code, $image);
    }

    public function deleteProductView($id){
      $this->deleteProduct($id);
    }
}


$adminView = new AdminView();


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
            $image = $_POST['image'];
          
            // create the product
            $adminView->createProductView($name, $price, $discount, $description, $code, $image);
        break;


        case 'deleteProduct':
            $id = $_POST['productID'];
            $_SESSION['token'] = bin2hex(random_bytes(32));
            // var_dump($_POST);
            // die();

            $adminView->deleteProductView($id);
        break;


        case 'updateProduct':
          $_SESSION['token'] = bin2hex(random_bytes(32));
          $id = $_POST['productID'];
          $name = $_POST['name'];
          $price = $_POST['price'];
          $discount = $_POST['discount'];

          $description = $_POST['description'];
          $code = $_POST['code'];
          $image = $_POST['image'];

          // var_dump($_POST);
          // die();

          $adminView->updateProductView($name, $price, $discount, $description, $code, $image);
        break;
    }
  }

 
 }
// MANAGE PRODUCTS TABLE
echo "
<div class='content-container m-2 mt-3 mb-5'>

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

$adminView->showProducts();

echo "</table>
      </div>";


// MANAGE ORDERS TABLE
echo "
<div class='content-container  m-2 mb-5'>
      <div class='row mb-4'>
        <div class='col'>
          <h4><b>Manage Orders</b></h4>
        </div>
      </div>
      <p>Work in progress</p>
  </div>";


// MANAGE COMPANY DETAILS TABLE
echo "
<div class='content-container m-2 mb-5'>
      <div class='row mb-4'>
        <div class='col'>
          <h4><b>Manage Company Details</b></h4>
        </div>
        ";include './Views/ManageDetails.view.php'; echo " 
      </div>
    
</div>";


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
        <form action="admin-panel" method="post">

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
            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Discount">
            <div class="input-group-prepend">
              <div class="input-group-text">%</div>
            </div>
          </div>
        </div>

        <div class="form-group">
        <label for="description">Product Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name='description' rows="3"></textarea>
        </div>

        <div class="form-group">
        <label for="code">Product Code</label>
        <input class="form-control" id="code" name='code' rows="3"></input>
        </div>

        <div class="form-group" >
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name='image'>
            <label for="image" class="custom-file-label">Select Product Image...</label>
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
        <form action="admin-panel" method="post">

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
            <input type="text" class="form-control" id="discount" placeholder="Discount">
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

        <!-- <div class='form-group'>
        <label for="code">Current Image</label>
        <input type="text" class="form-control" disabled name="image" id="image" placeholder='image'>
        </div> -->

        <div class="form-group" >
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name='image'>
            <label for="image" class="custom-file-label">Select Product Image...</label>
          </div>
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