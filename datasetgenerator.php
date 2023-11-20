<?php

// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
<span class="math-inline">conn \= new mysqli\(</span>servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database schema
$sql = "CREATE TABLE IF NOT EXISTS family_data (
    guardian_name VARCHAR(255) NOT NULL,
    total_members INT NOT NULL,
    teens INT NOT NULL,
    females INT NOT NULL,
    yearly_income INT NOT NULL,
    occupation VARCHAR(255) NOT NULL,
    caste VARCHAR(255) NOT NULL,
    working_hands INT NOT NULL,
    jobless INT NOT NULL,
    phone_number VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table family_data created successfully" . PHP_EOL;
} else {
    echo "Error creating table: " . $conn->error . PHP_EOL;
}

// Generate random family data
$familyData = [];
for ($i = 0; $i < 10; $i++) {
    $guardianNames = ["John Smith", "Mary Jones", "Peter Brown", "Susan Lee", "David Williams"];
    $totalMembers = [2, 3, 4, 5, 6];
    $teens = [0, 1, 2];
    $females = [1, 2, 3];
    $yearlyIncome = [20000, 30000, 40000, 50000, 60000];
    $occupations = ["Teacher", "Doctor", "Engineer", "Lawyer", "Businessman"];
    $castes = ["General", "Scheduled Caste", "Scheduled Tribe", "Other Backward Classes", "Other"];
    $workingHands = [1, 2, 3];
    $jobless = [0, 1];
    $phoneNumbers = ["9876543210", "8765432198", "7654321087", "6543210987", "5432107654"];

    $randomGuardianName = $guardianNames[mt_rand(0, count($guardianNames) - 1)];
    $randomTotalMembers = $totalMembers[mt_rand(0, count($totalMembers) - 1)];
    $randomTeens = $teens[mt_rand(0, count($teens) - 1)];
    $randomFemales = $females[mt_rand(0, count($females) - 1)];
    $randomYearlyIncome = $yearlyIncome[mt_rand(0, count($yearlyIncome) - 1)];
    $randomOccupation = $occupations[mt_rand(0, count($occupations) - 1)];
    $randomCaste = $castes[mt_rand(0, count($castes) - 1)];
    $randomWorkingHands = $workingHands[mt_rand(0, count($workingHands) - 1)];
    $randomJobless = $jobless[mt_rand(0, count($jobless) - 1)];
    $randomPhoneNumber = $phoneNumbers[mt_rand(0, count($phoneNumbers) - 1)];

    $familyMemberData = [
        "guardian_name" => $randomGuardianName,
        "total_members" => $randomTotalMembers,
        "teens" => $randomTeens,
        "females" => $randomFemales,
        "yearly_income" => $randomYearlyIncome,
        "occupation" => $randomOccupation,
        "caste" => $randomCaste,
        "working_hands" => $randomWorkingHands,
        "jobless" => $randomJobless,
        "phone_number" => $randomPhoneNumber,
    ];
    $familyData[] = $familyMemberData;
}

// Insert data into the family_data table
$insertStatement = $conn->prepare("INSERT INTO family_data 
    (guardian_name, total_members, teens, females, yearly_income, occupation, caste, working_hands, jobless, phone_number) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($familyData as $familyMemberData) {
    $insertStatement->bind_param(
        "siiiiissis", // String, Integer, Integer, Integer, Integer, String, String, Integer, Integer, String
        $familyMemberData['guardian_name'],
        $familyMemberData['total_members'],
        $familyMemberData['teens'],
        $familyMemberData['females'],
        $familyMemberData['yearly_income'],
        $familyMemberData['occupation'],
        $familyMemberData['caste'],
        $familyMemberData['working_hands'],
        $familyMemberData['jobless'],
        $familyMemberData['phone_number']
    );

    $insertStatement->execute();
}

// Close the prepared statement
$insertStatement->close();

// Close the database connection
$conn->close();
?>
