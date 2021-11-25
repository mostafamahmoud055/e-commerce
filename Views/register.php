
<?php include_once "layouts/header.php";?>
<?php include_once "layouts/nav.php";?>

        <div class="login-register-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg2">
                                    <h4> register </h4>
                                </a>
                                <!--<a data-toggle="tab" href="#lg1">
                                    <h4> login </h4>
                                </a>-->
                            </div>
                            <div class="tab-content">
                                <!--<div id="lg1" class="tab-pane active">
                                   <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="#" method="post">
                                                <input type="text" name="user-name" placeholder="Username">
                                                <input type="password" name="user-password" placeholder="Password">
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input type="checkbox">
                                                        <label>Remember me</label>
                                                        <a href="#">Forgot Password?</a>
                                                    </div>
                                                    <button type="submit"><span>Login</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>-->
                                <div id="lg2" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="../Routes/web.php" method="post">
                                                <input type="text" name="name" placeholder="Full Name" value=<?php if(isset($_SESSION['request']['name'])){echo $_SESSION['request']['name'];} ?>>
                                                <input type="phone" name="phone" placeholder="Phone"value=<?php if(isset($_SESSION['request']['phone'])){echo $_SESSION['request']['phone'];} ?>>
                                                <?php if(isset($_SESSION['message']['errors']['phone-exists']))                                                
                                                echo $_SESSION['message']['errors']['phone-exists'];                                        
                                                ?>
                                                <input name="email" placeholder="Email" type="email"value=<?php if(isset($_SESSION['request']['email'])){echo $_SESSION['request']['email'];} ?>>
                                                <?php if(isset($_SESSION['message']['errors']['email']))
                                                foreach($_SESSION['message']['errors']['email'] as $error){
                                                     echo $error;
                                                }
                                                ?>
                                                <?php if(isset($_SESSION['message']['errors']['email-exists']))                                                
                                                     echo $_SESSION['message']['errors']['email-exists'];                                        
                                                ?>
                                                <input type="password" name="password" placeholder="Password">
                                                <?php if(isset($_SESSION['message']['errors']['password']))
                                                foreach($_SESSION['message']['errors']['password'] as $error){
                                                     echo $error;
                                                }
                                                ?>
                                                <input type="password" name="confirm-password" placeholder="confirm Password">
                                                <select name="gender" class="form-control mb-4">
                                                    <option value="m" <?php if(isset($_SESSION['request']['gender'])&&$_SESSION['request']['gender']=='m'){echo 'selected';} ?>>Male</option>
                                                    <option value="f" <?php if(isset($_SESSION['request']['gender'])&&$_SESSION['request']['gender']=='f'){echo 'selected';} ?>>Female</option>
                                                </select>
                                                <div class="button-box">
                                                    <button type="submit" name="register_post"><span>Register</span></button>
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
 <?php include_once "layouts/footer.php";?>