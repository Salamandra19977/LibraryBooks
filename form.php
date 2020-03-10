<?php
    require_once "request.class.php";
    require_once "pdo/database.php";
    require_once "getdata.php";
    $requestClass = new Request();
    $objDatabase = new Database();
    if( $requestClass->isPost() )
    {
        $requestClass->required('title');
        $requestClass->required('annotation');
        $requestClass->required('author');
        $requestClass->required('date');
        $requestClass->required('category');
        echo json_encode($requestClass->getErrors());
    }
    if(empty($requestClass->getErrors()))
    {
    	$objDatabase->insert($requestClass->getData());
    	//$objDatabase->update($requestClass->getData(),12);
    }
?>