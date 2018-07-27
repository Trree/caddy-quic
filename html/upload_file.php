<?php
if ($_FILES["file"]["size"] < 2000000000000)
{
    if ($_FILES["file"]["error"] > 0)
    {
          echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " already exists. ";
        }
        else
        {
	    $oldtime = microtime();
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "upload/" . $_FILES["file"]["name"]);
	    $newtime = microtime();
	    $splid = $_FILES["file"]["size"] / 1024 / ($newtime - $oldtime) / 1024;
            echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	    echo "speed: ".$splid;
        }
    }

}
else
{
    echo "Invalid file";
}
?>
