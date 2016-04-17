
<?php




if($_POST["title"])
{
$name = $_POST["title"];
$description = $_POST["description"];
$filename = $_POST["filename"];
// Here, you can also perform some database query operations with above values.
echo "name". $name . "description". $description . "filename" . $filename; // Success Message
}



?> 