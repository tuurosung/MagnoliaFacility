<?php
  /**
   * Ticket Class
   */
  class Ticket{

    Public $ticket_id='';
    Public $ticket_code='';

    function __construct(){
      $this->db=mysqli_connect('localhost','shaabd_magnolia','@Tsung3#','shaabd_magnolia') or die('Check Connection');
      $this->today=date('Y-m-d');
      $this->timestamp=time();
      session_start();
      $this->active_user=$_SESSION['active_user'];
    }

    function TicketCodeGen(){
      $count=mysqli_query($this->db,"SELECT COUNT(*) AS count FROM create_ticket") or die(mysqli_error($this->db));
      $count=mysqli_fetch_array($count);
      $count=++$count['count'];
      return 'T'.prefix($count).''.$count;
    }

    function TicketIdGen($length=12){
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    function TicketInfo(){
      $query=mysqli_query($this->db,"SELECT * FROM create_ticket WHERE ticket_code='".$this->ticket_code."'") or die(mysqli_error($this->db));
      $ticket_info=mysqli_fetch_array($query);
      $this->description=$ticket_info['description'];
      $this->ticket_cost=$ticket_info['ticket_cost'];
    }


    function CreateTicket($description,$ticket_cost,$validity,$threshold,$qty){
      $ticket_code=$this->TicketCodeGen();
      $check_exists=mysqli_query($this->db,"SELECT *
                                                                      FROM create_ticket
                                                                      WHERE
                                                                          ticket_code='".$ticket_code."'") or die(mysqli_error($this->db));
      if(mysqli_num_rows($check_exists) > 0){
        return 'Ticket Created Already';
      }else {
        $table='create_ticket';
        $fields=array("ticket_code","description","ticket_cost","validity","threshold","qty","date_created","timestamp");
        $values=array("$ticket_code","$description","$ticket_cost","$validity","$threshold","$qty","$this->today","$this->timestamp");
        $query=insert_data($this->db,$table,$fields,$values);
        return $query;
      }
    }//end create ticket


    function AddTicketToCart($ticket_id,$ticket_code,$ticket_cost,$qty,$total,$validity_date){

      $check=mysqli_query($this->db,"SELECT * FROM tickets WHERE ticket_id='".$ticket_id."' AND ticket_code='".$ticket_code."' AND status='cart'") or die(mysqli_error($this->db));
      if(mysqli_num_rows($check)>0){
        return 'Ticket Added Already';
      }else {
        $table='tickets';
        $fields=array("ticket_id","ticket_code","ticket_cost","qty","total","date_created","timestamp","validity_date","status");
        $values=array("$ticket_id","$ticket_code","$ticket_cost","$qty","$total","$this->today","$this->timestamp","$validity_date","cart");
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
        $fields=array("fullname","phone_number","email","ticket_id","cart_sum","amount_paid","balance","payment_account","timestamp","date","status","user_id");
        $values=array("$fullname","$phone_number","$email","$ticket_id","$cart_sum","$amount_paid","$balance","$payment_account","$this->timestamp","$this->today","active","$this->active_user");
        $query=insert_data($this->db,$table,$fields,$values);
        if($query=='save_successful'){
          $validate_tickets=mysqli_query($this->db,"UPDATE tickets SET status='valid' WHERE ticket_id='".$ticket_id."'") or die(mysqli_error($this->db));
          $_SESSION['print_this_ticket']=$ticket_id;
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



    function TicketRevenue($start,$end){
      $query=mysqli_query($this->db,"SELECT SUM(amount_paid-balance) as total_revenue
                                                          FROM ticket_checkout
                                                          WHERE date BETWEEN '".$start."' AND '".$end."'
                                                          AND status='active'
                                    ") or die(mysqli_error($this->db));
      $info=mysqli_fetch_array($query);
      return $info['total_revenue'];
    }

    function TicketSold($start,$end){
      $query=mysqli_query($this->db,"SELECT SUM(qty) as tickets_sold FROM tickets
                                                          WHERE date_created BETWEEN '".$start."' AND '".$end."'
                            ") or die(mysqli_error($this->db));

      $info=mysqli_fetch_array($query);
      return $info['tickets_sold'];
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
