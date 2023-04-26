function flash(message = "", color = "info") {
    let flash = document.getElementById("flash");
    //create a div (or whatever wrapper we want)
    let outerDiv = document.createElement("div");
    outerDiv.className = "row justify-content-center";
    let innerDiv = document.createElement("div");

    //apply the CSS (these are bootstrap classes which we'll learn later)
    innerDiv.className = `alert alert-${color}`;
    //set the content
    innerDiv.innerText = message;

    outerDiv.appendChild(innerDiv);
    //add the element to the DOM (if we don't it merely exists in memory)
    flash.appendChild(outerDiv);
}
function emailRegex(email) {
    const valid_email_regex = "^(([^<>()[\\]\\\\.,;:\\s@\\\"]]+(\\.[^<>()[\\]\\\\.,;:\\s@\\\"]]+)*)|(\\\".+\\\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$";
    if (email.match(valid_email_regex)) {
        return true;
    } else {
        flash("The email entered is not valid. Please try again.", "danger");
    }
}
function isDomainEmail(email) {
    let domain = email.split("@")[1];
    if (domain == "taudelt.net" || domain == "test.net") { // Left second condition in for testing purposes
        return true;
    } else {
        flash("Please use your organization provided email.", "danger");
    }
}
function validateEmail(email) {
    if (emailRegex(email) && isDomainEmail(email)) {
        return true;
    } else {
        return false;
    }
}
function validateUsername(username) {
    const valid_username_regex = "^[a-z0-9_-]{3,16}$";
    if (username.match(valid_username_regex)) {
        return true;
    } else {
        return false;
    }
}
function validatePassword(password) {
    const valid_password_regex = "^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$";
    if (password.match(valid_password_regex)) {
        return true;
    } else {
        return false;
    }
}
function generateUsername(email) {
    let username = email.split("@")[0];
    return username;
}
function validateName(first_name, last_name) {
    const valid_name_regex = "^[a-zA-Z ]{2,20}$";
    if (first_name.match(valid_name_regex) && last_name.match(valid_name_regex)) {
        return true;
    } else {
        return false;
    }
}

