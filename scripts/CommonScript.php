<?php

include 'MyDB.php';
$func_name = $_POST['param_1'];

$db = new Database();
$dbCon = $db->getConnection();

switch ($func_name) {
    case "getFaculties":
        getFaculties($dbCon);
        break;
    case "getDepartments":
        getDepartments($dbCon);
        break;
}

function getFaculties($dbCon) {
    $statement = $dbCon->prepare("SELECT faculty_name FROM faculties");
    $statement->execute();

    echo '<option value="any" selected>Any</option>';
    if ($statement->rowCount() > 0) {
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            $val = $row[0];
            echo '<option value="' . $val . '">' . $val . '</option>';
            echo '<br/>';
        }
    } else {
        echo 'no faculties';
    }
}

function getDepartments($dbCon) {
    $fac_name = $_POST['param_2'];

    $statement = $dbCon->prepare("SELECT dept_name FROM departments WHERE faculty_name='" . $fac_name . "'");
    $statement->execute();

    echo '<option value="any" selected>Any</option>';
    if ($statement->rowCount() > 0) {
        while ($row = $statement->fetch(PDO::FETCH_NUM)) {
            $val = $row[0];
            echo '<option value="' . $val . '">' . $val . '</option>';
            echo '<br/>';
        }
    } else {
        echo 'no departments';
    }
}