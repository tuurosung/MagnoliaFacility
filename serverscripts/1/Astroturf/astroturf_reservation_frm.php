<?php
    require_once '../../dbcon.php';
    require_once '../../Classes/Astroturf.php';

    $reservation_name=clean_string($_GET['reservation_name']);
    $email=clean_string($_GET['email']);
    $phone_number=clean_string($_GET['phone_number']);
    $matchday=clean_string($_GET['matchday']);
    $matchtime=clean_string($_GET['matchtime']);
    $notes=clean_string($_GET['notes']);
    $package_id=clean_string($_GET['package_id']);
    $package_price=clean_string($_GET['package_price']);
    $amount_paid=clean_string($_GET['amount_paid']);
    $balance=clean_string($_GET['balance']);

    $astro=new Astroturf();

    $query=$astro->CreateReservation($reservation_name,$email,$phone_number,$matchday,$matchtime,$notes,$package_id,$package_price,$amount_paid,$balance,$date,$timestamp,$user_id);
    echo $query;
 ?>
