<?php
  /**
   * Ticket Class
   */
  class Astroturf{

    Public $reservation_id='';

    function __construct(){
      $this->db=mysqli_connect('localhost','shaabd_magnolia','@Tsung3#','shaabd_magnolia') or die('Check Connection');
      $this->today=date('Y-m-d');
      $this->timestamp=time();
      session_start();
      $this->active_user=$_SESSION['active_user'];
    }

    function ReservationIdGen(){
      $count=mysqli_query($this->db,"SELECT COUNT(*) AS count FROM astroturf_bookings") or die(mysqli_error($this->db));
      $count=mysqli_fetch_array($count);
      $count=++$count['count'];
      return 'ASTRO-'.prefix($count).''.$count;
    }

    // function PackageIdGen($length=6){
    //     $characters = '0123456789';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    //     return $randomString;
    // }
    function PackageIdGen(){
      $count=mysqli_query($this->db,"SELECT COUNT(*) AS count FROM astroturf_packages") or die(mysqli_error($this->db));
      $count=mysqli_fetch_array($count);
      $count=++$count['count'];
      return 'PACKAGE-'.prefix($count).''.$count;
    }


    function PackageInfo(){
      $query=mysqli_query($this->db,"SELECT * FROM astroturf_packages WHERE package_id='".$this->package_id."'") or die(mysqli_error($this->db));
      $package_info=mysqli_fetch_array($query);
      $this->description=$package_info['description'];
      $this->price=$package_info['price'];
    }


    function CreatePackage($description,$price){
      $package_id=$this->PackageIdGen();
      $check_exists=mysqli_query($this->db,"SELECT *
                                                                      FROM astroturf_packages
                                                                      WHERE
                                                                          package_id='".$package_id."'") or die(mysqli_error($this->db));
      if(mysqli_num_rows($check_exists) > 0){
        return 'Package Created Already';
      }else {
        $table='astroturf_packages';
        $fields=array("package_id","description","price","date_created","timestamp","user_id");
        $values=array("$package_id","$description","$price","$this->today","$this->timestamp","$this->active_user");
        $query=insert_data($this->db,$table,$fields,$values);
        return $query;
      }
    }//end create package


    function CreateReservation($reservation_name,$email,$phone_number,$matchday,$matchtime,$notes,$package_id,$package_price,$amount_paid,$balance,$date,$timestamp,$user_id){
      $booking_id=$this->ReservationIdGen();
      $check=mysqli_query($this->db,"SELECT * FROM astroturf_bookings WHERE booking_id='".$booking_id."'") or die(mysqli_error($this->db));
      if(mysqli_num_rows($check)>0){
        return 'Booking Exists';
      }else {
        $table='astroturf_bookings';
        $fields=array("booking_id","reservation_name","email","phone_number","match_date","match_time","notes","package_id","package_price","amount_paid","balance","date","timestamp","user_id");
        $values=array("$booking_id","$reservation_name","$email","$phone_number","$matchday","$matchtime","$notes","$package_id","$package_price","$amount_paid","$balance","$this->today","$this->timestamp","$this->active_user");
        $query=insert_data($this->db,$table,$fields,$values);
        return $query;
      }

    }

    function TicketCartInfo(){
      $query=mysqli_query($this->db,"SELECT SUM(total) as cart_sum FROM tickets WHERE ticket_id='".$this->ticket_id."' AND status='cart'") or die(mysqli_error($this->db));
      $cart_sum=mysqli_fetch_array($query);
      $this->cart_sum=$cart_sum['cart_sum'];
    }

    function TicketCheckout($fullname,$phone_number,$email,$ticket_id,$cart_sum,$amount_paid,$balance,$payment_account){
      $check=mysqli_query($this->db,"SELECT * FROM ticket_checkout WHERE ticket_id='".$ticket_id."'") or die(mysqli_error($this->db));
      if(mysqli_num_rows($check)>0){
        return 'Cart Expired';
      }else {
        $table='ticket_checkout';
        $fields=array("fullname","phone_number","email","ticket_id","cart_sum","amount_paid","balance","payment_account","timestamp","date","status");
        $values=array("$fullname","$phone_number","$email","$ticket_id","$cart_sum","$amount_paid","$balance","$payment_account","$this->timestamp","$this->today","active");
        $query=insert_data($this->db,$table,$fields,$values);
        if($query=='save_successful'){
          $validate_tickets=mysqli_query($this->db,"UPDATE tickets SET status='valid' WHERE ticket_id='".$ticket_id."'") or die(mysqli_error($this->db));
          unset($_SESSION['ticket_id']);
          return 'checkout_successful';
        }else {
          return 'Unable to checkout';
        }
      }
    }


    function ReservationInfo(){
      $query=mysqli_query($this->db,"SELECT * FROM ticket_checkout WHERE ticket_id='".$this->ticket_id."'") or die(mysqli_error($this->db));
      if(mysqli_num_rows($query) !=1){
        $this->ticket_validity='Invalid';
      }else {
        $info=mysqli_fetch_array($query);
        $this->ticket_validity=$info['ticket_id'];

        if($info['status']=='Expired'){
          $this->ticket_validity='Expired';
        }elseif ($info['status']=='active') {
          $this->ticket_validity='Valid';
        }

        $this->fullname=$info['fullname'];
        $this->phone_number=$info['phone_number'];
        $this->reservation_date=$info['date'];
        $this->cart_sum=$info['cart_sum'];
        $this->amount_paid=$info['amount_paid'];
        $this->balance=$info['balance'];
        $this->reservation_status=$info['status'];
      }
    }



    function AstroturfRevenue($start,$end){
      $query=mysqli_query($this->db,"SELECT SUM(amount_paid-balance) as total_revenue
                                                          FROM astroturf_bookings
                                                          WHERE date BETWEEN '".$start."' AND '".$end."'
                                                          AND status='active'
                                    ") or die(mysqli_error($this->db));
      $info=mysqli_fetch_array($query);
      return $info['total_revenue'];
    }

    function AstroturfBookings($start,$end){
      $query=mysqli_query($this->db,"SELECT COUNT(*) as bookings FROM astroturf_bookings
                                                          WHERE match_date BETWEEN '".$start."' AND '".$end."'
                            ") or die(mysqli_error($this->db));

      $info=mysqli_fetch_array($query);
      return $info['bookings'];
    }


    function Checkin($ticket_id,$ticket_code){
      $query=mysqli_query($this->db,"UPDATE tickets
                                                          SET
                                                              status='checkin',
                                                              checkin_timestamp='".$this->timestamp."',
                                                              checkin_count=checkin_count+1
                                                          WHERE
                                                            ticket_id='".$ticket_id."' AND ticket_code='".$ticket_code."'
                                        ") or die(mysqli_error($this->db));
        if(mysqli_affected_rows($this->db)==1){
          return 'Check-in Successful';
        }else {
          return 'Check-in Failed';
        }
    }
  }

 ?>
