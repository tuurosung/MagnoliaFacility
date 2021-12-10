<?php require_once '../navigation/header.php'; ?>
<?php require_once '../navigation/admin_sidebar.php'; ?>

<?php
    $today=date('Y-m-d');
    $astro=new Astroturf();

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
          <h1 class="titles">Astroturf Reservation</h1>
      </div>
      <div class="col-md-6 text-right">
        <a href="astroturf_config.php" type="button" class="btn elegant-color btn-rounded" >
          <i class="fas fa-wrench mr-2" aria-hidden></i>
          Set Prices
        </a>
        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#astroturf_reservation_modal">
          <i class="fas fa-user-plus mr-2" aria-hidden></i>
          New Reservation
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <p class="big-text"><?php echo $astro->AstroturfBookings($today,$today); ?></p>
                Today's Matches
              </div>
              <div class="col-4">
                <div class="icon-box d-flex justify-content-center align-items-center primary-color-dark">
                    <i class="fas fa-ticket-alt" aria-hidden></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <p class="big-text">GHS <?php echo $astro->AstroturfRevenue($today,$today); ?></p>
                Revenue Generated
              </div>
              <div class="col-4">
                <div class="icon-box d-flex justify-content-center align-items-center primary-color-dark">
                    <i class="fas fa-credit-card" aria-hidden></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">

      </div>
      <div class="col-md-3">

      </div>
    </div>



    <div class="mt-5">

      <div class="card mb-3">
        <div class="card-body">
          <div class="row">
            <div class="col-1">
              Date
            </div>
            <div class="col-1">
              Booking #
            </div>
            <div class="col-3">
              Reservation Name
            </div>
            <div class="col-1">
              Phone #
            </div>
            <div class="col-2 text-right">
              Cost
            </div>
            <div class="col-1 text-right">
              Paid
            </div>
            <div class="col-1 text-right">
              Balance
            </div>
            <div class="col-2 text-right">
              Option
            </div>
          </div>

        </div>
      </div>


        <?php
          $get_bookings=mysqli_query($db,"SELECT * FROM astroturf_bookings WHERE status='active'") or die(mysqli_error($db));
          while ($rows=mysqli_fetch_array($get_bookings)) {
            $booking_id=$rows['booking_id'];
            ?>
            <div class="card mb-3" style="font-weight:500">
              <div class="card-body">
                <div class="row">
                  <div class="col-1">
                    <?php echo $rows['date']; ?>
                  </div>
                  <div class="col-1">
                    <?php echo $rows['booking_id']; ?>
                  </div>
                  <div class="col-3">
                    <?php echo $rows['reservation_name']; ?>
                  </div>
                  <div class="col-1 ">
                    <?php echo $rows['phone_number']; ?>
                  </div>
                  <div class="col-2 text-right">
                    <?php echo $rows['package_price']; ?>
                  </div>
                  <div class="col-1 text-right">
                    <?php echo $rows['amount_paid']; ?>
                  </div>
                  <div class="col-1 text-right">
                    <?php echo $rows['balance']; ?>
                  </div>
                  <div class="col-2 text-right">
                    <a href="#" class="mr-2" id="<?php echo $rows['ticket_id']; ?>" onclick="window.open('ticketprint.php?ticket_id=<?php echo $rows['ticket_id']; ?>','_blank','width=400')"><i class="fas fa-print mr-2" aria-hidden></i> Print</a>
                    <a href="#" class="edit mr-2" id="<?php echo $rows['ticket_id']; ?>" ><i class="fas fa-pencil-alt mr-2" aria-hidden></i>Edit</a>
                    <a href="#" class="delete text-danger" id="<?php echo $rows['ticket_id']; ?>" ><i class="fas fa-trash-alt mr-2" aria-hidden></i>Delete</a>
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


  <div id="astroturf_reservation_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:1200px !important">
      <div class="modal-content">
        <form id="astroturf_reservation_frm" autocomplete="off">
        <div class="modal-body p-0">



          <div class="row" style="margin-right:0px">
            <div class="col-8">


              <section class="p-5">
                <h5 class="Montserrat font-weight-bold">Astroturf Reservation</h>
                <hr class="mb-5" style="border-top:solid 3px #000; width:20%;  margin-left:0px">

                <div class="form-group">
                  <label for="">Reservation Name</label>
                  <input type="text" class="form-control" name="reservation_name" value="" placeholder="" required>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="email" class="form-control" name="email" value="" placeholder="">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Phone Number</label>
                      <input type="text" class="form-control" name="phone_number" value="" placeholder="" required>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Match Day</label>
                      <input type="text" class="form-control datepicker" name="matchday" id="matchday" value="<?php echo date('Y-m-d'); ?>" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Match Time</label>
                      <input type="time" class="form-control" name="matchtime" value="" placeholder="" required>
                    </div>
                  </div>
                </div>



                <div class="form-group">
                  <label for="">Notes</label>
                  <input type="text" class="form-control" name="notes" value="" placeholder="" required>
                </div>
              </section>







            </div>
            <div class="col-4 primary-color white-text">
              <section class="py-5 px-3">
                <h5 class="font-weight-bold Montserrat">Billing Details</h5>
                <hr class="mb-5" style="border-top:solid 3px #fff; width:20%;  margin-left:0px">

                <div class="form-group">
                  <label for="">Package</label>
                  <select class="custom-select browser-default" name="package_id" id="package_id">
                    <option value="">-----</option>
                    <?php
                      $query=mysqli_query($db,"SELECT * FROM astroturf_packages WHERE status='active'") or die(mysqli_error($db));
                      while ($rows=mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $rows['package_id']; ?>" data-package_price="<?php echo $rows['price']; ?>"><?php echo $rows['description']; ?> - GHS <?php echo $rows['price']; ?></option>
                        <?php
                      }
                     ?>
                  </select>
                </div>

                <div class="form-group d-none">
                  <label for="">Package Price</label>
                  <input type="text" class="form-control" name="package_price" id="package_price" value="" placeholder="" required>
                </div>

                <div class="form-group">
                  <label for="">Amount Paid</label>
                  <input type="text" class="form-control" name="amount_paid" id="amount_paid" value="" placeholder="" required>
                </div>

                <div class="form-group">
                  <label for="">Balance Remaining</label>
                  <input type="text" class="form-control" name="balance" id="balance" value="" placeholder="" required readonly>
                </div>

                <button type="submit" class="btn btn-white wide mt-4 Montserrat" style="font-size:14px"><i class="fas fa-check mr-2" aria-hidden></i> Create Reservation</button>
              </section>


            </div>
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

    $('#package_id').on('change', function(event) {
      event.preventDefault();
      var package_price= $(this).find(':selected').data('package_price')
      $('#package_price,#balance').val(package_price)
    });

    $('#amount_paid').on('keyup', function(event) {
      event.preventDefault();
      var amount_paid=parseFloat($('#amount_paid').val())
      var package_price=parseFloat($('#package_price').val())
      $('#balance').val((package_price-amount_paid).toFixed(2))
    });




   $('#astroturf_reservation_frm').on('submit', function(event) {
     event.preventDefault();
     $.ajax({
       url: '../serverscripts/1/Astroturf/astroturf_reservation_frm.php',
       type: 'GET',
       data:$('#astroturf_reservation_frm').serialize(),
       success:function(msg){
         if(msg==='save_successful'){
           bootbox.alert('Reservation Successful',function(){
             window.location.reload()
           })
         }else {
           bootbox.alert(msg)
         }
       }
     })
   });
 </script>
