<select name="ddlState" id="ddlState">
    <option disabled selected>Select State</option>
    <?php
            foreach($info as $tmp)
            {
                foreach($tmp as $k => $v)
                {
                    if($k == "state_id")
                    {?>
                        <option value="<?php echo $v;?>"><?php }
                        else if($k == "state_name")
                        {echo $v."</option>";
                    }
                }
            }
    ?>
</select>