<?php
$page_title = "";
include_once 'header.php';
include_once 'config/database.php';
include_once 'config/functions.php';
include_once 'classes/servicesClass.php';
include_once 'config/pagingConfig.php';

$database = new Database();
$db = $database->getConnection();

$services = new Services($db);
$service = $services->readActive();

if (!isAdmin()) {
  $_SESSION['msg'] = "The page you are trying to access requires administrator login!";
  header('location: index.php');
}

if(isset($_GET['deactivateServiceID'])){
  $services->serviceID = $_GET['deactivateServiceID'];
  $services->isArchived = 1 ;
  if($services->deactivateService()){
    header('location: services.php');
  }
}

if(isset($_POST['btnAddService'])){
  $services->serviceName = $_POST['serviceName'];
  $services->serviceCategory = $_POST['serviceCategory'];
  $services->servicePrice =$_POST['servicePrice'];
  $services->isArchived = 0;

  if($services->addService()){
    $_SESSION['modalMsg']="Service Successfully Added!";
    header("refresh:3; services.php");
  }
  else{
    array_push($modalErrors, "Failed to add service!");
  }

}

if(isset($_GET['activateServiceID'])){
	$services->isArchived= 0;
  $services->serviceID = $_GET['activateServiceID'];
  if($services->activateService()){
    header("location: services.php");
  }
}

if(isset($_POST['btnUpdateService'])){
  $services->isArchived=0;
  $services->serviceID = $_POST['UserviceID'];
  $services->servicePrice = $_POST['UservicePrice'];
  $services->serviceName = $_POST['UserviceName'];
  $services->serviceCategory = $_POST['UserviceCategory'];
    if($services->updateService()){
      $_SESSION['success']="Service updated!";
      header("location: services.php");
    }
    else{
      echo "<div class='alert alert-danger'>ERROR UPDATING SERVICE!</div>";
    }
}
?>

<?php if (isset($_SESSION['success'])) : ?>
  <div class="alert alert-success">
    <h5>
      <?php 
        echo $_SESSION['success']; 
        unset($_SESSION['success']);
      ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </h5>

  </div>
<?php endif ?> 

<style>
.nav-pills > .nav-item > .active{
  color:white;
  background-color:#343a40;
  border-radius: 0px;
}
.row > .col-3 > .nav > .active{
  color:white;
  background-color:#343a40;
  border-radius: 0px;
}
.row > .col-3 > .nav > a {
  color:black;
}
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-3 jumbotron-fluid">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Services</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Goods</a>
      </div>
    </div>

    <div class="col-9">
      <div class="tab-content" id="v-pills-tabContent">

      <!--SERVICES TAB-->
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <nav class="navbar navbar-success bg-dark text-white justify-content-between">
            <button data-target="#addServiceModal" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Service</button>
            <h5>Goods and Services</h5>
            <form class="form-inline">
              <input class="form-control mr-sm-2" type="search" placeholder="Search Service..." aria-label="Search" name="searchMember" id="searchService" style="background-image: url('res/search.png');background-repeat: no-repeat;padding: 5px 10px 5px 40px; background-position: 1px 1px;">
            </form>
          </nav><br>

          <table class="table table-striped table-hover table-sm" id="servicesTable">
            <thead>
              <tr class="bg-dark text-white">
                <th>Category</th>
                <th scope="col">Service</th>
                <th scope="col">Unit Price</th>     
                <th colspan="2"><center>Actions</center></th>
              </tr>
            </thead>
            <tbody>
              
              <?php while($rows = $service->fetch(PDO::FETCH_ASSOC)){
                extract($rows);
              ?>        
              <tr>
                <td><?php echo $rows['serviceCategory'];?></td>
                <td><?php echo $rows['serviceName'];?></td>
                <td><?php echo $rows['servicePrice'];?></td>
                <td>
                <?php if($rows['isArchived'] == 0){ ?>
                  <center>
                    <a href="" class="btn btn-primary btn-sm edit-service" data-toggle="modal" data-target="#editModal" data-id="<?php echo $rows['serviceID'];?>" data-name="<?php echo $rows['serviceName'];?>" data-price="<?php echo $rows['servicePrice'];?>" data-category="<?php echo $rows['serviceCategory'];?>"><i class="fas fa-edit"></i> Edit</a>
              
                    <a href="?deactivateServiceID=<?php echo $rows['serviceID'];?>" class="btn btn-secondary btn-sm" onclick="return confirm('Remove the service from the list?')"><i class="fas fa-archive"></i> Archive</a>
                  </center>   <?php }
                else { ?>
                  <center>
                    <a role='button' onclick='return confirm("Activate Selected Service?")' class='btn btn-info btn-sm ' href='?activateServiceID=<?php echo $rows['serviceID'];?>'>Activate</a>
                  </center>

                <?php } ?>
        
                </td>
              </tr> 
              <?php }?>
            </tbody>
          </table>
        </div>

        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...
        </div>
      </div>
    </div>
  </div>
</div>


<!--ADD SERVICE MODAL-->
<div class="modal fade modal bd-example-modal-lg" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Service</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!--modal content-->

        <?php if(isset($_SESSION['modalMsg'])) : ?>
          <div class="alert alert-info">
            <h5><?php echo $_SESSION['modalMsg'];
                      unset($_SESSION['modalMsg']);
              ?>
            </h5>
          </div>
        <?php endif ?>
        <?php echo modalErrors();?>

        <form method="post" action="services.php">
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label>Select Category</label>
              <select required class="form-control" name="serviceCategory">
                <option></option>
                  <?php $serviceCategory = ['F&B', 'Print/Scan', 'Downloads', 'Miscellaneous'];
                  for($i=0;$i<count($serviceCategory);$i++){
                    echo "<option value=".$serviceCategory[$i].">".$serviceCategory[$i]."</option>"; }?>
              </select>
            </div>
            <div class="form-group col-sm-4">
              <label>Service Name</label>
              <input type="text" class="form-control" name="serviceName" required>
            </div>
            <div class="form-group col-sm-4">
              <label>Price</label>
              <input type="text" class="form-control" name="servicePrice" required>
            </div>
          </div>
                
      </div><!--end modal content-->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark" name="btnAddService">Add Service</button>
        </form>
      </div>
    </div>
  </div>
</div> 
<!--END ADD SERVICE MODAL-->

<!--EDIT-->
<div class="modal fade modal bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Service</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"><!--modal content-->

        <form method="post" action="services.php">
          <div class="form-row">
            <div class="form-group col-sm-4">
              <input type="hidden" name="UserviceID" id="serviceID" class="hidden">
              <label>Select Category</label>
              <select class="form-control" name="UserviceCategory" id="category">
                  <?php $serviceCategory = ['F&B', 'Print/Scan', 'Downloads', 'Miscellaneous'];
                  for($i=0;$i<count($serviceCategory);$i++){
                    echo "<option value=".$serviceCategory[$i].">".$serviceCategory[$i]."</option>"; }?>
              </select>
            </div>
            <div class="form-group col-sm-4">
              <label>Service Name</label>
              <input type="text" class="form-control" id="serviceName" name="UserviceName" required>
            </div>
            <div class="form-group col-sm-4">
              <label>Price</label>
              <input type="text" class="form-control" id="servicePrice" name="UservicePrice" required>
            </div>
          </div>
                
      </div><!--end modal content-->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-dark" name="btnUpdateService" >Update Service</button>
        </form>
      </div>
    </div>
  </div>
</div> 
<script>
  $(document).ready(function(){
    $('#editModal').on('show.bs.modal', function (e) {
        var serviceID = $(e.relatedTarget).data('id');
        var serviceName = $(e.relatedTarget).data('name');
        var servicePrice = $(e.relatedTarget).data('price');
        var serviceCategory = $(e.relatedTarget).data('category');

        $('#serviceID').val(serviceID);
        $('#category').val(serviceCategory);
        $('#serviceName').val(serviceName);
        $('#servicePrice').val(servicePrice);
        //Can pass as many onpage values or information to modal  
     });
});

  $(document).ready(function(){
    $('#searchService').on('keyup',function(){
      var searchTerm = $(this).val().toLowerCase();
        $('#servicesTable tbody tr').each(function(){
          var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
              $(this).hide();
            }else{
              $(this).show();
            }
        });
    });
  });

  <?php if(isset($_POST['btnAddService'])){?>
    /* Your (php) way of checking that the form has been submitted */
    $(function() {// On DOM ready
    $('#addServiceModal').modal('show');// Show the modal
    });
  <?php } ?>/* /form has been submitted */

</script>

