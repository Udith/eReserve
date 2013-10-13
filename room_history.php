<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include './scripts/CheckCookie.php';
include './scripts/MyDB.php';

$chc = new CheckCookie();

session_start();
if (!isset($_SESSION['username'])) {
    $db = new Database();
    $dbCon = $db->getConnection();
    $result = $chc->checkCook($dbCon, "radmin");

    if ($result != "guest") {
        $_SESSION['username'] = $result[0];
        $_SESSION['first'] = $result[1];
        $_SESSION['last'] = $result[2];
        $_SESSION['type'] = $result[3];
    }
} else {
    if ($_SESSION['type'] != "radmin") {
        header("Location:" . $chc->redirectPage($_SESSION['type']));
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
        <link href="styles/navMenu.css" rel="stylesheet" type="text/css" />
        <link href="styles/roomHistoryStyle.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.10.2.min.js" ></script>
        <script src="js/common.js" ></script>
        <script src="js/roomHistory.js" ></script>
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

            <div class="titleBar adminTitle">
                <!-- InstanceBeginEditable name="PageTitle" -->Room History<!-- InstanceEndEditable -->		
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
                <!-- InstanceBeginEditable name="SideBar" -->
                <div id="navigation">
                    <ul>
                        <a href="admin.php"><li>Home</li></a>
                        <a href="complaints.php"><li>Complaints</li></a>
                    </ul>
                </div>
                <!-- InstanceEndEditable -->
            </div>


            <div class="content">
                <!-- InstanceBeginEditable name="Content" -->
                <table id="historyTable" class="dataTable" cellspacing="0"></table>
                <div class="overlay" id="overlay">
                    <div id="resDetails">
                        <table id="reqTable">
                            <tr>
                                <td width="120"><strong>Reservation ID</strong></td>
                                <td style="color: #112a7c" width="400"><span id="rsID"></span></td>
                            </tr>
                            <tr>
                                <td width="120"><strong>Room ID</strong></td>
                                <td style="color: #112a7c" width="400"><span id="rmID"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Room Name</strong></td>
                                <td style="color: #112a7c"><span id="rmName"></span></td>
                            </tr>
                            <tr>
                                <td width="120"><strong>User ID</strong></td>
                                <td style="color: #112a7c" width="400"><span id="uID"></span></td>
                            </tr>
                            <tr>
                                <td><strong>User Name</strong></td>
                                <td style="color: #112a7c"><span id="uName"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Date</strong></td>
                                <td style="color: #112a7c"><span id="rsDate"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Time Slot</strong></td>
                                <td style="color: #112a7c"><span id="rsTime"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Purpose</strong></td>
                                <td style="color: #112a7c"><span id="rsPurpose"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Equipments</strong></td>
                                <td style="color: #112a7c"><span id="rsEquip"></span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="text-align:right;">
                                    <button id="closeBtn" name="closeBtn" class="redBtn" type="button">Close</button>                                    
                                </td>
                            </tr>                            
                        </table>
                    </div>
                </div>
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
