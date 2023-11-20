<?php
// Replace these variables with your actual database credentials
$servername = "your_mysql_host";
$username = "your_mysql_username";
$password = "your_mysql_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the survey_data table
$sql = "SELECT * FROM survey_data";
$result = $conn->query($sql);

/* =======================

Number of doctor
$sql = "SELECT * FROM `survey_nov23` WHERE `seperator`='fdmm1';";
$rst = $conn->query($sql);

INSERT INTO `survey_nov23` (`sno`, `guardian`, `total_members`, `present_members`, `females`, `teens`, `working_hands`, `jobless`, `income`, `income_source`, `nonvoter`, `eco_class`, `address`, `mob_num`, `dt`, `seperator`) VALUES (NULL, 'Ujwal Kumar', '5', '3', '1', '0', '2', '2', 'govt. job', '2,00,000 - 3,00,000', '2', 'middle class', 'Bhagalpur', '12345678901', current_timestamp(), 'fdmm1');

   ======================= */

/* =======================
$sql = "SELECT SUM(total_members) AS totalPopulation, SUM(teens) AS totalTeens, SUM(females) AS totalFemales, SUM(present_members) AS totalPresent, SUM(working_hands) AS totalWorking, SUM(jobless) AS totalJobless, SUM(nonvoter) AS totalNonVoter FROM `survey` WHERE `seperator`='khf7332j';";
$rst = $conn->query($sql);
$row = $rst->fetch_assoc();

if ($rst->num_rows > 0) {
  echo "Total Population: " . $row['totalPopulation'] . "<br>";
  echo "Total Teens: " . $row['totalTeens'] . "<br>";
  echo "Total Females: " . $row['totalFemales'] . "<br>";
  echo "Total Present: " . $row['totalPresent'] . "<br>";
  echo "Total Working Hands: " . $row['totalWorking'] . "<br>";
  echo "Total Jobless: " . $row['totalJobless'] . "<br>";
  echo "Total Non-Voter: " . $row['totalNonVoter'] . "<br>";
} else {
  echo "0 results";
}
write the code to echo number of families having different income.

   ======================= */

if ($result->num_rows > 0) {
    // Initialize variables for summary statistics
    $totalMen = 0;
    $totalTeens = 0;
    $totalWorkingHands = 0;
    $totalNonWorkingHands = 0;
    $economicClassCount = array(); // Count for each economic class
    $areaVoterIdCount = array(); // Count for each area's people without voter ID

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Access individual data fields like $row['head_member_name'], $row['num_men'], etc.
        echo "Head Member Name: " . $row['head_member_name'] . "<br>";
        echo "Number of Men: " . $row['num_men'] . "<br>";
        echo "Number of Teens: " . $row['num_teens'] . "<br>";
        echo "Working Hands: " . $row['working_hands'] . "<br>";
        echo "Total Members: " . $row['total_members'] . "<br>";

        // Calculate summary statistics
        $totalMen += $row['num_men'];
        $totalTeens += $row['num_teens'];
        $totalWorkingHands += $row['working_hands'];
        $totalNonWorkingHands += ($row['total_members'] - $row['working_hands']);

        // Update economic class count
        $economicClass = $row['economic_class'];
        if (isset($economicClassCount[$economicClass])) {
            $economicClassCount[$economicClass]++;
        } else {
            $economicClassCount[$economicClass] = 1;
        }

        // Update area voter ID count
        $area = $row['area'];
        if (isset($areaVoterIdCount[$area])) {
            $areaVoterIdCount[$area] += ($row['total_members'] - $row['no_voter_id']);
        } else {
            $areaVoterIdCount[$area] = ($row['total_members'] - $row['no_voter_id']);
        }

        echo "<hr>"; // Separate each record for clarity
    }

    // Output summary statistics
    echo "Total Men: " . $totalMen . "<br>";
    echo "Total Teens: " . $totalTeens . "<br>";
    echo "Total Working Hands: " . $totalWorkingHands . "<br>";
    echo "Total Non-Working Hands: " . $totalNonWorkingHands . "<br>";

    // Output economic class count
    echo "Economic Class Count:<br>";
    foreach ($economicClassCount as $class => $count) {
        echo "$class: $count<br>";
    }

    // Output area voter ID count
    echo "Area-wise People without Voter ID:<br>";
    foreach ($areaVoterIdCount as $area => $count) {
        echo "$area: $count<br>";
    }

} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
