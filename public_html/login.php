<?php
require(__DIR__ . "/../partials/nav.php");
?>
<?php

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = se($_POST, "email", "", false);
    $password = se($_POST, "password", "", false);

    //PHP validation
    $hasError = false;
    //Detect if form not complete
    if (empty($email)) {
        flash("Email must not be empty");
        $hasError = true;
    }
    if (empty($password)) {
        flash ("Password must not be empty");
        $hasError = true;
    }
    // Sanitize and Validate Email
    if (str_contains($email, "@")) {

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (validate_email($email)) {
            flash("Invalid email address");
            $hasError = true;
        }
    } else {
        if (!is_valid_username($email)) {
            flash("Invalid username");
            $hasError = true;
        }
    } // Check if password is empty. No need to show password rules on login page.
    if (empty($password)) {
        flash("password must not be empty");
        $hasError = true;
    }
    if (!$hasError) {
        // Login
        $db = getDB();
        $stmt = $db->prepare("SELECT id, email, username, password from Users where email = :email or username = :email"); //Because we didnt change login name. Its okay as long as it's consistent 
        try {
            $r = $stmt->execute([":email" => $email]);
            if ($r) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    $hash = $user["password"];
                    // Want the password to be availible for as little time as possible
                    unset($user["password"]);
                    if (password_verify($password, $hash)) {
                        //Start session for logged in user
                        $_SESSION["user"] = $user;
                        try {
                            //lookup potential roles
                            $stmt = $db->prepare("SELECT AccountType.name FROM AccountType 
                        JOIN UserAccountTypes on AccountType.id = UserAccountTypes.account_type_id 
                        WHERE UserAccountTypes.user_id = :user_id and AccountType.is_active = 1");
                            $stmt->execute([":user_id" => $user["id"]]);
                            $roles = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all since we'll want multiple
                        } catch (Exception $e) {
                            error_log(var_export($e, true));
                        }
                        //save roles or empty array
                        if (isset($roles)) {
                            $_SESSION["user"]["roles"] = $roles; //at least 1 role
                        } else {
                            $_SESSION["user"]["roles"] = []; //no roles
                        }
                        flash("Welcome back " . get_username());
                        
                        //Redirect to home page
                        if (has_role("viewer")){
                            die(header("Location: viewer/dashboard.php"));
                        } elseif (has_role("client")){
                            die(header("Location: client/dashboard.php"));
                        } 
                        
                    } else {
                        flash("Invalid password");
                    }
                } else {
                    flash("Email not found");
                }
            }
        } catch (Exception $e) {
            flash("An error occurred while attempting to login, please try again later.");
            error_log("<pre>" . var_export($e, true) . "</pre>");
        }
    }
}
?>
<div class="container-fluid">
    <h1>Login</h1>
    <form onsubmit="return validate(this)" method="POST">
        <div class="mb-3">
            <label class="form-label" for="email">Username/Email</label>
            <input class="form-control" type="text" id="email" name="email" required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="pw">Password</label>
            <input class="form-control" type="password" id="pw" name="password" required minlength="8" />
        </div>
        <input type="submit" class="mt-3 btn btn-primary" value="Login" />
        <p class="mt-3">Don't have an account? <a href="register.php">Register</a></p>
    </form>
</div>
<script>
    function validate(form) {
        // JavaScript validation
        let email = form.email.value;
        let password = form.password.value;
        if(validateEmail(email) == true || validateUsername(email) == true){
            return true;
        }
        if(password.length == 0){
            flash("Password is required");
            return false;
        }//Don't check if password follows password rules here. No need to have those rules visible outside of registration
        return true;  
    }
</script>

<?php require_once(__DIR__ . "/../partials/flash.php"); ?>