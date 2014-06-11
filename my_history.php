<!DOCTYPE html>
<?php
include_once './global.inc.php';

session_start();
$req_level = 1;

include SCRIPTS_DIR . 'access_ctrl.php';

$page_title = "my history";
$page_name = "My Reservation History";
?>
<html>
    <head>
        <?php include ROOT_DIR . 'header.inc.php'; ?>	
    </head>

    <body>	
        <?php include ROOT_DIR . 'navbar.php'; ?>

        <div class="container">

            <div class="row row-offcanvas row-offcanvas-right">

                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>

                    <div>
                        <table id="my-hist-table" class="table cell-border" cellspacing="0" width="100%">
                            <thead>
                                <tr class="col-header">
                                    <th>Date</th>
                                    <th>Hall ID</th>
                                    <th>Reason</th>                                    
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                            </thead>
                        </table>
                    </div>                    
                </div><!--/span-->

                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">

                    <div class="list-group">
                        <a href="home.php" class="list-group-item"> 
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
                        <a href="my_history.php" class="list-group-item active">
                            <span class="glyphicon glyphicon-time"></span>&nbsp;Reservation History
                        </a>
                    </div>
                    <div class="list-group">

                        <?php if ($user_level >= 2) { ?>
                            <a href="#" class="list-group-item">
                                <span class="glyphicon glyphicon-list-alt"></span>&nbsp;Reservations for My Halls
                            </a>
                        <?php } ?>
                        <?php if ($user_level >= 3) { ?>
                            <a href="calendar.php" class="list-group-item">
                                <span class="glyphicon glyphicon-edit"></span>&nbsp;Manage Reservations
                            </a>
                        <?php } ?>
                        <?php if ($user_level >= 3) { ?>
                            <a href="request.php" class="list-group-item">
                                <span class="glyphicon glyphicon-time"></span>&nbsp;Hall Reservation History
                            </a>
                        <?php } ?>
                        <?php if ($user_level >= 4) { ?>
                            <a href="cancel.php" class="list-group-item">
                                <span class="glyphicon glyphicon-star"></span>&nbsp;Administrator
                            </a>
                        <?php } ?>

                    </div>                    
                </div><!--/span-->
            </div><!--/row-->

        </div><!--/.container-->

        <div style="min-height: 50px;">

        </div>
        <footer>
            <?php include ROOT_DIR . 'footer.php'; ?>
        </footer>
        <?php include ROOT_DIR . 'scripts.inc.php'; ?>
        <script src="js/er_myhistory.js" type="text/javascript"></script>
    </body>
</html>
