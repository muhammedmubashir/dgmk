
<?php

$q=$_GET["q"];
echo $q;
$sql="SELECT * FROM naat WHERE category = '".$q."'";

$result = mysql_query($sql);

echo "<table class='table table-striped'>
<thead>
<tr>
<th>Title</th>
<th>Person</th>
</tr>
</thead>";

while($row = mysql_fetch_array($result))
  {
  $title = $row['nat_title'];
  $person = $row['nat_person'];
  
  echo "<tr><td>$title</td><td>$person</td></tr>";
    
  }
echo "</table>";


?>