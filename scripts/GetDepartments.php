<?php

function getDepts($dbCon) {
    $statement = $dbCon->prepare("SELECT dept_name FROM departments");
    $statement->execute();

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

?>
