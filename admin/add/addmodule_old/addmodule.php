<?php
global $db;
if($_POST){
    if(isset($_POST['title'])){
        $title = $_POST['title'];
        $position = $_POST['position'];
        $status = $_POST['status'];
        $modid = $_POST['modid'];

        $insertquery = $db->query("INSERT INTO moduledata VALUES ('','$title','','$status','$modid','','$position')");
        $addedid = $db->insert_id;
        foreach($_POST as $key => $value)
{
    echo 'key is:'.$key.'';
    echo '<br />';
    if ($key != "title" && $key !="status" && $key !="position" && $key !="modid"){
        $insert = $db->query("INSERT INTO moduleparams VALUES('','$addedid','$key','$value')");        
    }



}
        //$insert1 = $db->query("");

}
}
?> 
<div class='span12'>
<?php
            if(isset($_GET['modid'])){ ?>
                <form method="post" action="">
                    <input type="text" name="title" value="" />
                    <input type="hidden" value="<?php echo $_GET['modid'] ?>" name="modid" />
                    <select name="status">
                        <option selected="selected" value="1">Active</option>
                        <option value="0">InActive</option>

                    </select>
                    <select name="position">
                    <option value="left"> Left </option>
                    <option value="right">Right</option>
                    <option value="top">Top</option>
                    <option value="bot1">Bottom Left </option>
                    <option value="bot2">Bottom Right</option>
                    </select>

            <p class="info" id="info"><span class="info_inner">Module Configuration</span></p>

            <?php
            $modid = $_GET['modid'];
            echo 'modid :'.$modid;
            $getmodinfo = $db->get_row("SELECT * FROM moduletype WHERE mod_id='$modid'");
 //include_once(rootfolder.'/modules/'.$getmodinfo->mod_folder.'/config.php');
 include_once('../modules/'.$getmodinfo->mod_folder.'/config.php');
 print_r($getmodinfo->mod_folder);
            ?>
            <input type="submit" />

            </form>

            <?php } else {

            $getmods = $db->get_results("SELECT * FROM moduletype");
            foreach($getmods as $getmod){
                echo '<a href="add.php?type=addmodule&modid='.$getmod->mod_id.'">'.$getmod->mod_name.'</a><br></br>';
//add.php?type=addmodule&modid=1
            }}



            ?>


</div>