<?php
    
    
    
    function status($state){

    $pending = "\"btn btn-warning btn-xs\"";
    $approved = "\"btn btn-success btn-xs\"";
    $rejected = "\"btn btn-danger btn-xs\"";

    $status = $state;

    if(($status == "Approved") or ($status == "approved")){
    echo $approved;
    }

    elseif(($status == "Rejected") or ($status == "rejected")){
    echo $rejected;
    }

    else{
    echo $pending;
    }
    return $state;
    }


    function status1($state){

    $pending = "\"btn btn-warning btn-xs\"";
    $approved = "\"btn btn-success btn-xs\"";
    $rejected = "\"btn btn-danger btn-xs\"";

    $status = $state;

    if(($status == "Approved") || ($status == "approved")){
    echo $approved;
    }

    elseif(($status == "Rejected") || ($status == "rejected")){
    echo $rejected;
    }

    else{
    echo $pending;
    }
    return $state;
    }

    function getAllowance($status){

    if($status == 1){
    echo "YES";
    }

    else{
    echo  "*";
    }
    }