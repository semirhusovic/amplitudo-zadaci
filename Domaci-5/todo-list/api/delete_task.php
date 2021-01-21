<?php
$todos = json_decode(file_get_contents('../todo.db'), true);

if (isset($_POST['id']) && $_POST['id'] != "") {
    $id = $_POST['id'];
}

unset($todos[$id]);
$todos = array_values($todos);
// var_dump($todos);
if (file_put_contents('../todo.db', json_encode($todos))) {
    header('location: ../index.php?msg=3_1');
} else {
    header('location: ../index.php?msg=3_0');
}
