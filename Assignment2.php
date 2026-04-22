<?php
$examCount = 3; // Number of exams to process
$subjectCount = 5; // Number of subjects to process
$studentCount = 2; // Number of students to process

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    for ($student = 1; $student <= $studentCount; $student++) {

        echo "<h3>Student $student</h3>";

        // --- GET SCORES ---        
        $examScores = [];
        for ($i = 1; $i <= $examCount; $i++) {
            $examScores[] = (float) $_POST["s{$student}_exm{$i}"];
            }
            
        $subjectScores = [];
        for ($i = 1; $i <= $subjectCount; $i++) {
            $subjectScores[] = (float) $_POST["s{$student}_sub{$i}"];
        }
        // --- AVERAGE Exam Scores ---
        $average = array_sum($examScores) / count($examScores);

        // --- PERCENTAGE ---
        $total = array_sum($examScores);
        $percentage = ($total / 300) * 100;

        echo "Average: $average<br>";
        echo "Percentage: $percentage%<br>";

        // --- PASS / FAIL ---
        if ($average >= 50) {
            echo "Result: Pass<br>";
        } else {
            echo "Result: Fail<br>";
        }

        // --- HONOR ROLL ---
        if ($average > 90 && max($examScores) > 95) {
            echo "Qualified for Honor Roll<br>";
        }

        // --- 5 SUBJECTS FAIL CHECK ---
        // $failCount = 0;

        // for ($i = 1; $i <= 5; $i++) {
        //     $mark = (float) $_POST["s{$student}_sub{$i}"];

        //     if ($mark < 50) {
        //         $failCount++;
        //     }
        // }

        // echo "Failed subjects: $failCount<br>";

        // if ($failCount > 2) {
        //     echo "<strong>Student is placed on academic probation.</strong><br>";
        // }

        echo "<hr>";
    }
}

function generateInputs($count, $student, $prefix, $label) {
    for ($i = 1; $i <= $count; $i++) {
        echo "$label $i:";
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
        <h2>Enter Marks for <?php echo $studentCount; ?> Students</h2>
            <?php for ($student = 1; $student <= $studentCount; $student++): ?>
                <div>
                    <h4>Student <?php echo $student; ?></h4>
                    <h4>Exam Scores</h4>
                    <?php generateInputs($examCount, $student, "exm", "Exam Score"); ?>
                    <h4><?php echo $subjectCount; ?> Subjects</h4>
                    <?php generateInputs($subjectCount, $student, "sub", "Subject"); ?>
                </div>
                <br>
            <?php endfor; ?>
        <input type="submit" value="Submit">
    </form>
</body>
</html>