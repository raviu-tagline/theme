<select name="ddlState" id="ddlState">
    <option disabled selected>Select State</option>
<?php
    foreach($info as $key => $val)
    {?>
       <option value="<?php echo $val['state_id']?>" <?php echo (set_value('ddlState') == $val['state_id']) ? "selected" : (
           isset($tmpArr['state_id']) && $tmpArr['state_id'] == $val['state_id'] ? "selected" : '');?>><?php echo $val['state_name']?></option>
<?php }?>
</select>