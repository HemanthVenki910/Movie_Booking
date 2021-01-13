<?php
extract($_GET);
$db=mysqli_connect('localhost:3306','root','','MOVIEDATA');
if(isset($db))
{
        $altering="UPDATE ".$moviename." SET status='UNOCCUPIED' WHERE seatname='".$seatname."';";
        $query=mysqli_query($db,$altering);
        $delete_from_table = "DELETE FROM USERDATA WHERE EMAIL='".$usermail."'AND MOVIENAME='".$moviename."' AND SEATS='".$seatname."';";
        $query = mysqli_query($db,$delete_from_table);
        header('Location:user_details.php?usermail='.$usermail);
}
?>