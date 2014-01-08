<section id="page-title">
    <div class="container clearfix">
        <h1>NAAT</h1>
        
    </div>
</section>

<!-- <section id="content" class="container clearfix">
<audio src="<?php echo base_url(); ?>img/naat/1.mp3" controls preload></audio>
<section> -->


    <section id="content" class="container clearfix">
        <!-- begin services -->
        <?php //foreach ($naat_data as $naat) { ?>
        <!-- <div class="iconbox-wrap clearfix">
            <div class="one-fourth">
                <div id="design" class="iconbox applications">
                    <h3 class="iconbox-title"><?php echo $naat['nat_person']; ?></h3>
                    <p><?php echo $naat['nat_title']; ?></p>

<audio src="<?php echo base_url(); ?>img/naat/<?php echo $naat['naat_file']; ?>" controls preload></audio>

                </div>
            </div>
        </div> -->
        <?php //} ?>
        <!-- end services -->
        
        <!-- table -->

<style type="text/css">
#loader{
    position: absolute;
    text-align: center;
    margin:100px 0px 0 500px;
    width: 32px;
    height:32px;
    display:none;
}
</style>

<script>

$(document).ready(function() { $("#y1").select2(); });
</script>



<script>
function showUser(str)
{
$("#loader").fadeIn('slow');
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
//xmlhttp.open("GET","http://localhost/dgmk/application/controllers/views/layout/cat_naat_bayan.php?q="+str,true);
xmlhttp.open("GET","http://localhost/dgmk/home/naat_catg/1="+str,true);
	//	alert('1');
//success:function(data){
//  $("#txtHint").html(data).fadeIn('slow');
    $("#loader").fadeOut('slow');
//}
xmlhttp.send();

}
</script>

<?php $sql = "SELECT DISTINCT nat_person,category FROM naat"; ?>
<select style="width:200px;" id="y1" name="users" onChange="showUser(this.value)">
<option value="">Select Year:</option>
<?php
$result = mysql_query($sql);
while ($rs = mysql_fetch_array($result))
{
    $person = $rs['nat_person'];
    $cat = $rs['category'];
    echo "<option value='$cat'>$person</option>";
}
?>
</select>

<div id="loader">
<img src="<?php echo base_url(); ?>images/ajax.loading.gif"></div>
<div id="txtHint">
            <table class="gen-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Naat Khawan / Title</th>
                            <th>Preview</th>
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="4">Table Footer</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($naat_data as $naat) { ?>
                        <tr>
                            <td><?php echo $naat['nat_title']; ?></td>
                            <td><?php echo $naat['nat_person']; ?></td>
                          <td><!-- <audio src="<?php echo base_url(); ?>img/naat/<?php echo $naat['naat_file']; ?>" controls preload></audio> -->
                                <a href="<?php echo base_url(); ?>img/naat/<?php echo $naat['naat_file'] ?>">Download</a>
                            </td>
                            
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        <!-- table -->
</div>

    </section>