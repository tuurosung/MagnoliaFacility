<?php require_once '../navigation/header.php'; ?>
<?php require_once '../navigation/admin_sidebar.php'; ?>

<?php
    $today=date('Y-m-d');
    $ticket=new Ticket();
    $user=new User();

    // unset($_SESSION['ticket_id']);

 ?>

<style media="screen">
  #hero{
    background: url('../images/bg4.jpg');
    background-size: cover;
    background-position: bottom;
  }
</style>
<!--Main layout-->
<main class="pt-5 mx-lg-5">
  <div class="container-fluid mt-5">

    <div class="row mb-4">
      <div class="col-md-6">
          <h1 class="titles">Astroturf Pricing</h1>
      </div>
      <div class="col-md-6 text-right">
        <a href="astroturf.php" type="button" class="btn elegant-color btn-rounded">
          <i class="fas fa-arrow-left mr-2" aria-hidden></i>
          Return
        </a>
        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#astroturf_pricing_modal">
          <i class="fas fa-user-plus mr-2" aria-hidden></i>
          Add Charges
        </button>
      </div>
    </div>



    <div class="mt-5">

      <div class="card mb-3">
        <div class="card-body">
          <div class="row">
            <div class="col-2">
              Package ID
            </div>
            <div class="col-3">
              Package Name
            </div>
            <div class="col-2">
              Date Created
            </div>
            <div class="col-2">
              Created By
            </div>
            <div class="col-2">
              Price
            </div>
            <div class="col-1 text-right">
              Option
            </div>
          </div>

        </div>
      </div>


        <?php
          $get_packges=mysqli_query($db,"SELECT * FROM astroturf_packages WHERE status='active'") or die(mysqli_error($db));
          while ($rows=mysqli_fetch_array($get_packges)) {
            $package_id=$rows['package_id'];
            $user_id=$rows['user_id'];
            $user->user_id=$user_id;
            $user->UserInfo();
            ?>
            <div class="card mb-3" style="font-weight:500">
              <div class="card-body">
                <div class="row">
                  <div class="col-2">
                    <?php echo $rows['package_id']; ?>
                  </div>
                  <div class="col-3">
                    <?php echo $rows['description']; ?>
                  </div>

                  <div class="col-2">
                    <?php echo $rows['date_created']; ?>
                  </div>
                  <div class="col-2">
                    <?php echo $user->fullname; ?>
                  </div>
                  <div class="col-1">
                    <?php echo $rows['price']; ?>
                  </div>
                  <div class="col-2 text-right">
                    <a href="#" class="font-weight-bold edit mr-2" id="<?php echo $rows['ticket_id']; ?>"><i class="fas fa-pencil-alt mr-2" aria-hidden></i>Edit</a>
                    <a href="#" class="font-weight-bold text-danger delete" id="<?php echo $rows['ticket_id']; ?>"><i class="fas fa-trash-alt mr-2" aria-hidden></i>Delete</a>
                  </div>
                </div>

              </div>
            </div>
            <?php
          }
         ?>
    </div>

    <div class="row mb-4 d-none">
      <div class="col-md-6">
          <h1 class="titles">Tickets</h1>
      </div>
      <div class="col-md-6 text-right">
        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#create_ticket_modal">
          <i class="fas fa-user-plus mr-2" aria-hidden></i>
          Create Ticket
        </button>
      </div>
    </div>

    <div class="d-none">
      <?php
          $get_tickets=mysqli_query($db,"SELECT * FROM create_ticket WHERE status='active'") or die(mysqli_error($db));
          while ($rows=mysqli_fetch_array($get_tickets)) {
            ?>
            <div class="card mb-3">
              <div class="card-body">
                <div class="row" style="font-size:16px">
                  <div class="col-2">
                    <p><?php echo $rows['ticket_code']; ?></p>
                    <p class="text-muted">Code</p>
                  </div>
                  <div class="col-6">
                    <p><?php echo $rows['description']; ?></p>
                    <p class="text-muted">Description</p>
                  </div>
                  <div class="col-2 text-right">
                    <p><?php echo $rows['ticket_cost']; ?></p>
                    <p class="text-muted">GHS</p>
                  </div>
                  <div class="col-2 d-flex align-items-center flex-row-reverse">


                    <div class="dropdown open">
                      <a href="#"id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="../images/chevron.png" alt="" style="width:20px">
                      </a>
                      <div class="dropdown-menu p-0 b-0 minioptions" aria-labelledby="dropdownMenu1">
                        <ul class="list-group">
                          <li class="list-group-item"><i class="fas fa-pencil-alt mr-2" aria-hidden></i> Edit</li>
                          <li class="list-group-item"><i class="fas fa-trash-alt mr-2" aria-hidden></i>Delete</li>
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <?php
          }
       ?>
    </div>


  </main>


  <div id="astroturf_pricing_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="astroturf_pricing_frm" autocomplete="off">
        <div class="modal-body p-0">


              <section class="p-5">
                <h5 class="Montserrat font-weight-bold">Astroturf Prices</h>
                <hr class="mb-5" style="border-top:solid 3px #000; width:20%;  margin-left:0px">

                <div class="form-group">
                  <label for="">Package Name</label>
                  <input type="text" class="form-control" name="description" value="" placeholder="" required>
                </div>


                <div class="form-group">
                  <label for="">Price</label>
                  <input type="text" class="form-control" name="price" value="" placeholder="" required>
                </div>

                <div class="text-right mt-5">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-check mr-2"></i> Add Package</button>
                </div>
              </section>


            </div>



        </div>
      </form>
      </div>
    </div>
  </div>

<?php
  require_once '../navigation/footer.php';
 ?>

 <script type="text/javascript">

     $('.sidebar_items').removeClass('active')
     $('#astroturf_nav').addClass('active')

    $('#matchday').datepicker();
    $('#matchday').on('change', function(event) {
      event.preventDefault();
      $(this).datepicker('hide')
    });




   $('#astroturf_pricing_frm').on('submit', function(event) {
     event.preventDefault();
     $.ajax({
       url: '../serverscripts/1/Astroturf/create_package.php',
       type: 'GET',
       data:$('#astroturf_pricing_frm').serialize(),
       success:function(msg){
         if(msg==='save_successful'){
           bootbox.alert('Package Created Successfully',function(){
             window.location.reload()
           })
         }else {
           bootbox.alert(msg)
         }
       }
     })
   });
 </script>
