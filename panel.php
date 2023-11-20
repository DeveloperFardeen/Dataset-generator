<?php 
    session_start();
    if (!isset($_SESSION['AdminLoginId'])) {
       header("location: login.php");
    }
    require('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <!-- Page Header -->
    <div class="header">
        <h1><?php echo $_SESSION['AdminLoginId'] ?></h1>
        <form action="" method="POST">
            <button name="logOut">LOG OUT</button>
        </form>
    </div>

    

    <?php
        if (isset($_POST['logOut'])) {
            session_destroy();
            header("location: login.php");
        }

        # ========================
        $sql = "SELECT SUM(total_members) AS totalPopulation, SUM(teens) AS totalTeens, SUM(females) AS totalFemales, SUM(present_members) AS totalPresent, SUM(working_hands) AS totalWorking, SUM(jobless) AS totalJobless, SUM(nonvoter) AS totalNonVoter FROM `survey_nov23` WHERE `seperator`='fdmm1';";
        $rst = $conn->query($sql);
        $row = $rst->fetch_assoc();

        if ($rst->num_rows > 0) {
            echo "<br><br>";
            echo "Total Population: " . $row['totalPopulation'] . "<br><be>";
            echo "Total adults: " . ($row['totalPopulation'] - $row['totalTeens']). "<br>";
            echo "Total Teens: " . $row['totalTeens'] . "<br><br>";
            echo "Total males: " . $row['totalPopulation'] - $row['totalFemales'] . "<br>";
            echo "Total Females: " . $row['totalFemales'] . "<br><br>";
            echo "Total Present: " . $row['totalPresent'] . "<br>";
            echo "Total absent: " . $row['totalPopulation'] - $row['totalPresent'] . "<br><br>";
            echo "Total Working Hands: " . $row['totalWorking'] . "<br>";
            echo "Total Jobless: " . $row['totalJobless'] . "<br><br>";
            echo "Total Voter: " . $row['totalPopulation'] - $row['totalNonVoter']. "<br>";
            echo "Total Non-Voter: " . $row['totalNonVoter'] . "<br><br><hr>";
            echo "Kashif bhai";
        } else {
             echo "0 results";
        }

        # ========================

       /* $sql2 = "SELECT COUNT(*) AS lv1 FROM survey_nov23 WHERE seperator='fdmm1' AND income='50,000 - 1,00,000';";
        $sql3 = "SELECT COUNT(*) AS lv2 FROM survey_nov23 WHERE seperator='fdmm1' AND income='1,00,000 - 2,00,000';";
        $sql4 = "SELECT COUNT(*) AS lv3 FROM survey_nov23 WHERE seperator='fdmm1' AND income='2,00,000 - 3,00,000';";

        for ($x=1; $x < 3; $x++) { 
            $rst$x = $conn->query($sql$x);
            $row$x = $rst$x->fetch_assoc();
            echo "lv$x: ".$row$x['lv$x']."<br>";            
        }
        */

        # ========================
    /*    $sql = "SELECT * FROM `survey_nov23` WHERE `seperator`='fdmm1';";
        $rst = $conn->query($sql);
        $numRow = $rst->num_rows;
        echo $numRow.'<br>';

        if ($numRow > 0) {
            $total = 0;
            $totalPopulation = 0;
            $totalTeens = 0;
            $totalFemales = 0;
            $totalPresent = 0;
            $totalWorking = 0;
            $totalJobless = 0;
            $totalNonVoter = 0;

            while($row = $rst->fetch_assoc()) {
                $totalPopulation += $row['total_members'];
                $totalTeens += $row['teens'];
                $totalFemales += $row['females'];
                $totalPresent += $row['present_members'];
                $totalWorking += $row['working_hands'];
                $totalJobless += $row['jobless'];
                $totalNonVoter += $row['nonvoter'];                
            }
            echo "Total Population: " . $totalPopulation . "<br>";
            echo "Total Teens: " . $totalTeens . "<br>";
            echo "Total Females: " . $totalFemales . "<br>";
            echo "Total Present: " . $totalPresent . "<br>";
            echo "Total Working Hands: " . $totalWorking . "<br>";
            echo "Total Jobless: " . $totalJobless . "<br>";
            echo "Total Non-Voter: " . $totalNonVoter . "<br>";

        } else {
            echo "0 results";
        }*/
    ?>
    
    <div class="container">
        <div class="col">
            <canvas id="voterPie"></canvas>
        </div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
    </div>

</body>
</html>