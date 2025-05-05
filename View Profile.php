<?php require("head.php"); ?>

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
               <td style="width: 50%;">
               	<?php
               	$f = 0;
               	$name = $email = $gender = $day = $image = "";
			    $userData = json_decode(file_get_contents("data.json"), true);
			    if($userData != NULL){
			        foreach ($userData as $user){
			        if($user["username"] === $_SESSION["username"]){
			            $name = $_SESSION['name'];
			            $email = $_SESSION['e-mail'];
			            $gender = $_SESSION['gender'];
			            $day = $_SESSION['day'];
			            $image = $_SESSION['image'];
			            $f = 1;

			          
			    }
			    
			}
		}
			?>

               	<div class="container custom-form" style="width:500px;">  
                                
                <form method="post">  
                      
                     <br>  
                     <fieldset>
                         <legend>PROFILE</legend>
                         <br> <br> 
                         <fieldset>
                              <label>Name :</label>
                              <label><?php echo $name; ?></label>
                        
                         <hr>
                          
                               <label>E-mail :</label>
                               <label><?php echo $email; ?></label>
                          
                          <hr>
                         
                         <label>Gender :</label>
                          <label><?php echo $gender; ?></label>
                         <br><br>
                         
                         <hr> 
                        
                         <label>Date of Birth :</label>
                         <label><?php echo $day; ?></label><br>
                    	 <a href="../Pages/Edit Profile.php">Edit Profile</a>

                    	 </fieldset>

                     
                </form>  
           </div>  

               	<?php
					

					

				?>
               </td>

               <td style="width: 30%;">
				<?php
					$my_img_name = "picture.png";
				// Check if image file is a actual image or fake image
				if(isset($_POST["chng"])) {
					
					$target_dir = "../uploads/";
					$target_file = $target_dir . basename($_FILES["fname"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$img_name =  $target_dir.basename($_FILES["fname"]["name"]);

				 
				if ($_FILES["fname"]["size"] > 400000) {
				  echo "Picture size should not be more than 4MB";
				  $uploadOk = 0;
				}

				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
				  echo " Picture format must be in jpeg or jpg or png";
				  $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				  echo "\nSorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				  if (move_uploaded_file($_FILES["fname"]["tmp_name"], $target_file)) {
				    // echo "The file ". htmlspecialchars( basename( $_FILES["fname"]["name"])). " has been uploaded.";
				    $my_img_name = $_FILES["fname"]["tmp_name"];
				  } else {
				    echo "\nSorry, there was an error uploading your file.";
				  }
				}

				}
				$ite = 0;
				if($userData != NULL){
			        foreach ($userData as $user){
			        if($user["username"] === $_SESSION["username"]){
			            // $name = $_SESSION['name'];
			            // $email = $_SESSION['e-mail'];
			            // $gender = $_SESSION['gender'];
			            // $day = $_SESSION['day'];
			            // $image = $_SESSION['image'];
			            // $f = 1;

			            global $tmp_data;
			            $tmp_data = $user;
			            $tmp_data["image"] = $my_img_name;
			            $ite++;
			            break;

			    }}}
	
			    if($ite > 0){
			    	$userData[$ite-1] = $tmp_data;
			    	file_put_contents("data.json", json_encode($userData));
			    }
			     
			    //

				?>

				<form action="View Profile.php" method="post" enctype="multipart/form-data">
			    
			      <img src="../uploads/<?php echo $my_img_name; ?>" width="180" height="210">
			      <br>
			      <a href="Change Profile Picture.php">Change Profile</a>
			      <br>
			    	
			  	  
			 	</form>
               </td>
             </tr>
            
		</table>            
    </div>
</div>
<?php require("foot.php"); ?>