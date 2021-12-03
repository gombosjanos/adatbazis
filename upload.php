<?php



if (isset($_FILES["fileToUpload"])) {
    echo "<pre>";
    print_r($_FILES["fileToUpload"]);
    echo "</pre>";
    $target_dir = "uploads/";

    $i=0;
    $errors = array();
    $allowed_filetypes = array ('image/png', 'image/jpg', 'image/jpeg');

    foreach($_FILES["fileToUpload"]["name"] as $key => $name){
         $target_file = $target_dir . basename($name);
        
         if($_FILES["fileToUpload"]["size"][$key] > 102400){
             $errors[$key][] ="A $name TÚL NAGY";
             
         }
         elseif($_FILES["fileToUpload"]["size"][$key] < 1024){
            $errors[$key ][]="A $name TÚL KICSI";
            
        }
        if(!in_array($_FILES["fileToUpload"]["type"][$key], $allowed_filetypes)){
            $errors[$key][] ="A $name nem jpg vagy png.";
        }
        if(!isset($errors[$key])){
         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
            $i++;
        }
    }
    }
    
    
    
    

}

?>
<!DOCTYPE html>
<html>

<body>

    <?php
        if($i > 0)echo "$i fájl feltöltve";
        if($errors){
            foreach($errors as $error){
                foreach($error as $errorMsg){
                    echo "$errorMsg <br>";
                }
            }
        }
    ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select images to upload:
        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
        <input type="submit" value="Upload Images" name="submit">
    </form>

</body>

</html>