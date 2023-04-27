<?php
require(__DIR__ . "/../partials/nav.php");
if (!has_role("viewer")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: index.php"));
}
?>
<!-- About section one-->
<section class="py-5">
                <div class="container px-5 my-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder">Welcome to the FaceFacts Store!</h1>
                        <p class="lead fw-normal text-muted mb-0">Spend your tokens here!</p>
                    </div>
                    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="input-group mb-3">
                <input class="form-control" type="search" name="role" placeholder="Search Campaigns" />
                <input class="btn btn-primary" type="submit" value="Search" />
            </div>
        </form>
                    <div class="row gx-5">
                        <div class="col-lg-6">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-3 mb-3" src="img/store/starbucks.png" alt="..." style="height:300px;"/>
                                <br />
                                <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" onclick="purchase(500)">$5 Starbucks Card</a>
                                <br />
                                <p> 500 tokens</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-3 mb-3" src="img/store/starbucks.png" alt="..." style="height:300px;"/>
                                <br />
                                <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="#!">$10 Starbucks Card</a>
                                <br />
                                <p> 1000 tokens</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mb-5 mb-lg-0">
                                <img class="img-fluid rounded-3 mb-3" src="img/store/starbucks.png" style="height:300px;" alt="..." />
                                <br />
                                <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="#!">$15 Starbucks Carde</a>
                                <br />
                                <p> 1500 tokens</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative">
                                <img class="img-fluid rounded-3 mb-3" src="img/store/starbucks.png" style="height:300px;" alt="..." />
                                <br />
                                <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="#!">$25 Starbucks Card</a>
                                <br />
                                <p> 2500 tokens</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; Your Website 2023</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="#!">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Terms</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Contact</a>
                    </div>
                </div>
            </div>
        </footer>

        <script type='text/javascript'>
            function purchase(cost){
                if (confirm("Are you sure you'd like to make this purchase? it will cost " + cost + " tokens.")) {
                    document.location.href = 'purchase.php?p=' + cost;
                } else {
                    // Do nothing!
                    alert("Purchase Cancelled!");
                }
        }
        </script>