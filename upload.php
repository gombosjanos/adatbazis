<?php



if (isset($_FILES["fileToUpload"])) {
    echo "<pre>";
    print_r($_FILES["fileToUpload"]);
    echo "</pre>";
    $target_dir = "uploads/";

    $i=0;
    $errirs = array();

    foreach($_FILES["fileToUpload"]["name"] as $key => $name){
         $target_file = $target_dir . basename($name);
        
         if($_FILES["fileToUpload"]["size"][$key] > 1024000){
             $errors[0][] ="A $name TÚL NAGY";
             
         }
         if($_FILES["fileToUpload"]["size"][$key] < 1024){
            $errors[0][] ="A $name TÚL KICSI";
            
        }
         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
            $i++;
        }
    }
    if($i > 0)echo "$i fájl feltöltve";
    
    
    

}

?>
<!DOCTYPE html>
<html>

<body>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select images to upload:
        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
        <input type="submit" value="Upload Images" name="submit">
    </form>

</body>

</html>