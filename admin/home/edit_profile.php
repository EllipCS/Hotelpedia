<?php
session_start();
include_once('../../connect/connect.php');

    $fetch_user = mysqli_query($connect, "SELECT * FROM user WHERE user_id = '".$_SESSION['user_id']."'")
                      or die ("ERROR: " .mysqli_error());
    $row = mysqli_fetch_array($fetch_user);

	if(isset($_POST['edit'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$c_password = $_POST['c_password'];
	}
	if(isset($_FILES['profile_pic'])){
		$profile_pic = addslashes(file_get_contents($_FILES['profile_pic']['tmp_name']));
		$image = addslashes(file_get_contents($_FILES['profile_pic']['tmp_name']));
		$image_name = $_FILES['profile_pic']['name'];
	}
	else{
  		echo'<script>
  			 swal({
                      title: "Ooops!",
                      text: "Only jpg, gif, and png files are allowed!",
                      icon: "warning"
             })

            .then((value) => {
                window.location.href="javascript:history.back()";
            });
  	   	     </script>';
 	exit(0); }

	// $check_email = "SELECT * FROM user WHERE email = '".$email."' AND user_id = '".$row['user_id']."'";
	// $result = mysqli_query($connect, $check_email) or die ("ERROR: " .mysqli_error($connect));

	// if(mysqli_num_rows($result) > 0 || $row['email'] != $email){
	// 	echo '<script>
	// 		  	alert("Email Already Exist!");
	// 		  	window.location.href="javascript:history.back()";
	// 		  </script>';
	// 	exit(0);
	// }

    if ($profile_pic != ''){
		$update_user = mysqli_query($connect, "UPDATE user SET email='".$email."', lastname='".$lastname."', firstname='".$firstname."', password='".$password."', profile_pic='$image_name', image='$image' WHERE user_id='".$row['user_id']."'") or die("Error: ".mysqli_error($connect));

		if ($update_user) {
    		echo '<script>
					swal({
                      title: "Congratulations!",
                      text: "Your profile was successfulyy updated!",
                      icon: "success"
                    })
                    .then((value) => {
                        window.location.href = "profile.php";
                    });
				  </script>';
		}
		else {
    		echo'<script>
					swal({
                      title: "Oh No!",
                      text: "Profile Cannot Change! Please try again.",
                      icon: "warning"
                    })
                    .then((value) => {
                        window.location.href="javascript:history.back()";
                    });

				</script>';
		}
	}

	if ($profile_pic == ''){
		$update_user = mysqli_query($connect, "UPDATE user SET email='".$email."', lastname='".$lastname."', firstname='".$firstname."', password='".$password."', profile_pic='".$row['profile_pic']."' WHERE user_id='".$row['user_id']."'") or die("Error: ".mysqli_error($connect));

		if ($update_user) {
    		echo '<script>
					swal({
                      title: "Congratulations!",
                      text: "Your profile was successfulyy updated!",
                      icon: "success"
                    })
                    .then((value) => {
                        window.location.href = "profile.php";
                    });
				  </script>';
		}
		else {
    		echo'<script>
					swal({
                      title: "Oh No!",
                      text: "Profile Cannot Change! Please try again.",
                      icon: "warning"
                    })
                    .then((value) => {
                        window.location.href="javascript:history.back()";
                    });

				</script>';
		}
	}
?>