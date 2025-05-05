<?php require("head.php"); ?>

  <div class="container custom-form-fpass" style="width:500px;"><?php

    $emailErr = "";
    $email  = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      if(isset($_POST['sub'])){
        if (empty($_POST["mail"])) {
    $emailErr = "* Email is required";
    } 
    else if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)){
    $emailErr = "* Invalid email format";
    }else{
     $email = $_POST["mail"];
    }

    
    }
    $f = 0;

    $userData = json_decode(file_get_contents("data.json"), true);
    if($userData != NULL){
        foreach ($userData as $user){
        if($user["e-mail"] === $_POST["mail"]){
            $_SESSION['e-mail'] = $_POST["mail"];
            $f = 1;

        }
    }
    if($f==1){
        echo "Matched successfully";
        header("location: FChange Password.php");
    }
      }
      
}

  ?>
    

 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <fieldset >
      <legend>FORGOT PASSWORD</legend>
      <br>
      <label>Enter E-mail: </label>
      <input type="text" name="mail" value="<?php echo $email;?>"><span class="red">&nbsp;<?php echo $emailErr ?></span>
      <hr>
      <br>

      <input type="submit" name="sub">
      
     </fieldset>

 </form>

</div>
<?php require("foot.php"); ?>