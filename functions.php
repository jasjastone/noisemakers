<?php
function datasanitaize($connection,$data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = mysqli_real_escape_string($connection,$data);
    return $data;
}

?>
