<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/ xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <?php
    // Call file to connect to server
    include("header.php"); 
    ?>

    <?php
    // This query inserts a record in the clinic table if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = array(); // Initialize an error array

        // Check for a Firstname
        if (empty($_POST['FirstName_p'])) {
            $errors[] = 'You forgot to enter your first name.';
        } else {
            $n = mysqli_real_escape_string($connect, trim($_POST['FirstName_p']));
        }

        // Check for a LastName
        if (empty($_POST['LastName_p'])) {
            $errors[] = 'You forgot to enter your last name.';
        } else {
            $I = mysqli_real_escape_string($connect, trim($_POST['LastName_p']));
        }

        // Check for an Insurance Number
        if (empty($_POST['Insurance_Number'])) {
            $errors[] = 'You forgot to enter your Insurance Number.';
        } else {
            $i = mysqli_real_escape_string($connect, trim($_POST['Insurance_Number']));
        }

        // Check for a Diagnose
        if (empty($_POST['Diagnose'])) {
            $errors[] = 'You forgot to enter your diagnose.';
        } else {
            $d = mysqli_real_escape_string($connect, trim($_POST['Diagnose']));
        }

        // If there are no errors, insert the data into the database
        if (empty($errors)) {
            // Make the query
            $q = "INSERT INTO pesakit (FirstName_P, LastName_P, Insurance_Number, Diagnose) VALUES ('$n', '$I', '$i', '$d')";
            $result = @mysqli_query($connect, $q); // Run the query

            if ($result) {
                echo '<h1>Thank you!</h1>';
                exit();
            } else {
                echo '<h1>System Error</h1>';
                echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
            }
        } else {
            // Print each error if any exist
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
        }

        mysqli_close($connect); // Close the database connection
        exit();
    }
    ?>

    <h2>Register</h2>
    <h4>* required field</h4>
    <form action="register.php" method="post">
        <p><label class="label" for="FirstName_p">First Name: *</label>
        <input id="FirstName_p" type="text" name="FirstName_p" size="30" maxlength="150" value="<?php if (isset($_POST['FirstName_p'])) echo $_POST['FirstName_p']; ?>" /></p>

        <p><label class="label" for="LastName_p">Last Name: *</label>
        <input id="LastName_p" type="text" name="LastName_p" size="30" maxlength="60" value="<?php if (isset($_POST['LastName_p'])) echo $_POST['LastName_p']; ?>" /></p>

        <p><label class="label" for="Insurance_Number">Insurance Number: *</label>
        <input id="Insurance_Number" type="text" name="Insurance_Number" size="12" maxlength="12" value="<?php if (isset($_POST['Insurance_Number'])) echo $_POST['Insurance_Number']; ?>" /></p>

        <p><label class="label" for="Diagnose">Diagnose:</label></p>
        <textarea name="Diagnose" rows="5" cols="40"><?php if (isset($_POST['Diagnose'])) echo $_POST['Diagnose']; ?></textarea>

        <p><input id="submit" type="submit" name="submit" value="Register" /> &nbsp;&nbsp; 
        <input id="reset" type="reset" name="reset" value="Clear All" /></p>
    </form>

    <p><br /><br /><br /></p>
</body>
</html>
