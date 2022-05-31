<?php

    //Connection
    include_once '../dbConnect/dbConnect.php';

    //Request Type
    if($_POST['typeRequest'] == 'add'){

        $tickerVal = trim($_POST['tickerVal']);
        $number = rand(10,1000);

        //Verify Exists
        $data = $con->query("SELECT * FROM table_currencies WHERE sTicker = '$tickerVal'");
        if($data->rowCount() > 0){
            $verifyExist = $con->query("SELECT * FROM table_user_watchlist WHERE sTicker = '$tickerVal'");
            if($verifyExist->rowCount() > 0){
                echo 'Pair already exists on watchlist';
            }else{
                $con->query("INSERT INTO table_user_watchlist (sTicker, sValue) VALUES ('$tickerVal','$number') ");
                echo 'Successfully Added';
            }
        }else{
            echo "Pair not exists";
        }


    }elseif($_POST['typeRequest'] == 'edit'){

        $ticker = trim($_POST['ticker']);
        $tickerVal = trim($_POST['tickerVal']);
        $userId = 1;

        $update = $con->query("UPDATE table_user_watchlist SET sValue='$tickerVal' WHERE sTicker='$ticker' AND user_id=1");
        if($update){
            echo 'Successfully Edited';
        }else{
            echo 'Something went wrong, please try again';
        }

    }elseif($_POST['typeRequest'] == 'remove'){

        $ticker = trim($_POST['ticker']);
        $userId = 1;

        $remove = $con->query("DELETE FROM table_user_watchlist WHERE sTicker='$ticker' AND user_id=1");
        if($remove){
            echo 'Successfully Removed';
        }else{
            echo 'Something went wrong, please try again';
        }

    }
