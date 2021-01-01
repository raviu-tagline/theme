<?php
    $this->load->view('Layout/header.php',"data");
?>
<div id="body">
    <div class="table">
        <table border="1" width="100%" style="color:white;" height="100%">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Gender</td>
                    <td>Birth Date</td>
                    <td>Mobile</td>
                    <td>Address</td>
                    <td>Image</td>
                    <td colspan="2">Actions</td>
                </tr>
            </thead>
            <tbody>

                <?php
                    if(isset($record)):
                        echo "<pre style='color: white;'>";
                        print_r($record);
                        echo "</pre>";
                        die;
                    endif;
                    $ind = 1;
                    $id='';
                    foreach($records as $row):?>
                        <tr>
                    <?php   foreach($row as $key => $value):
                                if($key == 'reg_image'):?>
                                    <td><img src="<?php echo base_url("images/uploads/").$value;?>" height="50px" width="50px"/>
                        <?php   elseif ($key == 'reg_pass'):
                                    continue;
                                elseif ($key == 'reg_id'):
                                    $id = $value;
                                    echo "<td>{$ind}</td>";
                                else:?>
                                    <td><?php echo $value;?></td>
                        <?php   endif;
                                // $cid = $this->encryption->encrypt($id);
                                $cid = $id;
                            ?>
                    <?php   endforeach;?>
                                <td><a href="<?php echo base_url('update/').$cid;?>" name="edit" value="<?php echo $id;?>">Edit</a></td>

                                <td><a href="<?php echo base_url('delete/').$cid;?>" onClick="javascript: return confirm('Are you sure to delete this record ?');" name="delete" value="<?php echo $id;?>">Delete</a></td>
                        </tr>
            <?php   $ind += 1;
                    endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php
    $this->load->view('Layout/footer.php',"data");
?>