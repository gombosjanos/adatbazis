<?php

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

$txt = "John Doe\n";
fwrite($myfile, $txt);

$txt = "Jane Doe\n";
fwrite($myfile, $txt);



fclose($myfile);

//írassuk ki a file tartalmát
echo readfile("newfile.txt");

//nevezzük át a fájlt oldfile.txt-re
rename("newfile.txt","oldfile.txt");

//másoljuk le a fájt copyfile.txt néven
copy("oldfile.txt","copyfile.txt");

//írjuk ki a copyfile.txt tartalmát
echo readfile("copyfile.txt");


//töröljük az oldfile.txt-t
unlink("oldfile.txt");

?>