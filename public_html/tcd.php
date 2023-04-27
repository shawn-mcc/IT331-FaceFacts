<?php
require(__DIR__ . "/../partials/nav.php");
?>
<!-- About section one-->
<section class="py-5 bg-light" id="scroll-target">
    <div class="container px-5 my-5">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="img/FaceFactsLogo.png" alt="F.E.R.R.E.T." /></div>
            <div class="col-lg-6">
                <h2 class="fw-bolder">Hi there Shawn!</h2>
                <p class="lead fw-normal text-muted mb-0">
                    It looks like there is <strong>1</strong> new video you qualify to view.
                    <br />
                    <a class="btn btn-primary" href="#offers">View Offers Now!</a>
                </p>
            </div>
        </div>

    </div>

</section>
<!-- About section two-->
<section class="py-5" id="offers">
    <div class="container px-5 my-5">
        <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="input-group mb-3">
                <input class="form-control" type="search" name="role" placeholder="Availible Offers" />
                <input class="btn btn-primary" type="submit" value="Search" />
            </div>
        </form>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Description</th>
                <th>Reward</th>
                <th>Availible Until</th>
                <th>View</th>
            </thead>
            <tbody>
                <tr>
                    <td>NJIT Greek Life</td>
                    <td>Come join Greek Life today!</td>
                    <td>10 <img src="<?php echo get_url('/img/token.png'); ?>" style="height:20px;"></td>
                    <td>4/31/2023</td>
                    <td><a class="btn btn-secondary" href="<?php echo get_url('/offer.php'); ?>">View</a></td>
                </tr>
            </tbody>
        </table>

    </div>
</section>
<!-- Footer-->
<footer class="bg-dark py-4 mt-auto">
    <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto">
                <div class="small m-0 text-white">Copyright &copy; FaceFacts 2023</div>
            </div>
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