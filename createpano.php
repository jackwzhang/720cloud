 <?php

$title = $_POST["title"];
$description = $_POST["description"];
$files = $_POST["files"];
$fileforder = $_POST["fileforder"];
$facebooklink = "";



$krpanoexe= " \"C:\krpano\krpanotools64.exe\" ";
$imagefiles = str_replace("/","\\",$files);
$imagefiles = str_replace("-identify-"," ",$imagefiles);
$cmdnormal= 'kmakemultires -config=templates\vtour-normal.config inputfiles ';
$cmdflat= 'kmakemultires -config=templates\vtour-flat.config inputfiles ';


$inputimage = explode("-identify-",$files);


 $ispano=false;

foreach ($inputimage as $firstimage) {
    $firstimage = str_replace("\"","",$firstimage);
    $firstimage = str_replace("-identify-","",$firstimage);
    if(strlen($firstimage)>2)
    $imagesize = getimagesize($firstimage);    
    $width="$imagesize[0]";
    $height="$imagesize[1]";
    if ($width == 2*$height) 
        $ispano = true;
}
    


if ($ispano){

    $my_file = 'file.bat';

    $handle = fopen($my_file, 'w') or die('39 Cannot open file:  '.$my_file);

    $data = $krpanoexe.$cmdnormal.$imagefiles;
    //echo $data;
    fwrite($handle, $data);

    fclose($handle);

    exec("file.bat",$out);

    //print_r($out);
} else{


    $my_file = 'iphonefile.bat';

    $handle = fopen($my_file, 'w') or die('58 Cannot open file:  '.$my_file);

    $data = $krpanoexe.$cmdflat.$imagefiles;

    fwrite($handle, $data);

    fclose($handle);

    exec("iphonefile.bat",$out);

    //print_r($out);

}



    $change_skin_path = "$fileforder/vtour/skin/vtourskin.xml";
    //$change_skin_path = "E:/xampp/htdocs/public/720cloud/panos/7721aa5ddb0ed3c2b03114dfadb61764";
    $fburl=str_replace("E:/xampp/htdocs/public/" , "http://geosys.org:809/" ,$fileforder);
    

    $file_content = file_get_contents($change_skin_path);
    $file_content = str_replace("[url-share]" , $fburl."/index.html" ,$file_content);  

   // echo $file_content;

    $filename = $change_skin_path;

    $handle = fopen($filename, 'w');

    fwrite($handle, $file_content);

    fclose($handle);

    //修改html
    $file_content = file_get_contents("$fileforder/vtour/index.html");
    $file_content = str_replace("[pagetitle]" , $title ,$file_content);  
    $file_content = str_replace("[og:url]" , $fburl."/index.html",$file_content);      // "000" 是修改后的内容
    $file_content = str_replace("[og:title]" , $title ,$file_content);
    $file_content = str_replace("[og:description]" , $description ,$file_content);
    $file_content = str_replace("[og:image]" , "http://geosys.org/wp-content/uploads/2013/09/logo2_500x500-e1379020189688.png" ,$file_content);

    //echo $file_content;

    $filename = "$fileforder/vtour/index.html";

    $handle = fopen($filename, 'w');

    fwrite($handle, $file_content);

    fclose($handle);

$successArr = array('fburl' => $fburl);
echo json_encode($successArr);


?>