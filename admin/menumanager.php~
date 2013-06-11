
<?php
include_once('includes/header.php');
?>
<?php
if(isset($_POST['submit']))
        {
        $title= $_POST['title'];
        $title= $db->query("INSERT INTO menu_table VALUES('','$title')");
        header('location:menumanager.php');
        }
        
if(isset($_GET['id']) && isset($_GET['action']) )
{
	$tablename = 'menu_table';
	delete($_GET['id'],$tablename);
}
?>
<div class="content">
   <div class="container-fluid">
            <div class="row-fluid">
<div class="block span12">
    <div id="portlets">
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left">
      <!--THIS IS A PORTLET-->
        <div class="portlet">
            
            <div class="portlet-content">
            <!--THIS IS A PLACEHOLDER FOR FLOT - Report & Graphs -->
        <?php

        if(isset($_GET['type']))
        {


        ?>

        <form method='POST' action=''>

        Title :<input type='text' name='title'><br />
        <input type='submit' name='submit' value='submit'>
        </form>


        <?php


        }
        ?>

        <?php
        $menu= $db->get_results("SELECT * FROM menu_table");

        if($menu)
        {

        ?>

<div class="pull-right span4 offset-3">
<a href="add.php?type=menu_table&tmpl=default" class="btn btn-info" >Add New Menu</a>
</div>
<table id='box-table-a' width='100%'><thead>
<tr>
    </tr></thead>
    <?php
    foreach($menu as $menus)
    {
    ?>
    <tr><td><?php echo $menus->m_title;?></td><td></td><td></td>
    <td><!--<a href='view.php?type=menu_table&tmpl=default&id=<?php echo $menus->m_id;?>'>View</a> |-->
    <a href='details.php?type=menu_links&tmpl=default&id=<?php echo $menus->m_id;?>' title="View All Menu "><i class="icon-list"></i></a> |
    <a href='add.php?type=menu_table&tmpl=default&id=<?php echo $menus->m_id;?>' title="Edit Menu"><i class="icon-edit"></i> </a>| 
    <a href="#myModal<?php echo $menus->m_id;?>" role="button" data-toggle="modal"><i class="icon-remove"></i></a> |
<div class="modal small hide fade" id="myModal<?php echo $menus->m_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">ÃƒÂ—</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <a href="../admin/menumanager.php?id=<?php echo $menus->m_id;?>&action=delete" class="btn btn-danger" >Delete</a>
    </div>
</div>
    <a href='new_menu.php?m_id=<?php echo $menus->m_id;?>'>new</a></td></tr>


            <?php
            }
            ?>
            </table>
            <?php
            }

            ?>
            </div>
        </div>
      
      </div>
   


        
</div>
<!-- WRAPPER END -->
<?php
//include_once('./include/footer.php');
?>
</div>
</div>
</div>
</div>


</body>
</html>


