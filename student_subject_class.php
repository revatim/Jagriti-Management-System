
 <?php 
//Start the session to see if the user is authenticated user. 
session_start(); 
//Check if the user is authenticated first. Or else redirect to login page 
if(isset($_SESSION['IS_AUTHENTICATED']) && $_SESSION['IS_AUTHENTICATED'] == 1){ 
// Code to be executed when 'View The Students' is clicked. 
if ($_POST['submit'] == 'View The Students') 
{ 
if($_POST['subject_name'] && $_POST['class']) 
{ 
require('menu.php'); 
//Connect to mysql server 
$link = mysql_connect('192.168.1.72', 'garima', 'GARIMAYOI'); 
//Check link to the mysql server 
if(!$link){ 
die('Failed to connect to server: ' . mysql_error()); 
} 
//Select database 
$db = mysql_select_db('jagrati'); 
if(!$db){ 
die("Unable to select database"); 
} 
//Prepare query 
$subject_name = $_POST['subject_name']; 
$class = $_POST['class']; 
$query = "select student.student_id,student.name,student.fname,student.village 
from student,learns
where learns.subject_name='$subject_name' and
       learns.class='$class' and
       learns.student_id=student.student_id";
//Execute query 
$result = mysql_query($query); 
echo "<center><h1>The Students Learning Subject:'$subject_name' In Class:'$class' Are:-</h1>"; 
echo "<table border='1' cellpadding = '10'> 
<tr><th>Student ID</th> 
<th>Student Name</th>
<th>Father Name</th>
<th>Village</th>
</tr>"; 

while($row = mysql_fetch_array($result)) 
 
{ 
echo "<tr><td>" . $row['student_id'] . "</td> 
<td>" . $row['name']."</td> 
<td>" . $row['fname']."</td> 
<td>" . $row['village']."</td> </tr>"; 
echo "<br/>"; 
} 
echo "</table></center>"; 
} 
 
 echo '<a href="volunteer_front_page.php">Back To Volunteer Main Page</a>'; 
}
 
 
} 
else{ 
header('location:login_form.php'); 
exit(); 
} 
?>
