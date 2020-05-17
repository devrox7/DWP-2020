<?php
include_once './Controllers/About.controller.php';

class ManageDetailsView extends AboutController
{
    public $info;

    function __construct(){
        $this->info = $this->getCompanyInfo();
    }

    public function getCompanyInfo()
    {
        return $this->getInfo() [0];
    }

    public function updateDetailsView($name, $description, $openingHours, $contactInfo, $address){
        $this->updateDetails($name, $description, $openingHours, $contactInfo, $address);

        $this->info = $this->getCompanyInfo();
      }
  

}

$detailsView = new ManageDetailsView();

if($_POST && $_POST['action'] == 'updateDetails')
{


    if (!empty($_POST['token']) && hash_equals($_SESSION['token'], $_POST['token'])) 
    {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    
        $name = $_POST['name'];
        $description = $_POST['description'];
        $openingHours = $_POST['openingHours'];
        $contactInfo = $_POST['contactInfo'];
        $address = $_POST['address'];


        $detailsView->updateDetailsView($name, $description, $openingHours, $contactInfo, $address);

    }

}



echo"
<div class='row mb-4'>
        <div class='col'>
          <h4><b>Manage Company Details</b></h4>
        </div>

        <div class='col'>
          <div class='d-flex justify-content-end'>
            <button type='button' class='btn btn-primary open-company-modal' data-toggle='modal' data-target='#updateDetailsModal' data-info='".base64_encode(json_encode($detailsView->info))."'>Update Details</button>
          </div>
        </div>
</div>
";




?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>


$(document).on("click", ".open-company-modal", function() {
console.log($(this))
var infoB64 = $(this).data('info');
var infoJSON = atob(infoB64);
var info = JSON.parse(infoJSON);
console.log(info);
console.log(infoJSON);
console.log(infoB64);


$("#updateDetailsModal input[name='name']").val( info.Name );
$("#updateDetailsModal textarea[name='description']").val( info.Description );
$("#updateDetailsModal input[name='openingHours']").val(info.OpeningHours );
$("#updateDetailsModal input[name='contactInfo']").val( info.ContactInfo);
$("#updateDetailsModal input[name='address']").val(info.Address);
});
</script>

<div class="modal fade bd-example-modal-lg" id="updateDetailsModal" tabindex="-1" role="dialog" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content p-5">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Company Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action='' method="post">

          <input type='hidden' name='action' value='updateDetails'>
          <!-- <input type='hidden' name='productID'> -->
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />


        <div class="form-group">
          <label for="name">Company Name</label>
          <input type="text" class="form-control" id="name" name='name' >
          
        </div>

        <div class="form-group">
        <label for="description">Company Description</label>
        <textarea class="form-control" id="description" name='description' rows="3"></textarea>
        </div>

        <div class="form-group">
          <label for="price">Opening Hours</label>
          <input type="text" class="form-control" id="openingHours" name='openingHours' >
        </div>

        <div class="form-group">
          <label for="price">Contact Info</label>
          <input type="text" class="form-control" id="contactInfo" name='contactInfo' >
        </div>

        <div class="form-group">
        <label for="code">Address</label>
        <input type="text" class="form-control" id="address" name='address' rows="3"></input>
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