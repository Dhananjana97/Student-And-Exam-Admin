<?php
   if(isset($_FILES['fileToUpload'])){
      $errors= array();
      $file_name = $_FILES['fileToUpload']['name'];
      $file_size =$_FILES['fileToUpload']['size'];
      $file_tmp =$_FILES['fileToUpload']['tmp_name'];
      $file_type=$_FILES['fileToUpload']['type'];
      
      
      if($file_size > 2097152){
         $errors[]='File size must be exactly 20 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
<html>
<style type = "text/css">
.formSub{
	position:relative;
	width: 600px;
	height: 320px;
	left:50%;
	top:50%;
    padding: 20px 20px;
    margin: 8px 12px;
    box-sizing: border-box;
	border: 2px solid #007799;
    border-radius: 4px;
	transform: translate(-50%, 0%);
}
input{
	font-size:17px;
}
p[name="note"]{
	font-size:0.5em;
}

</style>
   <body>
   <br><br><br>
      <div class ="formSub">
	
	  <h3 style="margin-left:5ex">Select file to upload:</h3>
	  <br><br><br>
      <form align="center" action="submission.php" class = "submission" method="POST" enctype="multipart/form-data">
         <input font-size="20px" type="file" name="fileToUpload" />
         <input type="submit"/>
		 <br><br><br>
		 <p name="note" align="right">Maximum size for new files: 20MB, maximum attachments: 1</p>
      </form>
    </div>
   </body>
</html>