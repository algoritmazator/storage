<?php

    $connect = mysqli_connect('localhost', 'lenapisano', 'Passworddlabd1', 'lenapisano');

    if (!$connect) {
        die('Error connect to DataBase');
    }