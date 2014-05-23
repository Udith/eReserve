<!DOCTYPE html>
<?php
include_once './global.inc.php';
include './scripts/MyDB.php';

session_start();
if (isset($_SESSION['username'])) {
    header("Location:./home.php");
}

if (isset($_GET['err'])) {
    if ($_GET['err'] == "empty") {
        $page_err = "Login failed! Empty username or password";
    } else if ($_GET['err'] == "err_cred") {
        $page_err = "Login failed! Wrong username or password";
    }
}

$page_title = "login";
$page_name = "Welcome to eReserve";
?>
<html>
    <head>
        <?php include './header.inc.php'; ?>
    </head>

    <body>	
        <?php include './navbar.php'; ?>

        <div class="container">
            <h1>Hall Reservation System<small>&nbsp;-&nbsp;<? echo institute; ?></small></h1>
            <hr>

            <div class="row row-offcanvas row-offcanvas-right">

                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>
                    <div class="jumbotron login-jumbotron">
                        <h1>Login</h1>
                        <?php
                        if (isset($page_err)) {
                            ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong><? echo $page_err; ?></strong>
                            </div>
                        <?php } ?>
                        <form id="loginForm" class="form-horizontal" role="form" method="post" action="./php_scripts/loginScript.php">
                            <div class="form-group">
                                <label for="user" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="user" name="user" placeholder="username"
                                           value="<?php
                                           if (isset($_GET["namestr"])) {
                                               echo $_GET["namestr"];
                                           }
                                           ?>"
                                           >
                                </div>
                                <label class="col-sm-2">
                                    <span id='loginForm_user_errorloc' class='text-danger'></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="pass" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="password">
                                </div>
                                <label class="col-sm-2">
                                    <span id='loginForm_pass_errorloc' class='text-danger'></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Log in</button>
                                </div>
                            </div>
                        </form>                    
                    </div>          
                </div><!--/span-->

                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                    <button type="button" class="btn btn-warning btn-lg" id="cal-btn">
                        <img src="images/calendar_icon.png" alt="calendar icon" class="img-rounded" /></br>
                        Reservation Calendar
                    </button>
                </div><!--/span-->
            </div><!--/row-->


        </div><!--/.container-->
        <footer>
            <?php include './footer.php'; ?>
        </footer>

        <?php include './scripts.inc.php'; ?>
        <script type='text/javascript'>
            //Validates the input values
            var formValidator = new Validator("loginForm");
            formValidator.EnableOnPageErrorDisplay();
            formValidator.EnableMsgsTogether();
            formValidator.addValidation("user", "req", "required");
            formValidator.addValidation("pass", "req", "required");

            $(document).ready(function() {
                $(document).on("click", "#cal-btn", function(e) {
                    e.preventDefault();
                    window.location.assign("calendar.php");
                });
            });
        </script>
    </body>
</html>
