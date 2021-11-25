<?php include_once "layouts/header.php"; ?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Verify Code</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Verify Code</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Verify Code </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="../Routes/web.php" method="post">
                                        <input type="number" name="code" placeholder="Code">
                                        <?php 
                                            if(isset($_SESSION['message']['errors']['wrong-code'])){
                                                echo $_SESSION['message']['errors']['wrong-code'];
                                            }
                                        ?>
                                        <input type="hidden" name="verify-email" value="<?= $_GET['verify-email'] ?>">
                                        <input type="hidden" name="forget" value="<?= $_GET['forget'] ?>">
                                        <div class="button-box">
                                            <button type="submit" name="verify-email-post"><span>Verify</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "layouts/footer.php"; ?>