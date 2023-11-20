<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "surveydata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>random</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    text-decoration: none;
    font-family: poppins;
}
button {
    padding: 8px;
    border: none;
    font-size: 16px;
    font-weight: 500;
    color: white;
    margin: 15px 0;
    transition: background-color 0.4s;
}
.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    background-color: #4cabf3;
}
.header button {
    border-radius: 5px;
    background-color: rgb(46, 12, 180);
}
.chart {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 30px 0;
}
    </style>
</head>
<body>

<!-- Page Header -->
    <div class="header">
        <h1>Fardeen Developer</h1>
        <button name="logOut">LOG OUT</button>
    </div>
    <br><br><br><br>
    
    
    
    
    
    
    
    
    <div class="chart">
        <h1>Income distribution 2024</h1>
        <canvas id="incomeChart" style="width:100%;max-width:600px;"></canvas>

<?php
/*========= Income Distribution ===========*/

$yearlyIncome = [100000, 200000, 300000, 500000, 750000, 1000000];

// Initialize an array to store the count for each income category
$incomeCount = array_fill(0, count($yearlyIncome), 0);

// SQL query to count families in each income category
$countQuery = "SELECT yearly_income, COUNT(*) as count FROM family_data GROUP BY yearly_income";

// Execute the query
$result = $conn->query($countQuery);

// Process the result
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $income = $row['yearly_income'];

        // Determine the index in the incomeCount array
        $index = array_search($income, $yearlyIncome);

        if ($index !== false) {
            // Increment the count for the corresponding income category
            $incomeCount[$index] = $row['count'];
        }
    }
}

// Echo the results
for ($i = 0; $i < count($yearlyIncome); $i++) {
    echo "Number of families with income in {$yearlyIncome[$i]}: {$incomeCount[$i]}<br>" . PHP_EOL;
}

?>
    </div>

    <div class="chart">
        <h1>Occupation distribution 2024</h1>
        <canvas id="occupationChart" style="width:100%;max-width:600px"></canvas>


<?php
/*========= occupation Distribution ===========*/

$occupations = ["Teacher", "Doctor", "Engineer", "Lawyer", "Businessman"];

// Initialize an array to store the count for each occupation category
$occupationCount = array_fill(0, count($occupations), 0);

// SQL query to count families in each occupation category
$countQuery = "SELECT occupation, COUNT(*) as count FROM family_data GROUP BY occupation";

// Execute the query
$result = $conn->query($countQuery);

// Process the result
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $occupation = $row['occupation'];

        // Determine the index in the occupationCount array
        $index = array_search($occupation, $occupations);

        if ($index !== false) {
            // Increment the count for the corresponding occupation category
            $occupationCount[$index] = $row['count'];
        }
    }
}

// Echo the results
for ($i = 0; $i < count($occupations); $i++) {
    echo "Number of families in {$occupations[$i]}: {$occupationCount[$i]}<br>" . PHP_EOL;
}

?>

</div>

<?php

// Close the database connection
$conn->close();

?>

    <h1>Hi</h1>


<script>
const xIncome = <?php echo  json_encode($yearlyIncome); ?>;
const yIncome = <?php echo  json_encode($incomeCount) ?>;
const colorIncome = ["red", "green","blue","orange","brown","black"];

new Chart("incomeChart", {
  type: "bar",
  data: {
    labels: xIncome,
    datasets: [{
      backgroundColor: colorIncome,
      data: yIncome
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }],
    }
  }
});

const xoccu = <?php echo  json_encode($occupations); ?>;
const yoccu = <?php echo  json_encode($occupationCount) ?>;
const coloroccu = ["red", "green","blue","orange","brown"];

new Chart("occupationChart", {
  type: "bar",
  data: {
    labels: xoccu,
    datasets: [{
      backgroundColor: coloroccu,
      data: yoccu
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }],
    }
  }
});

</script>
</body>
</html>