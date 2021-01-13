<?php
extract($_GET);
$display    = str_replace(" ","_",$moviename);
$moviename  = $display;
$seats_temp = $seats;
$seats      = explode(",",$seats);
$count=0;
foreach($seats as $number=>$seatnumber)
{
    $count+=1;
}
$db=mysqli_connect('localhost:3306','root','','MOVIEDATA');
if(isset($db))
{
  $create_user_table = "CREATE TABLE IF NOT EXISTS USERDATA(EMAIL VARCHAR(100),THEATRE_NAME VARCHAR(100),DATEANDTIME VARCHAR(100),MOVIENAME VARCHAR(100), SEATS VARCHAR(200), FOREIGN KEY (EMAIL) REFERENCES USERS(EMAIL), PRIMARY KEY (MOVIENAME,SEATS));";
  $result_create_user_table = mysqli_query($db,$create_user_table);
  for($i=0;$i<$count;$i++)
  {
    $str="SELECT * FROM ".$moviename." WHERE seatname ='".$seats[$i]."';";
    $res=mysqli_query($db,$str);
    if(mysqli_num_rows($res)==1)
    {
      $altering="UPDATE ".$moviename." SET status='OCCUPIED' WHERE seatname='".$seats[$i]."';";
      $insert_into_table = "INSERT INTO USERDATA VALUES('".$usermail."','".$theatre_name."','".$dateandtime."','".$moviename."','".$seats[$i]."');";
      $query=mysqli_query($db,$altering);
      $query = mysqli_query($db,$insert_into_table);
    }
  }
  header('Location:Thenks.html');
}
?>
