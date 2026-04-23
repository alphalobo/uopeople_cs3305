<?php
$studentCount = 5; // Number of students to process
$examCount = 3; // Number of exams to process
$subjectCount = 5; // Number of subjects to process
$maxMarkPerExam = 100; // Maximum total marks for percentage calculation
$maxFailCount = 2; // Maximum number of failed subjects before probation

// Check if the form has been submitted (using the submit button) and process the results
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Loop over students to check their results
    for ($student = 1; $student <= $studentCount; $student++) {

        echo "<h3>Student $student</h3>";

        // Get the exam scores for this student and assign to an array for processing
        $examScores = [];
        for ($i = 1; $i <= $examCount; $i++) {
            $examScores[] = (float) $_POST["s{$student}_exm{$i}"];
        }
        
        // Get the subject scores for this student and assign to an array for processing
        $subjectScores = [];
        for ($i = 1; $i <= $subjectCount; $i++) {
            $subjectScores[] = (float) $_POST["s{$student}_sub{$i}"];
        }

        // Calculate the average for this student's exam scores
        $examAverage = array_sum($examScores) / count($examScores);
        // Calculate the total marks obtained across all exams
        $examTotal = array_sum($examScores);
        // Calculate the percentage based on total exam marks and maximum possible total exam marks
        $examPercentage = ($examTotal / ($examCount * $maxMarkPerExam)) * 100;

        // Display the exam results for this student
        echo "Exam Average: $examAverage<br>";
        echo "Exam Percentage: $examPercentage%<br>";

        // Determine pass/fail based on the average exam score and display the result
        if ($examAverage >= 50) {
            echo "Result: Pass<br>";
        } else {
            echo "Result: Fail<br>";
        }

        // Determine qualification for Honor Roll
        if ($examAverage > 90 && max($examScores) > 95) {
            echo "<strong>Qualified for Honor Roll</strong><br>";
        }

        // Check for failed subjects and count up if the subject was failed
        $failCount = 0;
        foreach ($subjectScores as $mark) {
            if ($mark < 50) {
                $failCount++;
            }
        }

        // Display the number of failed subjects
        echo "Failed subjects: $failCount<br>";
        // Check if the number of failed subjects exceeds the maximum allowed and display probation status if necessary
        if ($failCount >= $maxFailCount) {
            echo "<strong>Student is placed on academic probation.</strong><br>";
        }

        // Add a horizontal line to separate results for different students
        echo "<hr>";
    }
}

// Function to generate input fields for exams and subjects based on the count provided, with appropriate naming conventions for processing
function generateInputs($count, $student, $prefix, $label) {
    // Loop as many times as the given count (this might be exams or subjects in this case)
    for ($i = 1; $i <= $count; $i++) {
        // Output the given label for the upcoming input field
        echo "$label $i:";
        // Make a number input field that has basic validation
        echo "<input type='number' name='s{$student}_{$prefix}{$i}' required><br>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Results</title>
</head>
<body>
    <form method="post">
        <!-- Display a heading -->
        <h2>Enter Marks for <?php echo $studentCount; ?> Students</h2>
        <!-- Loop to generate correctly formatted inputs per student -->
            <?php for ($student = 1; $student <= $studentCount; $student++): ?>
                <div>
                    <!-- Display the student number -->
                    <h4>Student <?php echo $student; ?></h4>
                    <!-- Display a heading for the exam scores input section -->
                    <h4>Enter results for <?php echo $examCount; ?> exams</h4>
                    <!-- Generate the input fields needed to enter the exam scores for this student based on the exam count -->
                    <?php generateInputs($examCount, $student, "exm", "Exam Score"); ?>
                    <!-- Display a heading for the subjects input section -->
                    <h4>Enter results for <?php echo $subjectCount; ?> subjects</h4>
                    <!-- Generate the input fields needed to enter the subject scores for this student based on the subject count -->
                    <?php generateInputs($subjectCount, $student, "sub", "Subject"); ?>
                </div>
        <!-- End the loop for generating inputs for each student -->
            <?php endfor; ?>
        <!-- Submit button to trigger the form submission and processing of results -->
        <input type="submit" value="Submit">
    </form>
</body>
</html>