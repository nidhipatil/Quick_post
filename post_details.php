<?php
	 session_start();
    include_once'connection.php';

    $db=mysqli_connect($servername,$username,$password,$dbname);
	

	if(isset($_POST['submit']))
		{

				$title= $_POST['title'];
				$discription = $_POST['discription'];
				$image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
				$user_id=$_POST['user_id'];

			$query = "INSERT INTO posts (title, discription,image,user_id) VALUES ('$title','$discription','$image','$user_id')";
				$user_id = $_SESSION['user_id'];
				
				if(mysqli_query($db,$query)){
					$_SESSION['msg']="Post Done sucessfully";
					header('location:index.php'); 
				}else{
					echo $db->error;
				}
		
			}
		if(isset($_POST['update'])){
			$title=mysqli_real_escape_string($db,$_POST['title']);
			$image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$post_image=mysqli_real_escape_string($db,$image);
			$post_id=mysqli_real_escape_string($db,$_POST['id']);   
        	$user_id=mysqli_real_escape_string($db,$_POST['user_id']);
		
			$query="UPDATE posts SET title='$title', discription='$discription',image='$post_id',user_id='$user_id' WHERE id='$post_id'";
			
			$results = mysqli_query($db,$query);
			header('location:index.php');

		}
		if(isset($_POST['cancel'])){
			header('location:index.php');
		}

?>