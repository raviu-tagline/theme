
    <?php
        $ind = 1;
        $id='';

        $str = '';
        
        if($records != FALSE)
        {
            foreach($records as $row){?>
                <tr class='ajaxContent'>
            <?php   foreach($row as $key => $value){
                        if($key == 'reg_image')
                        {?>
                            <td><img src="<?php echo base_url("images/uploads/").$value;?>" height="50px" width="50px"/>
                <?php   } 
                        elseif ($key == 'reg_pass')
                        {
                            continue;
                        } 
                        elseif ($key == 'reg_id') 
                        {
                            $id = $value;
                            echo "<td id='id'>{$ind}</td>";
                        } 
                        elseif($key == 'reg_status')
                        {
                            echo "<td id='lblstatus'><div id='data$id' class='status'><button id='sub' value='$id'>$value</button></div></td>";
                        } 
                        else
                        {?>
                            <td><?php echo $value;?></td>
                <?php   }
                        // $cid = $this->encryption->encrypt($id);
                        $cid = $id;
                    ?>
            <?php   }?>
                        <td><a href="<?php echo base_url('update/').$cid;?>" name="edit" value="<?php echo $id;?>">Edit</a></td>

                        <td><a href="<?php echo base_url('delete/').$cid;?>" onClick="javascript: return confirm('Are you sure to delete this record ?');" name="delete" value="<?php echo $id;?>">Delete</a></td>
                </tr>
        <?php   $ind += 1;
            }
        }
        else
        {
            echo "<tr><td colspan='10' class='error' style='text-align: center'>No Record Found</td></tr>";
        }
    ?>