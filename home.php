<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include './scripts/CheckCookie.php';
include './scripts/MyDB.php';

$chc = new CheckCookie();

session_start();
if (!isset($_SESSION['username'])) {
    $db = new Database();
    $dbCon = $db->getConnection();
    $result = $chc->checkCook($dbCon, "user");

    if ($result != "guest") {
        $_SESSION['username'] = $result[0];
        $_SESSION['first'] = $result[1];
        $_SESSION['last'] = $result[2];
        $_SESSION['type'] = $result[3];
    }
} else {
    if ($_SESSION['type'] != "user") {
//        header("Location:" . $chc->redirectPage($_SESSION['type']));
    }
}
$usrname = $_SESSION['username'];
$first_name = $_SESSION['first'];
$last_name = $_SESSION['last'];
$type = $_SESSION['type'];
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/site_template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>eReserve</title>
        <link href="styles/mainstyle.css" rel="stylesheet" type="text/css" />
        <!-- InstanceBeginEditable name="Attachments" -->
        <link href="styles/homeStyle.css" rel="stylesheet" type="text/css" />
        <link href="styles/mainTileStyle.css" rel="stylesheet" type="text/css" />
        <!-- InstanceEndEditable -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>	
    </head>

    <body>	
        <div class="container">

            <div class="header">
                <div class="logo" id="logo">
                    <a href="home.php">
                        <img src="images/logo.png" alt="eReserve Logo" name="ereserve_logo" id="ereserve_logo" />
                    </a>      
                </div>    
                <div class="siteName">
                    <span id="mainTitle">University Room Reservation System</span>
                    <br />
                    <span id="subTitle">University of Moratuwa</span>
                </div>
            </div>

            <div class="titleBar">
                <!-- InstanceBeginEditable name="PageTitle" -->Home<!-- InstanceEndEditable -->		
                <div id="logName">
                    <!-- InstanceBeginEditable name="UserType" -->
                    <?php
                    if (isset($usrname)) {
                        echo ' 
                            	<a href="scripts/Logout.php">
                                    <input type="submit" name="logout" id="logout" value="logout" class="redBtn"/>
                		</a>
                            ';
                        echo $first_name . " " . $last_name;
                    }
                    ?>
                    <!-- InstanceEndEditable -->
                </div>    
            </div>

            <div class="sidebar"> 
                <!-- InstanceBeginEditable name="SideBar" --><!-- InstanceEndEditable -->
            </div>


            <div class="content">
                <!-- InstanceBeginEditable name="Content" -->
                <table>
                    <tr>
                        <td>
                            <a href="calendar.php">
                                <div class="tile" id="tile1">
                                    <div class="tileIcon"><img src="images/calendar_icon.png" alt="calendar_icon"/></div>
                                    <br/>
                                    <div class="tileText">Reservation<br/> CALENDAR</div>
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="request.php">
                                <div class="tile" id="tile2">
                                    <div class="tileIcon"><img src="images/request_icon.png" alt="request_icon"/></div>
                                    <br/>
                                    <div class="tileText">REQUEST<br/>Reservations</div>
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="cancel.php">
                                <div class="tile" id="tile3">
                                    <div class="tileIcon"><img src="images/cancel_icon.png" alt="cancel_icon"/></div>
                                    <br/>
                                    <div class="tileText">CANCEL<br/>Reservations</div>
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="my_history.php">
                                <div class="tile" id="tile4">
                                    <div class="tileIcon"><img src="images/history_icon.png" alt="history_icon"/></div>
                                    <br/>
                                    <div class="tileText">Reservation<br/> HISTORY</div>
                                </div> 
                            </a>
                        </td>
                    </tr>                    
                </table>
                <!-- InstanceEndEditable --> 	

            </div> 

        </div>
        <!--
        <div class="footer">    
                <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="8" direction="left">
                        Copyrights Reserved &nbsp;&nbsp;&nbsp;&nbsp; &copy;2013 Udith Arosha Gunaratna
        </marquee>
        </div>
        -->
    </body>
    <!-- InstanceEnd --></html>
