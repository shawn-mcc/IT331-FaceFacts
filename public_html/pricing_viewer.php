<?php
require(__DIR__ . "/../partials/nav.php");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<section class="bg-light py-5">
                <div class="container px-5 my-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder">FaceFacts <i>Pays You</i></h1>
                        <p class="lead fw-normal text-muted mb-0">Companies are willing to pay <i><u>you</u></i> for your time and input!</p>
                        <div class='row gx-5'>
                            <p class="lead fw-normal text-muted mb-0">Check out a few of the prizes we are offering!</p>
                        </div>
                    </div>
                    <div class="row gx-5">
                        <div class="col-lg-6">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-3 mb-3" src="img/store//Amazon.jpg" alt="Amazon Gift Card" style="height:400px;width:600px"/>
                                <p class='lead fw-normal text-center'>Amazon Gift Cards!</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-3 mb-3" src="img/store/starbucks.png" alt="Coffee" style="height:400px;width:600px"/>
                                <p class='lead fw-normal text-center'>Free Coffee!</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mb-5 mb-lg-0">
                                <img class="img-fluid rounded-3 mb-3" src="img/store/xbox.jpg" alt="Game Pass" style="height:400px;width:600px"/>
                                <p class='lead fw-normal text-center'>Game Pass Subscription!</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative">
                                <img class="img-fluid rounded-3 mb-3" src="img/store/cash.jpg" alt="Cash" style="height:400px;width:600px"/>
                                <p class='lead fw-normal text-center'>Cold Hard Cash!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-5 bg-light">
                <div class="container px-5 my-5 text-center">
                    <h2 class="display-4 fw-bolder mb-4">Ready to get Started?</h2>
                    <a class="btn btn-lg btn-primary" href="<?php echo get_url("/register.php")?>">Sign up Now!</a>
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; FaceFacts 2023</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="<?php echo get_url('/privacy_policy.php'); ?>">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="<?php echo get_url('/FAQ.php'); ?>">FAQ</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="<?php echo get_url('/privacy_policy.php'); ?>">Contact</a>
                    </div>
                </div>
            </div>
        </footer>