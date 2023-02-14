<?php
// Path: index.php?page=me
if ($_SERVER['REQUEST_URI'] != '' . $host . '/index.php?page=me') {
    header('Location: ' . $host . '/index.php?page=me');
}
?>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <section class="my-5 py-5">
        <?php if (!isset($_SESSION['LOGGEDIN']) || $_SESSION['LOGGEDIN'] == false) { ?>
            <div class="container py-7">
                <div class="row mt-5">
                    <div class="col-sm-3 col-6 mx-auto">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                            Get Access
                        </button>
                    </div>
                </div>
            </div>
        <?php } else { ?>
        <?php } ?>
    </section>
</div>