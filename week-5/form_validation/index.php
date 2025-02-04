<?php
// Initialize variables
$nameErr = $emailErr = $genderErr = "";
$name = $email = $gender = $comment = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = clean_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = clean_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = clean_input($_POST["gender"]);
    }

    // Comment is optional
    $comment = clean_input($_POST["comment"]);
}

// Function to sanitize input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Name: 
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>

        Email: 
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>

        Comment: 
        <textarea name="comment" rows="5" cols="40"><?php echo htmlspecialchars($comment); ?></textarea>
        <br><br>

        Gender:
        <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>> Female
        <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>> Male
        <input type="radio" name="gender" value="Other" <?php if ($gender == "Other") echo "checked"; ?>> Other
        <span class="error">* <?php echo $genderErr; ?></span>
        <br><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    // Display submitted data if no errors
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($emailErr) && empty($genderErr)) {
        echo "<h2>Your Input:</h2>";
        echo "Name: " . $name . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Comment: " . $comment . "<br>";
        echo "Gender: " . $gender . "<br>";
    }
    ?>
</body>
</html>