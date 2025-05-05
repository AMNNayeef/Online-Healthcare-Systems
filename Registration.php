<?php include("head.php"); ?>

<?php
// define variables and set to empty values
$nameErr = $unameErr = $emailErr = $genderErr = $dayErr = $passErr = $cPassErr = $fileErr  = "";
$name = $username = $email = $gender = $day = $pass =  "";
if(isset($_POST["submit"]))  
{  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "* Name is required";
  } 
  else {
    $name = $_POST["name"];
    $pattern = "/^[a-z]+([a-z]|[0-9]|\.|-)*/i";
    // check if name only contains letters and whitespace
    if (!preg_match($pattern,$name)) {
      $nameErr = "* Only letters and white space allowed";
    }
    else if(str_word_count($name)<2){

     $nameErr= "* Name field at least two words";
     $name = " ";
    }

  }
}
if (empty($_POST["email"])) {
    $emailErr = "* Email is required";
  } 
  else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $emailErr = "* Invalid email format";
    }else{
     $email = $_POST["email"];
    }

  if (empty($_POST["username"])) {
    $unameErr = "* Username is required";
  } 
  else {
    $username = $_POST["username"];
    $pattern = "/^[a-z]+([a-z]|[0-9]|\.|-)*/i";
    // check if name only contains letters and whitespace
    if (!preg_match($pattern,$username)) {
      $nameErr = "* Only letters and white space allowed";
    }
     $username = " ";
    }

  if(empty($_POST["pass"])){
     $passErr = "* password is required";

     }
     else if(strlen($_POST['pass']) < 8)
        {
        $passErr = "* Password must be at least 8 characters ";
        }
        else if(!(str_contains($_POST['pass'], '@') === true or str_contains($_POST['pass'], '$') === true or str_contains($_POST['pass'], '%') === true or str_contains($_POST['pass'], '#') === true))
        {
            $passErr = "* Password must be contain at least one of the special characters ";
            
        }
     else if($_POST["pass"] != $_POST["c-pass"]){
     $cPassErr = "* password is not matched";

     }else{
          
     $pass = $_POST["pass"];
     }

  if (empty($_POST["day"])) {
    $dayErr = "* Date of birth is required";
  } else {
    $day = $_POST["day"];
    $d = explode("-",$day);
    $dd = (int)$d[2];
    $mm = (int)$d[1];
    $yy = (int)$d[0];
    //yyyy-mm-dd

    if(!($dd<=31 && $dd>=1 && $mm<=12 && $mm>=1 && $yy<=2001 && $yy>=1900)){
     $dayErr = "* Invalid date of birth<br>";
     $day = "";
    }
  }

  if (empty($_POST["gender"])) {
    $genderErr = "* Gender is required";
  } else {
    $gender = $_POST["gender"];
  }
if(file_exists('data.json'))  
           {  
                $current_data = file_get_contents('data.json');  
                //echo $current_data;
                $array_data = json_decode($current_data, true);  
                $new_data = array(  
                     'name'               =>     $_POST['name'],  
                     'e-mail'          =>     $_POST["email"],  
                     'username'     =>     $_POST["username"],
                     'password'   =>     $_POST["pass"],
                     'gender'   =>     $_POST["gender"],  
                     'day'   =>     $_POST["day"]
                      
                );  
                $array_data[] = $new_data;  
                $final_data = json_encode($array_data);  
                //echo $final_data;
                if(file_put_contents('data.json', $final_data))  
                {  
                     $message = "<label class='text-success'>Registration successfully</label>"; 
                     header("location: Login.php");
                }  
           }  
           else  
           {  
                $fileErr = ' JSON file not exits ';  
           }  

}   

 ?> 
<br>  
           <div class="container custom-form" style="width:500px;">  
                                
                <form method="post">  
                      
                     <br>  
                     <fieldset>
                         <legend>REGISTRATION</legend>
                         <br> <br> 
                         <fieldset>
                              <legend>Patient Name</legend> 
                              <input type="text" name="name" class="form-control"/><span class="red">&nbsp;<?php echo $nameErr; ?></span>  
                         </fieldset>
                         <hr>
                          <fieldset>
                               <legend>E-mail</legend>
                               <input type="text" name = "email" class="form-control"/><span class="red">&nbsp;<?php echo $emailErr; ?></span>
                          </fieldset>
                          <hr>
                         <fieldset>
                              <legend>User Name</legend>
                              <input type="text" name = "username" class="form-control" /><span class="red">&nbsp;<?php echo $unameErr; ?></span>
                         </fieldset>
                         <hr>
                         <fieldset>
                              <legend>Password</legend>
                              <input type="password" name = "pass" class="form-control" /><span class="red">&nbsp;<?php echo $passErr; ?></span>
                         </fieldset>
                         <hr>
                         <fieldset>
                              <legend>Confirm Password</legend>
                              <input type="password" name = "c-pass" class="form-control" /><span class="red">&nbsp;<?php echo $cPassErr; ?></span>
                         </fieldset>
                         <hr>

                         <fieldset>
                         <legend>Gender</legend>
                          <input type="radio" id="male" name="gender" value="male">
                          <label for="male">Male</label>                     
                          <input type="radio" id="female" name="gender" value="female">
                          <label for="female">Female</label>
                          <input type="radio" id="other" name="gender" value="other">
                          <label for="other">Other</label><span class="red">&nbsp;<?php echo $genderErr; ?></span><br><br>
                         </fieldset>
                         <hr> 
                         <legend>Date of Birth:</legend>
                         <input type="date" name="day"> <span class="red">&nbsp;<?php echo $dayErr; ?></span><br><br>
                         <fieldset>
                         <hr> 
                          </fieldset>
                          <input type="submit" name="submit" value="Submit" class="btn btn-info" />
                          <input type="reset" name="reset" value="Reset" class="btn btn-info" /><br />                      
                          <?php  
                          if(isset($message))  
                          {  
                               echo $message;  
                          }  
                          
                          ?> 
                           
                          </fieldset>
                          <hr> 
                     
                </form>  
           </div>  
           <br>  

<?php include("foot.php"); ?>