<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and store it in PHP variables
    $patientName = $_POST["patient_name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $condition = $_POST["condition"];
    $medication = $_POST["medication"];
    $doctor = $_POST["doctor"];

    // Create JavaScript code to add patient to the JavaScript database
    $jsCode = "
      var patients = JSON.parse(localStorage.getItem('patients')) || [];
      var newPatient = {
        patientName: '" . $patientName . "',
        age: " . $age . ",
        gender: '" . $gender . "',
        condition: '" . $condition . "',
        medication: '" . $medication . "',
        doctor: '" . $doctor . "'
      };
      patients.push(newPatient);
      localStorage.setItem('patients', JSON.stringify(patients));
    ";
    // Write the JavaScript code to a separate JavaScript file
    $jsFile = fopen("script.js", "w") or die("Unable to open file!");
    fwrite($jsFile, $jsCode);
    fclose($jsFile);
    // Redirect back to the form page after submission
    header("Location: add.html");
    exit();
}
?>