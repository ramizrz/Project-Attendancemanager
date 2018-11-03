<?php

    session_start();

    if (isset($_POST['submit'])) {
        
        $year = $_POST['year'];
        $sem = $_POST['sem'];
        $time = $_POST['time'];
        $date = $_POST['date'];

        $errorEmpty = false;
        $errorYear = false;
        $errorSem = false;
        $errortime = false;
        if(empty($year) || empty($sem) || empty($time) || empty($date)){

            echo "Fill in All Field";
            $errorEmpty = true;

        }
        elseif(!(strtoupper($year) == 'F.E' OR strtoupper($year) == 'S.E' OR strtoupper($year) == 'T.E' OR strtoupper($year) == 'B.E')){

            echo "Year is invalid";
            $erroryear = true;

        }
        elseif(!is_numeric($sem)){
            echo "Sem is Invalid";
            $errorSem = true;
        }
        elseif(!is_numeric($slot)){
            echo = "Slot is Invalid";
            $errortime = true;
        }
        else{

            echo "Fill in all field";

        }
        
    }else{

        echo "Something Went Wrong";

    }

?>

<script>

var errorEmpty = "<?php echo $errorEmpty; ?>";
var errorYear = "<?php echo $errorYear; ?>";
var errorSem = "<?php echo $errorSem; ?>";
var errorTime = "<?php echo $errorTime; ?>";

</script>


