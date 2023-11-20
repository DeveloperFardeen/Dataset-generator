const generateFamilyData = () => {
  // Define arrays for generating random values
  const guardianNames = ["John Smith", "Mary Jones", "Peter Brown", "Susan Lee", "David Williams"];
  const totalMembers = [2, 3, 4, 5, 6];
  const teens = [0, 1, 2];
  const females = [1, 2, 3];
  const yearlyIncome = [20000, 30000, 40000, 50000, 60000];
  const occupations = ["Teacher", "Doctor", "Engineer", "Lawyer", "Businessman"];
  const castes = ["General", "Scheduled Caste", "Scheduled Tribe", "Other Backward Classes", "Other"];
  const workingHands = [1, 2, 3];
  const jobless = [0, 1];
  const phoneNumbers = ["9876543210", "8765432198", "7654321087", "6543210987", "5432107654"];

  // Generate random family data
  const familyData = [];
  for (let i = 0; i < 10; i++) {
    const randomGuardianName = guardianNames[Math.floor(Math.random() * guardianNames.length)];
    const randomTotalMembers = totalMembers[Math.floor(Math.random() * totalMembers.length)];
    const randomTeens = teens[Math.floor(Math.random() * teens.length)];
    const randomFemales = females[Math.floor(Math.random() * females.length)];
    const randomYearlyIncome = yearlyIncome[Math.floor(Math.random() * yearlyIncome.length)];
    const randomOccupation = occupations[Math.floor(Math.random() * occupations.length)];
    const randomCaste = castes[Math.floor(Math.random() * castes.length)];
    const randomWorkingHands = workingHands[Math.floor(Math.random() * workingHands.length)];
    const randomJobless = jobless[Math.floor(Math.random() * jobless.length)];
    const randomPhoneNumber = phoneNumbers[Math.floor(Math.random() * phoneNumbers.length)];

    const familyMemberData = {
      guardianName: randomGuardianName,
      totalMembers: randomTotalMembers,
      teens: randomTeens,
      females: randomFemales,
      yearlyIncome: randomYearlyIncome,
      occupation: randomOccupation,
      caste: randomCaste,
      workingHands: randomWorkingHands,
      jobless: randomJobless,
      phoneNumber: randomPhoneNumber,
    };
    familyData.push(familyMemberData);
  }
  return familyData;
};

console.log(generateFamilyData());
