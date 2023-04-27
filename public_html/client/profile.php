<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<style>li{
    color:black;
}
</style>
<section class="bg-light py-5">
                <div class="container px-5 my-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder">Upgrade your plan today!</h1>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <!-- Pricing card free-->
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-5 mb-xl-0">
                                <div class="card-body p-5">
                                    <div class="small text-uppercase fw-bold text-muted">Small Business</div>
                                    <div class="mb-3">
                                        <span class="display-4 fw-bold"><i>$450</i></span>
                                        <span class="text-muted">Current Plan</span>
                                    </div>
                                    <ul class="list-unstyled mb-4">
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            <strong>Run your first ad totally free!</strong>
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            1 Campaign at a time
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Real-time analytics from the F.E.R.R.E.T.
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Access to the FaceFacts platform of test viewers
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Standard tokens for Viewers
                                        </li>
                                        <li class="mb-2 text-muted">
                                            <i class="bi bi-x"></i>
                                            Ad Length Restricted to 30 seconds
                                        </li>
                                        <li class="mb-2 text-muted">
                                            <i class="bi bi-x"></i>
                                            72 hour Campaign Duration
                                        </li>
                                        <li class="mb-2 text-muted">
                                            <i class="bi bi-x"></i>
                                            No Access to Campaign Recomendations
                                        </li>
                                        <li class="text-muted">
                                            <i class="bi bi-x"></i>
                                            No Dedicated Support Team
                                        </li>
                                    </ul>
                                    <div class="d-grid"><a class="btn btn-outline-primary disabled"  href="#!">Choosen plan</a></div>
                                </div>
                            </div>
                        </div>

                        
                        <!-- Pricing card pro-->
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-5 mb-xl-0">
                                <div class="card-body p-5">
                                    <div class="small text-uppercase fw-bold">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        Pro
                                    </div>
                                    <div class="mb-3">
                                        <span class="display-4 fw-bold">$1650</span>
                                        <span class="text-muted">/ mo.</span>
                                    </div>
                                    <ul class="list-unstyled mb-4">
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            <strong>Up 3 Concurent Campaigns</strong>
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Real-time analytics from the F.E.R.R.E.T.
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Access to the FaceFacts platform of test viewers
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Bonus tokens for Viewers
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Unlimited Ad Length
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Professional Support Team (M-F, 9am-5pm EST)
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Campaign Recomendations based on the F.E.R.R.E.T.'s analysis of the Ad
                                        </li>
                                        <li class="text-muted">
                                            <i class="bi bi-x"></i>
                                            2 Week Campaign Duration
                                        </li>
                                    </ul>
                                    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>
    <script>
      paypal.Buttons({
        // Order is created on the server and the order id is returned
        createOrder() {
          return fetch("/my-server/create-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            // use the "body" param to optionally pass additional order information
            // like product skus and quantities
            body: JSON.stringify({
              cart: [
                {
                  sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
                  quantity: "YOUR_PRODUCT_QUANTITY",
                },
              ],
            }),
          })
          .then((response) => response.json())
          .then((order) => order.id);
        },
        // Finalize the transaction on the server after payer approval
        onApprove(data) {
          return fetch("/my-server/capture-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              orderID: data.orderID
            })
          })
          .then((response) => response.json())
          .then((orderData) => {
          });
        }
      }).render('#paypal-button-container');
    </script>
                                </div>
                            </div>
                        </div>
                        <!-- Pricing card enterprise-->
                        <div class="col-lg-6 col-xl-4">
                            <div class="card mb-5 mb-xl-0">
                                <div class="card-body p-5">
                                    <div class="small text-uppercase fw-bold text-muted">Enterprise</div>
                                    <div class="mb-3">
                                        <span class="display-4 fw-bold">$2499</span>
                                        <span class="text-muted">/ mo.</span>
                                    </div>
                                    <ul class="list-unstyled mb-4">
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            <strong>Up to 5 Concurent Campaigns</strong>
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Real-time analytics from the F.E.R.R.E.T.
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Access to the FaceFacts platform of test viewers
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Double tokens for Viewers
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Unlimited Ad Length
                                        </li>
                                        
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Unlimited Campaign Duration
                                        </li>
                                        <li class="">
                                            <i class="bi bi-check text-primary"></i>
                                            Dedicated Enterprise Professional Support Team (24/7)
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check text-primary"></i>
                                            Campaign Recomendations based on the F.E.R.R.E.T.'s analysis of the Ad
                                        </li>
                                    </ul>
                                    <div class='button btn btn-primary btn-lg' id='paypal-button-container'>Contact Us to upgrade to Enterprise</div>
    </script>
                                </div>
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
        
        
                
            
            