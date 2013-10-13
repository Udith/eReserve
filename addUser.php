<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include './scripts/CheckCookie.php';
include './scripts/MyDB.php';
include './scripts/AddNew.php';

$chc = new CheckCookie();
$db = new Database();
$dbCon = $db->getConnection();

$username = "";
$firstName = "";
$lastName = "";
$email = "";

if (isset($_POST['submitted'])) {
    $addScript = new AddNew($dbCon);
    $fbMessage = $addScript->addUser();
    $username = $_POST['userName'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
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
        <link href="styles/addUserStyle.css" rel="stylesheet" type="text/css" />
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
                <!-- InstanceBeginEditable name="PageTitle" -->Add New User<!-- InstanceEndEditable -->		
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
                        <a href="addRoom.php"><li>Add New Room</li></a>
                    </ul>
                </div>
                <!-- InstanceEndEditable -->
            </div>


            <div class="content">
                <!-- InstanceBeginEditable name="Content" -->
                <form id="addUser" method="post" action="addUser.php">
                    <table>
                        <tr>
                            <td>
                                Username
                            </td>
                            <td>
                                <input id="userName" name="userName" type="text" class="textBox" value="<?php echo $username; ?>"/>
                            </td>
                            <td>
                                <span id='addUser_userName_errorloc' class='error'></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                First Name
                            </td>
                            <td>
                                <input id="firstName" name="firstName" type="text" class="textBox" value="<?php echo $firstName; ?>"/>
                            </td>
                            <td>
                                <span id='addUser_firstName_errorloc' class='error'></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Last Name
                            </td>
                            <td>
                                <input id="lastName" name="lastName" type="text" class="textBox" value="<?php echo $lastName; ?>"/>
                            </td>
                            <td>
                                <span id='addUser_lastName_errorloc' class='error'></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Password
                            </td>
                            <td>
                                <input id="passw" name="passw" type="password" class="textBox"/>
                            </td>
                            <td>
                                <span id='addUser_passw_errorloc' class='error'></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Retype Password
                            </td>
                            <td>
                                <input id="repassw" name="repassw" type="password" class="textBox"/>
                            </td>
                            <td>
                                <span id='addUser_repassw_errorloc' class='error'></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                <input id="email" name="email" type="text" class="textBox" value="<?php echo $email; ?>"/>
                            </td>
                            <td>
                                <span id='addUser_email_errorloc' class='error'></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                User Type
                            </td>
                            <td colspan="2">
                                <input id="usrtype_1" name="usrtype" type="radio" value="user" checked="true"/>
                                <label for="usrtype_1">User</label>&emsp;
                                <input id="usrtype_2" name="usrtype" type="radio" value="radmin"/>
                                <label for="usrtype_2">Room Administrator</label>&emsp;
                                <input id="usrtype_3" name="usrtype" type="radio" value="staff"/>
                                <label for="usrtype_3">Staff</label>&emsp;
                                <input id="usrtype_4" name="usrtype" type="radio" value="admin"/>
                                <label for="usrtype_4">Administrator</label>&emsp;

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input id="addBtn" name="addBtn" type="submit" value="Add User" class="greenBtn"/></td>
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
                    var frmvalidator = new Validator("addUser");
                    frmvalidator.EnableOnPageErrorDisplay();
                    frmvalidator.EnableMsgsTogether();
                    frmvalidator.addValidation("userName", "req", "Provide a valid username");
                    frmvalidator.addValidation("userName", "maxlen=6", "Username length should be 6");
                    frmvalidator.addValidation("userName", "minlen=6", "Username length should be 6");
                    frmvalidator.addValidation("firstName", "req", "Provide a valid first name");
                    frmvalidator.addValidation("lastName", "req", "Provide a valid last name");
                    frmvalidator.addValidation("passw", "req", "Please provide a password");
                    frmvalidator.addValidation("repassw", "req", "Please retype the password");
                    frmvalidator.addValidation("repassw", "eqelmnt=passw", "Passwords donot match");
                    frmvalidator.addValidation("email", "req", "Provide a valid email address");
                    frmvalidator.addValidation("email", "email", "Provide a valid email address");
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
