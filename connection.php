<?php

    $link = mysqli_connect("localhost", "root", "", "attendance");
        
        if (mysqli_connect_error()) {
            
            die ("Database Connection Error");
            
        }
?>