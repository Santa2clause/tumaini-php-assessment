<?php

    include_once 'dbConnect/dbConnect.php';

    $data = $con->query("SELECT * FROM table_currencies");

    $results = array();
    while($row = $data->fetch()){

        $results[] = array(
            'label' => $row['sLName'],
            'value' => $row['sTicker'],
        );

    }

    $term = $_GET[ "term" ];
    $arrayList = array();
    foreach ($results as $list) {
        $listLabel = $list[ "label" ];
        if ( strpos( strtoupper($listLabel), strtoupper($term) )!== false ) {
            array_push( $arrayList, $list );
        }
    }

    echo json_encode($arrayList);

