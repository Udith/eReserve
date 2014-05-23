<!DOCTYPE html>
<?php
include_once './global.inc.php';
include './scripts/MyDB.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location:./login.php");
}

$page_title = "home";
$page_name = "Home";
?>

<html>
    <head>
        <?php include './header.inc.php'; ?>
    </head>

    <body>	
        <?php include './navbar.php'; ?>

        <div class="container">

            <div class="row row-offcanvas row-offcanvas-right">

                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>

                    <div class="row">


                        <div class="col-6 col-sm-6 col-lg-5 text-center p0">
                            <a href="calendar.php" style="text-decoration: none;">
                                <div class="home-tile">
                                    <img src="images/calendar_icon.png" alt="calendar icon" class="img-rounded" />
                                    <h2>Reservation Calendar</h2>
                                </div>
                            </a>
                        </div>


                        <div class="col-6 col-sm-6 col-lg-5 text-center p0">
                            <a href="request.php" style="text-decoration: none;">
                                <div class="home-tile">
                                    <img src="images/request_icon.png" alt="calendar icon" class="img-rounded" />
                                    <h2>Request Reservations</h2>
                                </div>
                            </a>
                        </div>


                        <div class="col-6 col-sm-6 col-lg-5 text-center p0">
                            <a href="cancel.php" style="text-decoration: none;">
                                <div class="home-tile">
                                    <img src="images/cancel_icon.png" alt="calendar icon" class="img-rounded" />
                                    <h2>Cancel Reservations</h2>
                                </div>
                            </a>
                        </div>


                        <div class="col-6 col-sm-6 col-lg-5 text-center p0">
                            <a href="my_history.php" style="text-decoration: none;">
                                <div class="home-tile">
                                    <img src="images/history_icon.png" alt="calendar icon" class="img-rounded" />
                                    <h2>Reservation History</h2>
                                </div>
                            </a>
                        </div>

                    </div><!--/row-->
                </div><!--/span-->

                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                    <div class="list-group">
                        <a href="#" class="list-group-item active">
                            <span class="glyphicon glyphicon-home"></span>&nbsp;Home
                        </a>
                        <a href="calendar.php" class="list-group-item">
                            <span class="glyphicon glyphicon-calendar"></span>&nbsp;Reservation Calendar
                        </a>
                        <a href="request.php" class="list-group-item">
                            <span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Request Reservations
                        </a>
                        <a href="cancel.php" class="list-group-item">
                            <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel Reservations
                        </a>
                        <a href="my_history.php" class="list-group-item">
                            <span class="glyphicon glyphicon-time"></span>&nbsp;Reservation History
                        </a>
                        <!--                        <a href="#" class="list-group-item">Link</a>
                                                <a href="#" class="list-group-item">Link</a>
                                                <a href="#" class="list-group-item">Link</a>
                                                <a href="#" class="list-group-item">Link</a>
                                                <a href="#" class="list-group-item">Link</a>-->
                    </div>
                </div><!--/span-->
            </div><!--/row-->
        </div><!--/.container-->
        <footer>
            <?php include './footer.php'; ?>
        </footer>
        <?php include './scripts.inc.php'; ?>
    </body>
</html>
