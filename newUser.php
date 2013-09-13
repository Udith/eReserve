<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include './scripts/CheckCookie.php';
include './scripts/MyDB.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/site_template.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>eReserve</title>
	<link href="styles/mainstyle.css" rel="stylesheet" type="text/css" />
	<!-- InstanceBeginEditable name="Attachments" -->
        <link href="styles/addUserStyle.css" rel="stylesheet" type="text/css" />
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
			<!-- InstanceBeginEditable name="PageTitle" -->Add New User<!-- InstanceEndEditable -->		
    			<div id="logName">
                <!-- InstanceBeginEditable name="UserType" -->
                    <?php
//                    $db = new Database();
//                    $dbCon = $db->getConnection();
//
//                    $chc = new CheckCookie($dbCon);
//                    $result = $chc->checkCook("radmin");
//
//                    if ($result == "guest") {
//
//                        $usrname = $result[0];
//                        $first_name = $result[1];
//                        $last_name = $result[2];
//                        $type = $result[3];
//                        echo ' 
//                            	<a href="scripts/Logout.php">
//                    				<input type="submit" name="logout" id="logout" value="logout" class="redBtn"/>
//                				</a>
//                            ';
//
//                        echo $first_name . " " . $last_name;
//                    }
                    ?>
                    <!-- InstanceEndEditable -->
    			</div>    
  			</div>
  
  			<div class="sidebar"> 
             	<!-- InstanceBeginEditable name="SideBar" -->SideBar<!-- InstanceEndEditable -->
  			</div>
  			
  	
  			<div class="content">
				<!-- InstanceBeginEditable name="Content" -->
                <form id="addUser" method="post" action="./scripts/AddUser.php">

                    <table>

                        <tr>

                            <td>

                                Username

                            </td>

                            <td>

                                <input id="userName" name="userName" type="text" class="textBox"/>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                First Name

                            </td>

                            <td>

                                <input id="firstName" name="firstName" type="text" class="textBox"/>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Last Name

                            </td>

                            <td>

                                <input id="lastName" name="lastName" type="text" class="textBox"/>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Password

                            </td>

                            <td>

                                <input id="passw" name="passw" type="password" class="textBox"/>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Retype Password

                            </td>

                            <td>

                                <input id="repassw" name="repassw" type="password" class="textBox"/>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                Email

                            </td>

                            <td>

                                <input id="email" name="email" type="text" class="textBox"/>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                User Type

                            </td>

                            <td>

                                <input id="usrtype" name="usrtype" type="radio" value="user" checked="true"/>User&emsp;

                                <input id="usrtype" name="usrtype" type="radio" value="radmin"/>Room Administrator&emsp;

                                <input id="usrtype" name="usrtype" type="radio" value="staff"/>Staff&emsp;

                                <input id="usrtype" name="usrtype" type="radio" value="admin"/>Administrator

                            </td>

                        </tr>

                        <tr>

                            <td></td>

                            <td>

                                <input id="addBtn" name="addBtn" type="submit" value="Add User"/>

                            </td>

                        </tr>

                    </table>

                </form>
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
