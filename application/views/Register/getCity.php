<select name="ddlCity" id="ddlCity">
    <option disabled selected>Select City</option>
    <?php
    foreach($info as $key => $val)
    {?>
       <option value="<?php echo $val['city_id']?>"><?php echo $val['city_name']?></option>
<?php }?>
</select>