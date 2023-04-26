<?php
require(__DIR__ . "/../partials/nav.php");
?>
<header class="bg-dark py-5">
                <div class="container px-5">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2">Welcome to FaceFacts!</h1>
                                <p class="lead fw-normal text-white-50 mb-4">The modern way to advertize</p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                    <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Get Started</a>
                                    <a class="btn btn-outline-light btn-lg px-4" href="<?php echo get_url('/about_us.php'); ?>">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="img/FaceFactsLogo.png" alt="FaceFacts Logo" style="height:400px;width:400px;"/></div>
                    </div>
                </div>
            </header>
            <!-- Features section-->
            <section class="py-5" id="features">
                <div class="container px-5 my-5">
                    <div class="row gx-5">
                        <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">We've brought Advertising to the 21st century:</h2></div>
                        <div class="col-lg-8">
                            <div class="row gx-5 row-cols-1 row-cols-md-2">
                                <div class="col mb-5 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                                    <h2 class="h5">Advanced AI Reporting</h2>
                                    <p class="mb-0">FaceFacts flagship feature, FaceFacts uses highly trained AI models to record the changes in a person'
                                        s facial expressions and emotions as they watch an Advertisement. The AI will automatically compile results into an easy-to-read graph and give detailed feedback
                                        about how a patricular group felt about the ad.
                                    </p>
                                </div>
                                <div class="col mb-5 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                                    <h2 class="h5">Access to Test Groups</h2>
                                    <p class="mb-0">FaceFacts eliminates the need for advertising agencies to gather and form their own focus groups
                                        when testing out a new campaign. FaceFacts allows advertisers access to our pool of viewers, eliminating the need to source these focus groups yourself.
                                    </p>
                                </div>
                                <div class="col mb-5 mb-md-0 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                                    <h2 class="h5">Get paid to watch ads!</h2>
                                    <p class="mb-0">Not an advertiser? FaceFacts has still got you covered! Sign up to be a viewer now, and you can get
                                        paid to watch ads! You can even choose which ads you want to watch, and can redeem your earnings for gift cards or other great prizes!
                                    </p>
                                </div>
                                <div class="col h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                                    <h2 class="h5">Secure and anonymous</h2>
                                    <p class="mb-0">Here at FaceFacts, we take privacy <b>very</b> seriously. All information reported back to advertisers is gaurenteed to stay anonymous,
                                    and have any personally identidifiable information anyonimized before it is stored. For more information, please check out our 
                                <a href="privacy_policy.php">privacy policy</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Testimonial section-->
            <div class="py-5 bg-light">
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-10 col-xl-7">
                            <div class="text-center">
                                <div class="fs-4 mb-4 fst-italic">"Predicting the Future isn't magic, it's Artificial Intelligence"</div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="fw-bold">
                                        Dave Waters
                                        <span class="fw-bold text-primary mx-1">/</span>
                                        Founder, Coursera
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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