<?php
session_start();
    if(isset($_SESSION['ID']))
    {

        require_once 'conn.php';

        $ID = rand(10000,1000000);
        $roomID = rand(1000,10000);
        $createrID = $_SESSION['ID'];
        $p1 = $_SESSION['ID'];

        $sql = "INSERT INTO games (ID, createrID, roomID, p1) VALUES (?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) 
        {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        mysqli_set_charset($conn, "utf8");
        mysqli_stmt_bind_param($stmt, "ssss", $ID, $createrID, $roomID, $p1);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: ../game_lobby?room_id=$roomID");
        exit();

    }
    else
    {
        header("Location: login.php");
    }