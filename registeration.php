<?php
require "pdo/pdoconnect.php";
    if (isset($_GET["errors"])){
        $errors = json_decode($_GET["errors"]);
    }
    if (isset($_GET["olddata"])){
        $olddata = json_decode($_GET["olddata"]);
    }

    
        $username=null;
        $email=null;
        $password=null;
        $room=null;
        

    if (isset($_GET["email"])){
        $email=$_GET["email"];
        $user=getUser($email);
        $username=$user->username;
        $email=$user->email;
        $password=$user->password;
        $room=$user->room;
       
    }
    function getUser($email)
    {
        try{
            $dsn = 'mysql:dbname=sakila;host=127.0.0.1;port=3306;';#port number
          $user = 'root';
             $password = '1234';
            $db = new PDO($dsn, $user, $password);
            if($db){
                $select_query = 'select * from student where email=:email';
                $select_stmt = $db->prepare($select_query);
                $select_stmt->bindParam(":email",$email );
    
                $res=$select_stmt->execute();
                if ($res){
                    $users = $select_stmt->fetchAll(PDO::FETCH_OBJ);
          
                    return $users[0];
                }
            }
        return null;
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .error {color: #FF0000;}
        </style>
</head>
<body>
<div class="container container-fluid w-50 bg-light position-absolute top-50 start-50 translate-middle">
        
        <h1 class="text-center mb-3 mt-3">Registeration</h1>
            
            <form method="post" action="registeration-validation"  enctype="multipart/form-data">

            
               <div class="form-group m-2">
                    <label>Name</label>
                    <input class="form-control" type="text" name="username"
                    value="<?php if(isset($olddata->username)) {echo $olddata->username;} ?>"/>
                    <?php
                        if(isset($errors->username)){
                            echo "<p class='error'> $errors->username</p>";
                        }
                       
                    ?>
                </div>
                
                <div class="form-group m-2">
                    <label>Email</label>
                    <input class="form-control" type="text" name="email"
                    value="<?php if(isset($olddata->email)) {echo $olddata->email;} ?>"/>
                    <?php
                        if(isset($errors->email)){
                            echo "<p class='error'> $errors->email</p>";
                        }
                        else{
                        }
                    ?>
                </div>
               

                <div class="form-group m-2">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password"
                    value="<?php if(isset($olddata->password)) {echo $olddata->password;}?>"/>
                    <?php
                if(isset($errors->password)){
                    echo "<p class='error'> $errors->password</p>";
                }
                ?>
                </div>
                
                <div class="form-group m-2">
                    <label>Room Number</label>
                    <select name="room" class="form-control" value="<?php if(isset($olddata->room)) {echo $olddata->room;}?>">
                        <option value="application1" <?php if(isset($olddata->room) && $olddata->room === "application1") {echo "selected";}?>  >Application1</option>
                        <option value="application2"  <?php if(isset($olddata->room) && $olddata->room === "application2") {echo "selected";}?>>Application2</option>
                        <option value="cloud"  <?php if(isset($olddata->room) && $olddata->room === "cloud") {echo "selected";}?>>Cloud</option>
                    </select>
                    <?php
                if(isset($errors->room)){
                    echo "<p class='error'> $errors->room</p>";
                }
                ?>
                </div>
                
                <div class="form-group m-2">
                    <label>Upload picture</label>
                    <input class="form-control" type="file" name="image"/>
                    <?php
                    if (isset($errors->image)) {
                            echo "<p class='error' >$errors->image</p>";
                       }
                     ?>
                </div>
                <div class="form-group m-2">
                <button type="submit" class="btn btn-primary m-2">login</button>
                </div>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>