<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include './scripts/LoginScript.php';
include './scripts/CheckCookie.php';
include './scripts/MyDB.php';

$db = new Database();
$dbCon = $db->getConnection();
$usr = "";
if (isset($_POST['submitted'])) {
    $logScript = new Login($dbCon);
    $warnText = $logScript->authenticate();
    $usr = $_POST['usrName'];
}
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/site_template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>eReserve - Login</title>
        <link href="styles/mainstyle.css" rel="stylesheet" type="text/css" />
        <!-- InstanceBeginEditable name="Attachments" -->
        <link href="styles/loginStyle.css" rel="stylesheet" type="text/css" />
        <link href="styles/mainTileStyle.css" rel="stylesheet" type="text/css" />
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
                    <span id="mainTitle">Room Reservation System</span>
                    <br />
                    <span id="subTitle">University of Moratuwa</span>
                </div>
            </div>

            <div class="titleBar">
                <!-- InstanceBeginEditable name="PageTitle" -->
                Welcome
                <!-- InstanceEndEditable -->		
                <div id="logName">
                    <!-- InstanceBeginEditable name="UserType" -->
                    <?php
                    $db = new Database();
                    $dbCon = $db->getConnection();

                    $chc = new CheckCookie($dbCon);
                    $result = $chc->checkCook("guest");
                    ?>
                    <!-- InstanceEndEditable -->
                </div>    
            </div>

            <div class="sidebar"> 
                <!-- InstanceBeginEditable name="SideBar" -->
                <a href="calendar.php">
                    <div class="tile" id="tile1">
                        <div class="tileIcon"><img src="images/calendar_icon.png" alt="calendar_icon"/></div>
                        <br/>
                        <div class="tileText">Reservation<br/> CALENDAR</div>
                    </div>
                </a>
                <!-- InstanceEndEditable -->
            </div>


            <div class="content">
                <!-- InstanceBeginEditable name="Content" -->
                <form id="loginForm" method="post" action="login.php">
                    <table>
                        <tr><td><h1>Login</h1></td></tr>
                        <tr>
                            <th width="100px"></th><th width="200px"></th><th></th>
                        </tr>
                        <tr>
                            <td><label>Username</label></td>
                            <td><input type="text" id="usrName" name="usrName" class="logBox" value="<?php echo $usr; ?>"/></td>
                            <td><span id='loginForm_usrName_errorloc' class='error'></span></td>
                        </tr>
                        <tr>
                            <td><label>Password</label></td>
                            <td><input type="password" id="passwd" name="passwd" class="logBox" /></td>
                            <td><span id='loginForm_passwd_errorloc' class='error'></span></td>
                        </tr> 
                        <tr>
                            <td></td>
                            <td><input type="submit" id="loginBtn" value="login"/></td>
                            <td>
                                <span id='warnText' class='error'>
                                    <?php
                                    //Shows the warning for wrong username or password
                                    if (isset($warnText)) {
                                        echo $warnText;
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>                        
                    </table>  
                    <input type="hidden" name="submitted" value="1"/>

                </form>  
                <div class="eResLogo"></div>
                <script type='text/javascript'>
                    //Validates the input values
                    var frmvalidator = new Validator("loginForm");
                    frmvalidator.EnableOnPageErrorDisplay();
                    frmvalidator.EnableMsgsTogether();
                    frmvalidator.addValidation("usrName", "req", "Please provide your username");
                    frmvalidator.addValidation("passwd", "req", "Please provide your password");
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
