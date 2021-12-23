<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>
    <style>
        
.innerright,label {
    color: #34495E;
    font-weight:bold;
}

.add_book_table,.add_student_table,.issue_book{
    width:100%;
    height:100%;
    border-radius:5px;
}

table tr:last-child td:first-child {
  border-bottom-left-radius: 6px;
}

table tr:last-child td:first-child {
  border-bottom-right-radius: 6px;
}

td{
    padding:5px;
}

.container{
    margin:auto;
}
 .row
 {
    margin:auto;
}


.innerdiv {
    text-align: center;
    /* width: 500px; */
    margin-top:30px;
    margin-left: 100px;
    margin-right: 100px;
    margin-bottom: 100px;
}
input{
    margin-left:20px;
}
.leftinnerdiv {
    float: left;
    width: 25%;
}

.rightinnerdiv {
    float: right;
    width: 75%;
    padding-top:2px;
}

.innerright {
    /* background-color: rgb(105, 221, 105); */
    background-color:lightgrey;
    border-radius:5px;
}

.greenbtn {
    background-color: #fed8b1;
    color: white;
    width: 95%;
    height: 50px;
    margin-top: 4px;

}

.greenbtn,
a {
    text-decoration: none;
    color: black;
    font-size: large;
    font-weight:bold;
}

th{
    background-color: orange;
    color: black;
}
td{
    background-color: #fed8b1;
    color: black;
}
td, a{
    color:black;
}
    </style>
    <body>

    <?php
   include("data_class.php");

$msg="";

   if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
 }

if($msg=="done"){
    echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
}
elseif($msg=="fail"){
    echo "<div class='alert alert-danger' role='alert'>Fail</div>";
}

    ?>



        <div class="container">
        <div class="innerdiv">
            <div class="row"><img style = "margin-left:32%;"src="images/home_img.png" height = "200" width = "400"/></div>
            <div class="leftinnerdiv">
                <Button class="greenbtn btn"> ADMIN</Button>
                <Button class="greenbtn btn" onclick="openpart('addbook')" >ADD BOOK</Button>
                <Button class="greenbtn btn" onclick="openpart('bookreport')" > BOOK RECORD</Button>
                <Button class="greenbtn btn" onclick="openpart('bookrequestapprove')"> BOOK REQUESTS</Button>
                <Button class="greenbtn btn" onclick="openpart('addperson')"> ADD PERSON</Button>
                <Button class="greenbtn btn" onclick="openpart('studentrecord')"> STUDENT RECORD</Button>
                <Button class="greenbtn btn"  onclick="openpart('issuebook')"> ISSUE BOOK</Button>
                <Button class="greenbtn btn" onclick="openpart('issuebookreport')"> ISSUE RECORD</Button>
                <a href="index.php"><Button class="greenbtn btn" > LOGOUT</Button></a>
            </div>

            <div class="rightinnerdiv">   
            <div id="bookrequestapprove" class="innerright portion" style="display:none">
            <label style="font-size:25px;color:black;margin-top:5px;" >BOOK REQUEST APPROVE</label>

            <?php
            $u=new data;
            $u->setconnection();
            $u->requestbookdata();
            $recordset=$u->requestbookdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
              "<td>$row[1]</td>";
              "<td>$row[2]</td>";

                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";
               // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                 $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="addbook" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
            <label style="font-size:25px;color:black;margin-top:5px;">ADD BOOK</label>
            <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
            
        
        <table class = "add_book_table">
        <tr>      
                <td><label>Book Name:</label></td>
                <td><input style = "width:50%;margin-left:32%" class="form-control" type="text" name="bookname"/></td>
        </tr>

        <tr>
                <td><label>Detail:</label></td>
                <td><input  style = "width:50%;margin-left:32%" class="form-control" type="text" name="bookdetail"/></td>
        </tr>

        <tr>
            <td><label>Author:</label></td>
            <td><input style = "width:50%;margin-left:32%" class="form-control" type="text" name="bookaudor"/></td>
        </tr>
            
        <tr>
            <td><label>Publication</label></td>
            <td><input style = "width:50%;margin-left:32%" class="form-control" type="text" name="bookpub"/></td>
        </tr>

        <tr>
            <td>
                <label>Branch:</label>
            </td>

            <td style = "padding-left:13%">
                <input type="radio" name="branch" value="CSE" >&nbsp;CSE
                <input type="radio" name="branch" value="IT"/>&nbsp;IT
                <input type="radio" name="branch" value="ECE"/>&nbsp;ELECTRONICS
                <input type="radio" name="branch" value="CIVIL"/>&nbsp;CIVIL
            </td>
        </tr>
        
        <tr>
            <td><label>Price:</label></td>
            <td><input style = "width:50%;margin-left:32%" class="form-control" type="number" name="bookprice"/></td>
        </tr>

        <tr>
            <td>
                <label>Quantity:</label>
            </td>

            <td>
            <input style = "width:50%;margin-left:32%" class="form-control" type="number" name="bookquantity"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>Book Photo</label>
            </td>

            <td style = "padding-left:14%">
                <input  type="file" name="bookphoto"/>
            </td>
        </tr>
        

        <tr>
            <td colspan = "2" style = "padding-right:13%"><button class = "btn btn-primary fw-bold" type="submit" value="SUBMIT">Submit</button></td>
        </tr>
        </table>
            </form>
            </div>
            </div>


            <div class="rightinnerdiv">   
            <div id="addperson" class="innerright portion" style="display:none">
            <label style="font-size:25px;color:black;margin-top:5px;">Add Person</label>
            <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
            <table class = "add_student_table">
                <tr>
                    <td><label>Name:</label></td>
                    <td><input type="text" style = "width:50%;margin-left:32%" class="form-control" name="addname"/></td>
                </tr>
                <tr>
                    <td><label>Pasword:</label></td>
                    <td><input type="pasword" style = "width:50%;margin-left:32%" class="form-control" name="addpass"/></td>
                </tr>
                <tr>
                    <td><label>Email:</label></td>
                    <td><input  type="email" style = "width:50%;margin-left:32%" class="form-control" name="addemail"/></td>
                </tr>
                <tr>    
                   <td><label for="typw">Choose type:</label></td>
                   <td>
            <select style = "width:50%;margin-left:32%" class="form-control" name="type" >
                <option class="dropdown-item" value="student">Student</option>
                <option class="dropdown-item" value="teacher">Teacher</option>
            </select>
        </td>
        <tr>
            <td colspan="2"><button class="btn btn-primary" type="submit" value="SUBMIT">Submit</button</td>
        </tr>
        </table>
            </form>
            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="studentrecord" class="innerright portion" style="display:none">
            <label style="font-size:25px;color:black;margin-top:5px;">Student RECORD</label>

            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'> Name</th><th>Email</th><th>Type</th><th>Delete</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'><button class='btn btn-primary'>Delete</button></a></td>";
                $table.="</tr>";
                //$table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="issuebookreport" class="innerright portion" style="display:none">
            <label style="font-size:25px;color:black;margin-top:5px;" >Issue Book Record</label>

            <?php
            $u=new data;
            $u->setconnection();
            $u->issuereport();
            $recordset=$u->issuereport();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[4]</td>";
                // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

<!--             

issue book -->
            <div class="rightinnerdiv">   
            <div id="issuebook" class="innerright portion" style="display:none">
            <label style="font-size:25px;color:black;margin-top:5px;" >ISSUE BOOK</label>
            <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
                <table class="issue_book">
                    <tr>
                        <td><label for="book">Choose Book:</label></td>
                        <td><select style = "width:50%;margin-left:32%" class="form-control" name="book" >
                        <?php
                        $u=new data;
                        $u->setconnection();
                        $u->getbookissue();
                        $recordset=$u->getbookissue();
                        foreach($recordset as $row){

                            echo "<option class='dropdown-item' value='". $row[2] ."'>" .$row[2] ."</option>";
                    
                        }            
                        ?>
                        </select>
                    </td>
                    </tr>
                    <tr>
                      <td><label for="Select Student">Student:</label></td>
                       <td> <select style = "width:50%;margin-left:32%" class="form-control" name="userselect" >
                            <?php
                            $u=new data;
                            $u->setconnection();
                            $u->userdata();
                            $recordset=$u->userdata();
                            foreach($recordset as $row){
                            $id= $row[0];
                                echo "<option class='dropdown-item' value='". $row[1] ."'>" .$row[1] ."</option>";
                            }            
                            ?>
                            </select>
                        </td>
                        </tr>
                       <tr>
                        <td><label>Days:</label></td>
                        <td><input type="number" style = "width:50%;margin-left:32%" class="form-control" name="days"/></td>
                        </tr>
                        <tr>    
                         <td colspan="2"><button class="btn btn-primary" type="submit" value="SUBMIT">Submit</button></td>
                        </table>
            </form>
            </div>  
            </div>

            <div class="rightinnerdiv">   
            <div id="bookdetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
            
            <label style="font-size:25px;color:black;" >BOOK DETAIL</label>
</br>
<?php
            $u=new data;
            $u->setconnection();
            $u->getbookdetail($viewid);
            $recordset=$u->getbookdetail($viewid);
            foreach($recordset as $row){

                $bookid= $row[0];
               $bookimg= $row[1];
               $bookname= $row[2];
               $bookdetail= $row[3];
               $bookauthour= $row[4];
               $bookpub= $row[5];
               $branch= $row[6];
               $bookprice= $row[7];
               $bookquantity= $row[8];
               $bookava= $row[9];
               $bookrent= $row[10];

            }            
?>

            <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $bookimg?> "/>
            
            <table style="width:75%">
               <tr> 
               <td><p style="color:#34495E">Book Name:</td><td><?php echo $bookname ?></td>
               </tr>
               <tr>
               <td><p style="color:#34495E">Book Detail:</td><td><?php echo $bookdetail ?></p></td>
        </tr>
        <tr>
        <td><p style="color:#34495E">Book Authour:</td><td><?php echo $bookauthour ?></p></td>
        </tr>
         <tr>   
            <td><p style="color:#34495E">Book Publisher:</td><td><?php echo $bookpub ?></p></td>
        </tr>
        <tr> 
            <td><p style="color:#34495E">Book Branch:</td><td><?php echo $branch ?></p></td>
        </tr>
        <tr>
            <td><p style="color:#34495E">Book Price: </td><td><?php echo $bookprice ?></p></td>
        </tr>
        <tr>
            <td><p style="color:#34495E">Book Available: </td><td><?php echo $bookava ?></p></td>
        </tr>
        <tr>
            <td><p style="color:#34495E">Book Rent: </td><td><?php echo $bookrent ?></p></td>
        </tr>
        </table>
            </div>
            </div>



            <div class="rightinnerdiv">   
            <div id="bookreport" class="innerright portion" style="display:none">
            <label style="font-size:25px;color:black;margin-top:5px;" >BOOK RECORD</label>
            <?php
            $u=new data;    
            $u->setconnection();
            $u->getbook();
            $recordset=$u->getbook();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Book Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th></th><th>View</th><th>Delete</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[9]</td>";
                $table.="<td>$row[10]</td>";
                $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View Book</button></a></td>";
                $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'><button type='button' class='btn btn-primary'>Delete</button></a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>



        </div>
        </div>
        

     
        <script>
        function openpart(portion) {
        var i;
        var x = document.getElementsByClassName("portion");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        document.getElementById(portion).style.display = "block";  
        }
        </script>
    </body>
</html>