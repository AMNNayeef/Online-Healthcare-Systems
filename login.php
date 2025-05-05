<?php require("head.php"); ?>
    <?php

        //session_start();
    $nameErr = $passErr = "";
    $name = $pass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      if (empty($_POST["username"])) 
      {
        $nameErr = "Name is required";
      } 
      else 
      {
        $name = $_POST["username"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9.-_]*$/",$name)) 
        {
          $nameErr = "User Name must be contain alpha numeric characters, period, dash or underscore only";
        }
        else if (strlen($name)<2) 
        {
          $nameErr = "User Name must contain at least two characters";
        }
       }
       $rememberMe = false;

       if(isset($_POST["rem-me"])){
        $rememberMe = true;
       }
       echo $rememberMe;

           $f = 0;
    $userData = json_decode(file_get_contents("data.json"), true);
    if($userData != NULL){
        foreach ($userData as $user){
        if($user["username"] === $_POST["username"] && $user["password"] === $_POST["pass"]){
            $_SESSION['username'] = $user["username"];
            $_SESSION['name'] = $user["name"];
            $_SESSION['password'] = $user["pass"];
            $_SESSION['e-mail'] = $user["e-mail"];
            $_SESSION['gender'] = $user["gender"];
            $_SESSION['day'] = $user["day"];
            $_SESSION['image'] = $user["image"];

            $f = 1;

           if($rememberMe){
            setcookie("username", $_POST["username"], time()+60);
           }
            header("location: Dasboard.php");
        }
    }
    if($f==0){
        echo "Authentication Failed";
    }
}
      
}     
    
?>
<div class="container custom-form-login" style="width:500px;">  
 <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <fieldset >
      <legend>LOGIN</legend>
      <br> 
      <label>User Name: </label>
      <input type="text" name="username" value="<?php //echo $name;?>"><span class="red">&nbsp;<?php //echo $nameErr ?></span>
      <br>
      <label>Password: </label>
      <input type="text" name="pass" value="<?php //echo $pass;?>"><span class="red">&nbsp;<?php //echo $passErr ?></span>
      <hr>
      <input type="checkbox" id="me" name="rem-me" value="Remember Me">
      <label for="remember me"> Remember Me</label><br>
      <br>
      <input type="submit" name="">
      <a href="Forget Password.php"><span class="blue">Forget Password?</span></a>
     </fieldset>
     <span><?php //if(isset($_SESSION['authentication-error'])){echo $_SESSION['authentication-error'];} ?></span>
 </form>
</div>
<?php require("foot.php"); ?>