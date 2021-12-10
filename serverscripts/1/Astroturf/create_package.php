<?php
    require_once '../../dbcon.php';
    require_once '../../Classes/Astroturf.php';

    $description=clean_string($_GET['description']);
    $price=clean_string($_GET['price']);

    $astro=new Astroturf();
    
    $query=$astro->CreatePackage($description,$price);
    echo $query;
 ?>
