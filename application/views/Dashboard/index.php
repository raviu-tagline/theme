<?php
    $this->load->view('Layout/header.php',"data");
?>
<div id="body">
    <div>
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
                    if(isset($records))
                    {
                        echo "<pre style='color: white;'>";
                        print_r($records);
                        echo "</pre>";
                        die;
                    }
                    else
                    {
                        
                    }
                     $id=1;
                    foreach($rec as $row)
                    {
                        foreach($row as $key)
                        {?>
                            <tr>

                            <?php
                                foreach($key as $sub_key => $value)
                                {
                                        if($sub_key == 'reg_id')
                                        {
                                            $id = $value;
                                        }
                                        if($sub_key == 'reg_pass')
                                        {
                                            continue;
                                        }
                                        if($sub_key == 'reg_image')
                                        {?>
                                            <td><img src="<?php echo base_url("images/uploads/").$value;?>" height="50" width="50"/></td>
                                <?php   }
                                        else
                                        {?>
                                            <td><?php echo $value;?></td>
                            <?php       }
                                        $cid = $this->encryption->encrypt($id);
                                        
                                }?>
                                <td><a href="<?php echo base_url('update/').$cid;?>" name="edit" value="<?php echo $id;?>">Edit</a></td>

                                <td><a href="<?php echo base_url('delete/').$cid;?>" name="delete" value="<?php echo $id;?>">Delete</a></td>

                            </tr>

                <?php   }
                    }
                    
                ?>

            </tbody>
        </table>
    </div>
</div>
<?php
    $this->load->view('Layout/footer.php',"data");
?>