
<?php
if($_GET)
{
if(isset ($_GET['type']) ||  isset($_GET['tmpl']) || isset($_GET['id']) )
{
	$tablename = $_GET['type'];
	$tmpl = $_GET['tmpl'];
	$id = $_GET['id'];
	}else{
		$tablename = null;
		$tmpl = null;
		$id = null;
		
		}
}
?>

<!-- <form method='POST' action=''> --> 
<div class="row-fluid">
<div class="block span12">
 <a href="#tablewidget" class="block-heading" data-toggle="collapse">Users<span class="label label-warning">+10</span></a>
  <!-- <div id="tablewidget" class="block-body collapse in">  -->         

			<?php
			//if($id != null){ ?>
			
				<table class="table">
              <thead>		
			<?php
			$values = $db->get_results("SELECT * FROM $tablename");
				$getcolms = $db->get_results("SHOW FULL COLUMNS FROM $tablename"); ?>
<tr>
<?php
//print_r($getcolms);
foreach($getcolms as $getcolm)
{ 
//print_r($getcolm);
?>

<th><?php echo $getcolm->Comment; ?></th>

<?php } //getcolm ?>
<th>Options</th>
</tr>				
	</thead>
              <tbody>			
				
			<?php	
foreach($values as $val)
{ ?>
<tr>
	<?php
	foreach($getcolms as $getcolm)
	{
		 $field = $getcolm->Field; 
?>

<td><?php echo $val->$field; ?></td>

<?php } //getcolm close ?>

<td>
<p><a href="../admin/add.php?type=<?php echo $tablename ?>&tmpl=<?php echo $tmpl ?>&id=<?php echo $val->$ctid; ?>" title="Edit <?php echo $tablename ?>"><i class="icon-edit"></i></a></p>
<a href="../admin/view.php?type=<?php echo $tablename ?>&tmpl=<?php echo $tmpl ?>&id=<?php echo $val->$ctid; ?>" title="Delete <?php echo $tablename ?>" ><i class="icon-trash"></i></a>
</td>

<?php 	} //get values  ?>
</tr>
   </tbody>
            </table>
<!-- </div> -->
<!-- </div> -->	
<?php	 //} //if close ?>
</div>

    <div class="block span12">
    <?php //if($id != null){ ?> 
         <a href="#tablewidget" class="block-heading" data-toggle="collapse">Users<span class="label label-warning">+10</span></a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Mark</td>
                  <td>Tompson</td>
                  <td>the_mark7</td>
                </tr>
                <tr>
                  <td>Ashley</td>
                  <td>Jacobs</td>
                  <td>ash11927</td>
                </tr>
                <tr>
                  <td>Audrey</td>
                  <td>Ann</td>
                  <td>audann84</td>
                </tr>
                <tr>
                  <td>John</td>
                  <td>Robinson</td>
                  <td>jr5527</td>
                </tr>
                <tr>
                  <td>Aaron</td>
                  <td>Butler</td>
                  <td>aaron_butler</td>
                </tr>
                <tr>
                  <td>Chris</td>
                  <td>Albert</td>
                  <td>cab79</td>
                </tr>
              </tbody>
            </table>
            <p><a href="users.html">More...</a></p>
        </div>
        <?php //} ?>
    </div>
    </div>
  <!-- </form> -->
  
   <div class="block span12">
    <?php //if($id != null){ ?> 
         <a href="#tablewidget" class="block-heading" data-toggle="collapse">Users<span class="label label-warning">+10</span></a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Mark</td>
                  <td>Tompson</td>
                  <td>the_mark7</td>
                </tr>
                <tr>
                  <td>Ashley</td>
                  <td>Jacobs</td>
                  <td>ash11927</td>
                </tr>
                <tr>
                  <td>Audrey</td>
                  <td>Ann</td>
                  <td>audann84</td>
                </tr>
                <tr>
                  <td>John</td>
                  <td>Robinson</td>
                  <td>jr5527</td>
                </tr>
                <tr>
                  <td>Aaron</td>
                  <td>Butler</td>
                  <td>aaron_butler</td>
                </tr>
                <tr>
                  <td>Chris</td>
                  <td>Albert</td>
                  <td>cab79</td>
                </tr>
              </tbody>
            </table>
            <p><a href="users.html">More...</a></p>
        </div>
        <?php //} ?>
    </div>
    