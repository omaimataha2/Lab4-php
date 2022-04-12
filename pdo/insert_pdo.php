<?php


$dsn = 'mysql:dbname=iti;host=127.0.0.1;port=3306;'; #port number
$user = 'root';
$password = '1234';

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

try{


    $db= new PDO($dsn, $user, $password);
    var_dump($db);


    $insert_query= "insert into student(`username`,`email`,`password`) values(:username,:email,:password)";
    $name = "omaima";
    $email = "omaima@gmail.com";
    $inst_stmt = $db->prepare($insert_query);
    $inst_stmt->bindParam(":useremail", $email, PDO::PARAM_STR);
    $inst_stmt->bindValue(":username", 'omaima');
    $inst_stmt->execute();
    echo $db->lastInsertId();
    echo $inst_stmt->rowCount();
    var_dump( $db->errorInfo());




    ################### select ###################################
    $select_query = "select * from `student`";
    $stmt = $db->prepare($select_query);
    $res=$stmt->execute();
//    var_dump($res);
//    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows=$stmt->fetchAll(PDO::FETCH_OBJ);
//    var_dump($rows);

    echo "<table border='2px' style='background-color: beige'> <th>ID</th>
                    <th>Name</th>  <th>Email</th>  <th>View</th>   <th>Edit</th>  <th>Delete</th>";

    foreach ($rows as $r){
            echo "<tr> <td>$r->username</td>  <td>$r->email</td> <td>$r->passwd</td> ";
            echo "<td> <a href='view.php?id={$r->id}'> View</a> </td>
                    <td> <a href='edit_pdo.php?id={$r->id}'> Edit</a> </td>
                    <td> <a href='delete_pdo.php?id={$r->id}'> Delete</a> </td>";
            echo "</tr>";
        }
        echo "</table>";







}catch (Exception $e){
    echo $e->getMessage();
}