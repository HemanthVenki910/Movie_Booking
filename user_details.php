<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>User Details</title>
<link rel="stylesheet" type="text/css" href="user_view.css">
<link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet'>
</head>
<?php
        extract($_GET);
        $db=mysqli_connect('localhost:3306','root','','MOVIEDATA');
        $table = array();
        $contact_number = " ";
        if(isset($db))
        {

                $create_user_table = "CREATE TABLE IF NOT EXISTS USERDATA(EMAIL VARCHAR(100),THEATRE_NAME VARCHAR(100),DATEANDTIME VARCHAR(100),MOVIENAME VARCHAR(100), SEATS VARCHAR(200), FOREIGN KEY (EMAIL) REFERENCES USERS(EMAIL), PRIMARY KEY (MOVIENAME,SEATS));";
                $result_create_user_table = mysqli_query($db,$create_user_table);
                
                $contact_queries = "SELECT * FROM USERS WHERE EMAIL='".$usermail."';";
                $result_contact_queries = mysqli_query($db,$contact_queries);
                while($rows=mysqli_fetch_assoc($result_contact_queries))
                {       $contact_number = $rows["PHONENUMBER"]; }
                
                $str="SELECT * FROM USERDATA WHERE EMAIL='".$usermail."';";
                $result_str = mysqli_query($db,$str);
                while($rows=mysqli_fetch_assoc($result_str))
                {
                        $tr = array();
                        $tr["MOVIENAME"]        = $rows["MOVIENAME"];
                        $tr["SEAT"]             = $rows["SEATS"]; 
                        $tr["THEATRE_NAME"]     = $rows["THEATRE_NAME"];
                        $date_value             = $rows["DATEANDTIME"];
                        $date_value_array       = explode(":",$date_value);
                        $tr["DATEANDTIME"]      = $date_value_array[1].":".$date_value_array[2];
                        array_push($table,$tr);
                }
        }
?>
<script type="text/javascript">
        function Error()
        {
                alert("Not a Valid Query");
        }
        function onloader()
        {
                var usermail = document.getElementById("UserMail");
                usermail.innerHTML = "<?php echo $usermail ?>"
                var contact_number = document.getElementById("PhoneNumber");
                contact_number.innerHTML = "<?php echo $contact_number ?>"
                var buttons = document.getElementsByClassName("bluebutton");
                var i;
                var months = {"Jan" : 0,"Feb" : 1,"Mar" : 2,"Apr" : 3,"May" : 4,"Jun" : 5,"Jul" : 6,"Aug" : 7,"Sep" : 8,"Oct" : 9,"Nov" : 10,"Dec" : 11};
                for(i = 0; i<buttons.length;++i)
                {
                        var dateandtime = buttons[i].getAttribute('dateandtime');
                        var parts = dateandtime.split(' ');
                        var buttondate = new Date(2020,months[parts[3]],parts[2]);
                        console.log(buttondate);
                        var currentdate = new Date();
                        if(buttondate <= currentdate)
                        {
                                buttons[i].setAttribute( "onClick", "javascript: Error();" );
                                buttons[i].setAttribute("style","background-color :grey;");
                        }
                }
        }
        function next_page()
        {
            window.location="list.html";
        }
        function deletefunc(event)
        {
                var moviename = event.getAttribute('movie_name');
                var seatname = event.getAttribute('seat_name');
                var usermail = localStorage.getItem("Usermail");
                document.location.href = "unallocate.php?usermail="+usermail+"&moviename="+moviename+"&seatname="+seatname;
        }
</script>
<body onload="onloader()">
<div class="row">
  <div class="column1">
        <table class="table table-hover" style="text-align:center">
                <thead style="text-align:center" class="thead-dark"> <tr> <th class="header"> User Info </th> </tr> </thead>
                <tr>
                        <td>
                                <figure class="user_image">
                                        <img src="thumbnails\user_logo.jpg" width=250px height=250px style="padding-left:%;border-radius:7.5%;">
                                </figure>
                        </td>
                </tr>
                <tr>
                </tr>
                <tr>
                        <td class="header2">
                                UserEmail :
                                        <p id="UserMail">       </p>
                        </td> 
                </tr>
                <tr>
                        <td class="header2">       
                                PhoneNumber :
                                        <p id="PhoneNumber">  </p>
                        </td>
                </tr>        
        </table>
  </div>
  <div class="column2">
  </div>
  <div class="column3">
                <div style="overflow-x:auto;">
                <table class="table table-hover thead-dark" style="width:100%">
                <thead class="header2">
                        <tr>
                        <th>Theatre Name        </th>
                        <th>Movie Name          </th>
                        <th>Date and Time       </th>
                        <th>Seat Number         </th>
                        <th>              </th>
                        </tr>
                </thead>
                <tbody>
                <?php
                        $row_data = " ";
                        foreach($table as $tr)
                        {
                                echo "<tr><td>".$tr["THEATRE_NAME"]."</td><td>".$tr["MOVIENAME"]."</td><td>".$tr["DATEANDTIME"]."</td><td>".$tr["SEAT"]."</td> 
                                </td><td><button class='bluebutton' onclick='deletefunc(this)' movie_name='".$tr["MOVIENAME"]."'dateandtime='".$tr["DATEANDTIME"]."'seat_name='".$tr["SEAT"]."'> Cancel </button></td></tr>";
                        }
                ?>
                </tbody>
                </table>
                </div>
                <button class="bluebutton1" onclick="next_page()">Back</button>
  </div>
</div>
</body>
</html>