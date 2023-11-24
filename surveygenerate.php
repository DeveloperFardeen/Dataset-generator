<?php

// Create the database schema
$sql = "CREATE TABLE IF NOT EXISTS survey_nov23 (
    sno INT(10) NOT NULL AUTO_INCREMENT,
    guardian VARCHAR(30) NOT NULL,
    total_members INT(3) NOT NULL,
    present_members INT(3) NOT NULL,
    females INT(3) NOT NULL,
    teens INT(3) NOT NULL,
    working_hands INT(3) NOT NULL,
    jobless INT(3),
    income varchar(100),
    income_source varchar(100),
    non_voter INT(3) NOT NULL,
    district varchar(100),
    mob_num varchar(14) NOT NULL,
    caste VARCHAR(255) NOT NULL,
    dt DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    seperator varchar(10) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table family_data created successfully" . PHP_EOL;
} else {
    echo "Error creating table: " . $conn->error . PHP_EOL;
}

// Generate random family data
$familyData = [];
for ($i = 0; $i < 500; $i++) {
    $guardianNames = ["John Smith", "Mary Jones", "Peter Brown", "Susan Lee", "David Williams","Sonu","Monu","Rahul","Mohan","Sanju","Manju","Ganju","Shivam","Aman","Rohit","Mohit","Joshi","Karul","Montu","Ratul","Mojan","Shahid","Ronu","Rahit","Rana"];
    $totalMembers = [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
    $presentMembers = [0, 1, 2, 3, 4, 5, 6, 7];
    $teens = [0, 1, 2, 3, 4, 5, 6, 7];
    $females = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    $yearlyIncome = [100000, 200000, 300000, 500000, 750000, 1000000];
    $occupations = ["Teacher", "Doctor", "Engineer", "Lawyer", "Businessman"];
    $castes = ["General", "Scheduled Caste", "Scheduled Tribe", "Other Backward Classes", "Other"];
    $workingHands = [1, 2, 3, 4, 5];
    $nonVoters = [1, 2, 3, 4, 5];
    $jobless = [0, 1, 2, 3, 4, 5];
    $phoneNumbers = ["9876543210", "8765432198", "7654321087", "6543210987", "5432107654", "9876243210", "8765432118", "7654321687", "6543210587", "5432107684"];
    $districts = ["Araria", "Arwal", "Banka", "Begusarai", "Bhagalpur", "Buxar", "Darbhanga", "Gaya", "Jamui"];
    $seperator = ["code1", "code2", "code3", "code4", "code5", "code6", "code7"];

    $randomGuardianName = $guardianNames[mt_rand(0, count($guardianNames) - 1)];
    $randomTotalMembers = $totalMembers[mt_rand(0, count($totalMembers) - 1)];
    $randomPresentMembers = $presentMembers[mt_rand(0, count($presentMembers) - 1)];
    $randomTeens = $teens[mt_rand(0, count($teens) - 1)];
    $randomFemales = $females[mt_rand(0, count($females) - 1)];
    $randomYearlyIncome = $yearlyIncome[mt_rand(0, count($yearlyIncome) - 1)];
    $randomOccupation = $occupations[mt_rand(0, count($occupations) - 1)];
    $randomCaste = $castes[mt_rand(0, count($castes) - 1)];
    $randomWorkingHands = $workingHands[mt_rand(0, count($workingHands) - 1)];
    $randomNonVoter = $nonVoters[mt_rand(0, count($nonVoters) - 1)];
    $randomPhoneNumber = $phoneNumbers[mt_rand(0, count($phoneNumbers) - 1)];
    $randomJobless = $jobless[mt_rand(0, count($jobless) - 1)];
    $randomDistrict = $districts[mt_rand(0, count($districts) - 1)];
    $randomSeperator = $seperator[mt_rand(0, count($seperator) - 1)];

    $familyMemberData = [
        "guardian" => $randomGuardianName,
        "total_members" => $randomTotalMembers,
        "present_members" => $randomPresentMembers,
        "teens" => $randomTeens,
        "females" => $randomFemales,
        "income" => $randomYearlyIncome,
        "income_source" => $randomOccupation,
        "caste" => $randomCaste,
        "working_hands" => $randomWorkingHands,
        "non_voter" => $randomNonVoter,
        "mob_num" => $randomPhoneNumber,
        "jobless" => $randomJobless,
        "district" => $randomDistrict,
        "seperator" => $randomSeperator,
    ];
    $familyData[] = $familyMemberData;
}

// Insert data into the family_data table
$insertStatement = $conn->prepare("INSERT INTO survey_nov23 
    (guardian, total_members, present_members, teens, females, income, income_source, caste, working_hands, jobless, mob_num, non_voter, district, seperator) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($familyData as $familyMemberData) {
    $insertStatement->bind_param(
        "siiiisssiisiss", 
        $familyMemberData['guardian'],
        $familyMemberData['total_members'],
        $familyMemberData['present_members'],
        $familyMemberData['teens'],
        $familyMemberData['females'],
        $familyMemberData['income'],
        $familyMemberData['income_source'],
        $familyMemberData['caste'],
        $familyMemberData['working_hands'],
        $familyMemberData['jobless'],
        $familyMemberData['mob_num'],
        $familyMemberData['non_voter'],
        $familyMemberData['district'],
        $familyMemberData['seperator']
    );

    $insertStatement->execute();
}

// Close the prepared statement
$insertStatement->close();

?>
