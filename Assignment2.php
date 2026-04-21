<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    for ($student = 1; $student <= 5; $student++) {

        echo "<h3>Student $student</h3>";

        // --- GET SCORES ---
        $score1 = (float) $_POST["s{$student}_score1"];
        $score2 = (float) $_POST["s{$student}_score2"];
        $score3 = (float) $_POST["s{$student}_score3"];

        // --- AVERAGE ---
        $average = ($score1 + $score2 + $score3) / 3;

        // --- PERCENTAGE ---
        $total = $score1 + $score2 + $score3;
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
        if ($average > 90 && ($score1 > 95 || $score2 > 95 || $score3 > 95)) {
            echo "Qualified for Honor Roll<br>";
        }

        // --- 5 SUBJECTS FAIL CHECK ---
        $failCount = 0;

        for ($i = 1; $i <= 5; $i++) {
            $mark = (float) $_POST["s{$student}_sub{$i}"];

            if ($mark < 50) {
                $failCount++;
            }
        }

        echo "Failed subjects: $failCount<br>";

        if ($failCount > 2) {
            echo "<strong>Student is placed on academic probation.</strong><br>";
        }

        echo "<hr>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Results</title>
</head>
<body>

<h2>Enter Marks for 5 Students</h2>

<form method="post">

<?php for ($student = 1; $student <= 5; $student++): ?>
    <fieldset>
        <legend>Student <?php echo $student; ?></legend>

        <h4>Exam Scores</h4>
        Score 1: <input type="number" name="s<?php echo $student; ?>_score1" required><br>
        Score 2: <input type="number" name="s<?php echo $student; ?>_score2" required><br>
        Score 3: <input type="number" name="s<?php echo $student; ?>_score3" required><br>

        <h4>5 Subjects</h4>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            Subject <?php echo $i; ?>:
            <input type="number" name="s<?php echo $student; ?>_sub<?php echo $i; ?>" required><br>
        <?php endfor; ?>

    </fieldset>
    <br>
<?php endfor; ?>

<input type="submit" value="Submit">

</form>

</body>
</html>