<?php 
header("Content-Type: text/html");  
if (empty($_GET['rec'])) {
    $rec_limit = 20;   
} else {
    $rec_limit = $_GET['rec'];
}

$con = mysqli_connect('localhost','XXX','XXX') or die("Some error occurred during connection ".mysqli_error($con));

$con->set_charset('utf8');
    
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"johnfoxs_olympics");

//request row number determined by  - it checks if Athlete is null or undefined
$sql="SELECT Athlete, Medal, Country, Gender, Event, Edition, Season FROM main_olympic_data WHERE Athlete IS NOT NULL and Athlete <> '' ORDER BY RAND() LIMIT $rec_limit";

    $result = mysqli_query($con,$sql);
    $data = array();
    while($row = mysqli_fetch_array($result))
    {
        $arr[] = $row; 
    }
//print_r($arr); 
//Put result set into JSON object
print (json_encode($arr));
mysqli_close($con);
?>