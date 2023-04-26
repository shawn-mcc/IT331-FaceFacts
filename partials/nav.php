<?php
require_once(__DIR__ . "/../lib/functions.php");
//Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}
$localWorks = true; //some people have issues with localhost for the cookie params
//if you're one of those people make this false

//this is an extra condition added to "resolve" the localhost issue for the session cookie
if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "$BASE_PATH",
        //"domain" => $_SERVER["HTTP_HOST"] || "localhost",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}
session_start();


?>
<!-- include css and js files -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<link rel="stylesheet" href="<?php echo get_url('/style/style.css'); ?>">
<script src="<?php echo get_url('/js/helpers.js'); ?>"></script>
<script src="<?php echo get_url('/js/create_task_helpers.js'); ?>"></script>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo get_url('/index.php');?>">
            <div class="row">
                <div class="col">
                    <img src="<?php echo get_url('/img/FaceFactsLogo.png'); ?>" alt="logo" width="30" height="30" class="d-inline-block align-text-top">
                </div>
                <div class="col" id="Brand_Text">
                    Face Facts
                </div>
                <div class="col">
</div>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <?php if (is_logged_in()) : ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('/dashboard.php'); ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('/profile.php'); ?>">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('/my_teams.php'); ?>">My Teams</a></li>
                <?php endif; ?>
                <?php if (!is_logged_in()) : ?>
                    <li class="nav-item ms-auto"><a class="nav-link" href="<?php echo get_url('/about_us.php'); ?>">About Us</a></li>
                    <li class="nav-item ms-auto"><a class="nav-link" href="<?php echo get_url('/contact_us.php'); ?>">Contact Us</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="rolesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pricing
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="rolesDropdown">
                            <li><a class="dropdown-item" href="<?php echo get_url('/pricing_advertiser.php'); ?>">For Advertisers</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('/pricing_viewer.php'); ?>">For Viewers</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-auto"><a class="nav-link" href="<?php echo get_url('/FAQ.php'); ?>">FAQ</a></li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('/login.php'); ?>">Login</a></li>
                    <li class="nav-item "><a class="nav-link" href="<?php echo get_url('/register.php'); ?>">Register</a></li>
                </ul>
                <?php endif; ?>
                <?php if (has_role("Admin")) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="rolesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin Tools
                        </a>
                        <ul class="dropdown-menu bg-warning" aria-labelledby="rolesDropdown">
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/create_role.php'); ?>">Create Roles</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/assign_roles.php'); ?>">Assign Roles</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/assign_officers.php'); ?>">Assign Officers</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/list_roles.php'); ?>">View Roles</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (has_role("Admin") || (has_role("Officer"))) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="rolesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Team Management
                        </a>
                        <ul class="dropdown-menu bg-warning" aria-labelledby="rolesDropdown">
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/create_team.php'); ?>">Create Teams</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/assign_teams.php'); ?>">Assign Teams</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/list_teams.php'); ?>">View Teams</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (has_role("Admin") || (has_role("Officer"))) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="rolesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Task Management
                        </a>
                        <ul class="dropdown-menu bg-warning" aria-labelledby="rolesDropdown">
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/create_tasks.php'); ?>">Create a New Task</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/list_tasks.php'); ?>">View Tasks</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (is_logged_in()) : ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('logout.php'); ?>">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>