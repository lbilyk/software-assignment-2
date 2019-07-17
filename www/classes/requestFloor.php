<?php 

    require_once __DIR__ . '/queue.php';
    require_once __DIR__ . '/node.php';
    
   
    //$nodeVal = $_POST["floor"];

    $newNode = new Node(1);
    //$newNode = new Node($nodeVal);

    $newNode->requestFloor();

?>