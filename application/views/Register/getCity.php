<select name="ddlCity" id="ddlCity">
    <option disabled selected>Select City</option>
    <?php
            foreach($info as $tmp)
            {
                foreach($tmp as $k => $v)
                {
                    if($k == "city_id")
                    {?>
                        <option value="<?php echo $v;?>"><?php }
                        else if($k == "city_name")
                        {echo $v."</option>";
                    }
                }
            }
    ?>
</select>