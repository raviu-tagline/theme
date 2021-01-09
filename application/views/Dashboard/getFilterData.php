<?php
    $ind = 1;
    $id='';

    $str = '';
    
    if($records != FALSE)
    {
        foreach($records as $key => $val)
        {
            $id = $val['reg_id'];?>
            <tr>
                <td><?php echo $ind;?></td>
                <td><?php echo $val['reg_name'];?></td>
                <td><?php echo $val['reg_email'];?></td>
                <td><?php echo $val['reg_gender'];?></td>
                <td><?php echo $val['reg_birth_date'];?></td>
                <td><?php echo $val['reg_mobile'];?></td>
                <td><?php echo $val['country_name'];?></td>
                <td><?php echo $val['state_name'];?></td>
                <td><?php echo $val['city_name'];?></td>
                <td><?php echo $val['reg_address'];?></td>
                <td><img src="<?php echo base_url('images/uploads/'.$val['reg_image']);?>" height="50" width='50' /></td>
                <td id='lblstatus'>
                    <div id="<?php echo 'data'.$id?>" class='status'>
                        <button><?php echo $val['status_name'];?></button>
                    </div>
                </td>
                <td>
                    <a href="<?php echo base_url('update/').$id;?>" name="edit" value="<?php echo $id;?>">
                        Edit
                    </a>
                </td>
                <td>
                    <a href="<?php echo base_url('delete/').$id;?>" onClick="javascript: return confirm('Are you sure to delete this record ?');" name="delete" value="<?php echo $id;?>">
                        Delete
                    </a>
                </td>
            </tr>
<?php   }
    }
    else
    {
        echo "<tr><td colspan='10' class='error' style='text-align: center'>No Record Found</td></tr>";
    }
?>