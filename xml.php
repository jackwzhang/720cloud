<?php

  

    //$change_skin_path = "$fileforder/vtour/skin/vtourskin.xml";
     $fileforder="E:/xampp/htdocs/public/720cloud/panos/7721aa5ddb0ed3c2b03114dfadb61764/";
    $change_skin_path = "E:/xampp/htdocs/public/720cloud/panos/7721aa5ddb0ed3c2b03114dfadb61764/vtour/skin/vtourskin.xml";
    $fburl=str_replace("E:/xampp/htdocs/public/" , "http://geosys.org:809/" ,$fileforder);"";
    
    $title="tt";
    $description="desc";

    $file_content = file_get_contents("$fileforder/vtour/tour.xml");
    $file_content = str_replace("[url-share]" , $title ,$file_content);  

   // echo $file_content;

    $filename = "$fileforder/vtour/tour.xml";

    $handle = fopen($filename, 'w');

    fwrite($handle, $file_content);

    fclose($handle);

    //修改html
    $file_content = file_get_contents("$fileforder/vtour/tour.html");
    $file_content = str_replace("[pagetitle]" , $title ,$file_content);  
    $file_content = str_replace("[og:url]" , $fburl ,$file_content);      // "000" 是修改后的内容
    $file_content = str_replace("[og:title]" , $title ,$file_content);
    $file_content = str_replace("[og:description]" , $description ,$file_content);
    $file_content = str_replace("[og:image]" , "http://geosys.org/wp-content/uploads/2013/09/logo2_500x500-e1379020189688.png" ,$file_content);

    //echo $file_content;

    $filename = "$fileforder/vtour/tour.html";

    $handle = fopen($filename, 'w');

    fwrite($handle, $file_content);

    fclose($handle);

?>

