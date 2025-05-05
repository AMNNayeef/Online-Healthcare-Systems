<?php require("head.php"); ?>
<?php 
	$nameErr = $emailErr = $genderErr = $dayErr =  "";
     $name = $email = $gender = $day =   "";

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

        $idx = 0;
				$userData = json_decode(file_get_contents("data.json"), true);
				if($userData != NULL){
					foreach ($userData as $user){
						if($user["username"] === $_SESSION['username']){
							$idx++;
							global $tmp_user;
							$tmp_user = $user;
							
              $tmp_user["name"] = $name;
              $tmp_user["e-mail"] = $email;
              $tmp_user["day"] = $day;
              $tmp_user["gender"] = $gender;


						}
					}
					if($idx > 0){
						$userData[$idx-1] = $tmp_user;
					}
					file_put_contents("data.json", json_encode($userData));
				}


}
?>

<div class="container custom-form-dashboard">
	<div class="navitems">
		<table style="width: 100%;">
			 <tr style="width: 100%;">

              <td style="width: 20%;">
			   <ul>

			   		<li>ADMIN</li>
            <hr>
                    <li><a href="../Interfaces/Dasboard.php">Dashboard</a></li>
                    <li><a href="../Interfaces/View Profile.php">View Profile</a></li>
                    <li><a href="../Interfaces/Edit Profile.php">Edit Profile</a></li>
                    <li><a href="../Interfaces/Change Password.php">Change Password</a></li>
                    <li><a href="../Interfaces/Doctors List.php">Doctors</a></li>
                    <li><a href="../Interfaces/Patients List.php">Patients</a></li>
                    <li><a href="../Interfaces/Patient's Coordinator List.php">Patient's Coordinator</a></li>
                  </ul>
               </td>
               <td style="width: 80%;">
               	<div class="container custom-form" style="width:500px;">  
                                
                <form method="post">  
                      
                     <br>  
                     <fieldset>
                         <legend>EDIT PROFILE</legend>
                         <br> <br> 
                         <fieldset>
                              <legend>Name</legend> 
                              <input type="text" name="name" class="form-control"/><span class="red">&nbsp;<?php echo $nameErr; ?></span>  
                         </fieldset>
                         <hr>
                          <fieldset>
                               <legend>E-mail</legend>
                               <input type="text" name = "email" class="form-control"/><span class="red">&nbsp;<?php echo $emailErr; ?></span>
                          </fieldset>
                          <hr>
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
                    	<hr>
                    	<input type="submit" name="submit" value="Submit" class="btn btn-info"/>
                </form>  
           </div>
               </td>

             </tr>
            
		</table>            
    </div>
</div>
<?php require("foot.php"); ?>