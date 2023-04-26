<?php
require(__DIR__ . "/../partials/nav.php");
?>
<header class="py-5">
                <div class="container px-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-xxl-6">
                            <div class="text-center my-5">
                                <h1 class="fw-bolder mb-3">Our mission is to provide advertisers with a powerful new tool to measure the effectiveness of their campaigns.</h1>
                                <p class="lead fw-normal text-muted mb-4">At the same time, we stive to create a platform where viewers willingly seek out these advertisments,
                                    and are rewarded for their time and attention. 
                                </p>
                                <a class="btn btn-primary btn-lg" href="#scroll-target">Read our story</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- About section one-->
            <section class="py-5 bg-light" id="scroll-target">
                <div class="container px-5 my-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="img/FaceFactsLogo.png" alt="F.E.R.R.E.T." /></div>
                        <div class="col-lg-6">
                            <h2 class="fw-bolder">Meet F.E.R.R.E.T.</h2>
                            <p class="lead fw-normal text-muted mb-0">Meet the Facial & Emotional Rapid Response Evaluation Tool (F.E.R.R.E.T.)! The F.E.R.R.E.T. is the leading AI
                                model that drives FaceFacts. It is a facial recognition model that can detect and analyze facial expressions in real time, and deliver those aggregated results back to 
                                the advertiser. The F.E.R.R.E.T. eliminates the needs for participants in focus groups to spend addtional time filling out surveys, and allows advertisers to get a more accurate and at-a-glance results of their campaigns.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About section two-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="img/emotions.jpg" alt="The 7 Universal Human Emotions" style="height: 400px; width: 600px;" />
                    </div>
                        <div class="col-lg-6">
                            <h2 class="fw-bolder">How Does it Work?</h2>
                            <p class="lead fw-normal text-muted mb-0">Dr. Paul Ekman was the first Psychatrist credited with coming up with "The 7 Universal Emotions" in the mid 1970's. His studies found that as a species,
                                humans have at least 7 different emotions that are universally recognized across all cultures. These emotions are: Anger, Disgust, Fear, Happiness, Neutral, Sadness, and Surprise. Even more interestingly, 
                                Dr. Ekman found that these emotions are expressed in the same way across all cultures. For example, when someone is happy, they will smile. When someone is sad, they will frown. This idea (now known as "Emotion Theroy") has been reconfirmed and expanded upon by many other psychologists and researchers since then.
                                FaceFacts utilized this idea while programming the F.E.R.R.E.T. so that it can analyze the facial expressions of participants in real time, and then aggregates the results to give advertisers a better idea of how their campaigns are being received.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
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