<?php
require(__DIR__ . "/../partials/nav.php");
if (!has_role("viewer")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: index.php"));
}
?>
<?php
if (!has_role("viewer")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: index.php"));
}
error_log($_GET['p']);
if (isset($_GET['p'])){
    if ($_GET['p'] == 500){
        $product = "$5 Starbucks Gift Card";
    }
    else if ($_GET['p'] == 1000){
        $product = "$10 Starbucks Gift Card";
    }
    else if ($_GET['p'] == 1500){
        $product = "$15 Starbucks Gift Card";
    }
    else if ($_GET['p'] == 2500){
        $product = "$25 Starbucks Gift Card";
    }
    else{
        $product = "Unknown";
    }
    $user = get_user_id();
    $db = getDB();
    $stmt = $db->prepare("SELECT current_tokens FROM ViewerAccountData WHERE id = :id");
    $r = $stmt->execute([":id" => $user]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_tokens = $result["current_tokens"];
    if ($total_tokens >= $_GET['p']){
        $total_tokens = $total_tokens - $_GET['p'];
        $stmt = $db->prepare("UPDATE ViewerAccountData SET current_tokens = :current_tokens WHERE id = :id");
        $r = $stmt->execute([":current_tokens" => $total_tokens, ":id" => $user]);
        $stmt = $db->prepare("INSERT INTO ViewerPrizes (viewer_id, prizes_id, gc_code, tokens_paid) VALUES(:user_id, :prizes_id, :gc_code, :cost)");
        $r = $stmt->execute([":user_id" => 1, ":prizes_id" => 1, "gc_code" => "5878997654354634", ":cost" => $_GET['p']]);
        flash("Purchase successful", "success");
        $go = True;
    }
    else{
        flash("You do not have enough tokens to purchase this item", "danger");
        $go = False;
    }
}
?>
<?php if ($go): ?>
<section class="py-5" id='all'>
                <div class="container px-5 my-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-6">
                            <div class="text-center mb-5">
                                <h1 class="fw-bolder">Thanks for your purchase!</h1>
                                <p class="lead fw-normal text-muted mb-0" id="product"><?php echo $product ?></p>
</div>
                        </div>
                    </div>
                    <div class="row gx-5">
                        <div class="col-12"><p id=order> </p></div>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-6">
                            <div class="text-center mb-5">
                                <p class="lead fw-normal text-muted">You code: 5878997654354634</p>
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
        <?php endif ?>
        <?php require(__DIR__ . "../../partials/flash.php");?>