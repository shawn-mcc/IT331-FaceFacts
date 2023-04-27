<?php
require_once(__DIR__ . "../../partials/nav.php");
reset_session();
?>

<form onsubmit="return validate(this)" method="POST">
    <div class="mb-3">
        <h3>Thank you for your interest in FaceFacts! The following fields are required for registration: </h3>
        <label class="form-label" for="first_name">First Name</label>
        <input class="form-control" type="text" name="first_name" required maxlength="30" />
        <div class="mb-3">
            <label class="form-label" for="username">Last Name</label>
            <input class="form-control" type="text" name="last_name" required maxlength="30" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email" required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="username">Age</label>
            <input class="form-control" type="int" id="age" name="age" required />
            <label class="form-label" for="username">Gender</label>
            <input class="form-control" type="text" id="gender" name="gender" required />
            <label class="form-label" for="username">Geographic Location</label>
            <input class="form-control" type="text" id="geo_location" name="geo_location" required />
        </div>
        <h3> The following fields are optional, but may increase your likelihood of qualifying for videos: </h3>
        <div class="mb-3">
            <label class="form-label" for="username">Ethnicity</label>
            <input class="form-control" type="text" id="ethnicity" name="ethnicity" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="username">Do you have a disability?</label>
            <input class="form-control" type="text" id="has_disability" name="has_disability" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="username">Are you a Veteran?</label>
            <input class="form-control" type="text" id="is_veteran" name="is_veteran" />
        </div>
        <h3>Almost done now! Please create a username and password for your account: </h3>
        <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" id="username" name="username" required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="pw">Password</label>
            <input class="form-control" type="password" id="pw" name="password" required minlength="8" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="confirm">Confirm</label>
            <input class="form-control" type="password" name="confirm" required minlength="8" />
        </div>
        <input type="submit" class="mt-3 btn btn-primary" value="Register" />
        <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
</form>


<div class="container-fluid">
    <h1 id="reg_h">Register</h1>
    <div class="row">
        <h3> Thanks for your interest! Please select the type of account you would like to register for.</h3>
    </div>
    <br />
    <div class="row">
        <div class="col">
            <button class="btn btn-primary" onclick="loadForm('viewer')">Looking to register as a Viewer?</button>
        </div>
        <div class="col">
            <button class="btn btn-primary" onclick="loadForm('client')">Looking to register as an Advertiser?</button>
        </div>
    </div>
</div>
<script>
    viewer_form = `
    
    `;

    function validate(form) {
        // JavaScript validation
        let email = form.email.value;
        let password = form.password.value;
        let confirm = form.confirm.value;
        let first_name = form.first_name.value;
        let last_name = form.last_name.value;
        if (!validatePassword(password)) {
            flash("Password must be at least 8 characters, contain at least one number, one uppercase letter, one lowercase letter and one special character");
            return false;
        }
        if (password != confirm) {
            flash("Passwords do not match");
            return false;
        }
        return true;
    }
</script>
<?php

if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"]) && isset($_POST["first_name"]) && isset($_POST["last_name"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
}
// PHP Validation
$hasError = false;
//Detect if form not complelte
if (isset($email) || isset($password) || isset($confirm) || isset($first_name) || isset($last_name)) {
    if (empty($email)) {
        flash("Email is required");
        $hasError = true;
    }
    if (empty($first_name)) {
        flash("First name is required");
        $hasError = true;
    }
    if (empty($last_name)) {
        flash("Last name is required");
        $hasError = true;
    }
    if (empty($password)) {
        flash("Password is required");
        $hasError = true;
    }
    if (empty($confirm)) {
        flash("Password Confirmation is required");
        $hasError = true;
    }

    // Verify and sanatize email
    if (!validate_email($email)) {
        $hasError = true;
    }
    // Detect is password rules are followed
    if (is_valid_password($password) == false) {
        flash("Password must be at least 8 characters, contain at least one number, and one special character");
        $hasError = true;
    }
    //Check if passwords match
    if (isset($password) && $password != $confirm && strlen($password) > 0) {
        flash("Passwords do not match");
        $hasError = true;
    }

    //Complete if registration is okay
    if (!$hasError and (isset($email) && isset($password) && isset($confirm) && isset($first_name) && isset($last_name))) {
        // Hash password
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $db = getDB();
        // Use prepare and placeholders to prevent SQL injection
        $stmt = $db->prepare("INSERT INTO Users (email, password, username, account_type_id) VALUES (:email, :password, :username, 1)");
        try {
            $r = $stmt->execute([
                ":email" => $email,
                ":password" => $hash,
                ":username" => $username
            ]);
            flash("Registration successful, please login");
        } catch (PDOException $e) {
            flash("Error registering: " . var_export($e->getMessage(), true));
        }
        $stmt = $db->prepare("INSERT INTO ViewerAccountData (email, password, username, first_name, last_name, current_tokens,age,gender,geo_location,ethnicity,has_disability,is_veteran) VALUES (:email, :password, :username, :first_name, :last_name, 0, :age,:gender,:geo_location,:ethnicity,:has_disability,:is_veteran)");
        try {
            $r = $stmt->execute([
                ":email" => $email,
                ":password" => $hash,
                ":username" => $username,
                ":first_name" => $first_name,
                ":last_name" => $last_name,
                ":age" => $age,
                ":gender" => $gender,
                ":geo_location" => $geo_location,
                ":ethnicity" => $ethnicity,
                ":has_disability" => $has_disability,
                ":is_veteran" => $is_veteran
            ]);
            flash("Registration Successful. Welcome $first_name!");
        } catch (Exception $e) {
            users_check_duplicate($e);
            error_log("Error inserting user: " . $e->getMessage());
        }
    }
}
?><?php require_once(__DIR__ . "../../partials/flash.php"); ?>