<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include './scripts/CheckCookie.php';
include './scripts/MyDB.php';
include './scripts/AddNew.php';

$chc = new CheckCookie();
$db = new Database();
$dbCon = $db->getConnection();

$roomID = "";
$roomName = "";
$capacity = "";

if (isset($_POST['submitted'])) {
    $addScript = new AddNew($dbCon);
    $fbMessage = $addScript->addRoom();
    $roomID = $_POST['roomID'];
    $roomName = $_POST['roomName'];
    $capacity = $_POST['capacity'];
}

session_start();
if (!isset($_SESSION['username'])) {
    $db = new Database();
    $dbCon = $db->getConnection();
    $result = $chc->checkCook($dbCon, "admin");

    if ($result != "guest") {
        $_SESSION['username'] = $result[0];
        $_SESSION['first'] = $result[1];
        $_SESSION['last'] = $result[2];
        $_SESSION['type'] = $result[3];
    }
} else {
    if ($_SESSION['type'] != "admin") {
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
        <link href="styles/addRoomStyle.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='js/gen_validatorv31.js'></script>
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

            <div class="titleBar oadminTitle">
                <!-- InstanceBeginEditable name="PageTitle" -->Add New Room<!-- InstanceEndEditable -->		
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
                        <a href="addUser.php"><li>Add New User</li></a>
                    </ul>
                </div>
                <!-- InstanceEndEditable -->
            </div>


            <div class="content">
                <!-- InstanceBeginEditable name="Content" -->
                <form id="addRoom" method="post" action="addRoom.php">
                    <table>
                        <tr>
                            <td>
                                Room ID
                            </td>
                            <td>
                                <input id="roomID" name="roomID" type="text" class="textBox" value="<?php echo $roomID; ?>"/>
                            </td>
                            <td>
                                <span id='addRoom_roomID_errorloc' class='error'></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Room Name
                            </td>
                            <td>
                                <input id="roomName" name="roomName" type="text" class="textBox" value="<?php echo $roomName; ?>"/>
                            </td>
                            <td>
                                <span id='addRoom_roomName_errorloc' class='error'></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Department
                            </td>
                            <td>
                                <select name="department" class="dropList">
                                    <?php
                                    include_once './scripts/GetDepartments.php';
                                    getDepts($dbCon);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Capacity
                            </td>
                            <td>
                                <input id="capacity" name="capacity" type="text" class="textBox" value="<?php echo $capacity; ?>"/>
                            </td>
                            <td>
                                <span id='addRoom_capacity_errorloc' class='error'></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Air Conditioned
                            </td>
                            <td colspan="2">
                                <input id="air_y" name="air" type="radio" value="Y" checked="true"/>
                                <label for="air_y">Yes</label>&emsp;
                                <input id="air_n" name="air" type="radio" value="N" />
                                <label for="air_n">No</label>&emsp;

                            </td>
                        </tr>                        
                        <tr>
                            <td>
                                Computer Lab
                            </td>
                            <td colspan="2">
                                <input id="cLab_y" name="cLab" type="radio" value="Y" checked="true"/>
                                <label for="cLab_y">Yes</label>&emsp;
                                <input id="cLab_n" name="cLab" type="radio" value="N" />
                                <label for="cLab_n">No</label>&emsp;

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input id="addBtn" name="addBtn" type="submit" value="Add Room" class="greenBtn"/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">                               
                                <?php
                                if (isset($fbMessage)) {
                                    echo $fbMessage;
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="submitted" value="1"/>
                </form>
                <script type='text/javascript'>
                    //Validates the input values
                    var frmvalidator = new Validator("addRoom");
                    frmvalidator.EnableOnPageErrorDisplay();
                    frmvalidator.EnableMsgsTogether();
                    frmvalidator.addValidation("roomID", "req", "Provide a valid Room ID");
                    frmvalidator.addValidation("roomID", "maxlen=6", "Room ID length should be 6");
                    frmvalidator.addValidation("roomID", "minlen=6", "Room ID length should be 6");
                    frmvalidator.addValidation("roomName", "req", "Provide a valid Room Name");
                    frmvalidator.addValidation("capacity", "req", "Provide a valid capacity");
                    frmvalidator.addValidation("capacity", "num", "Provide a valid capacity");
                    frmvalidator.addValidation("capacity", "gt=0", "Provide a valid capacity");
                </script>

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
