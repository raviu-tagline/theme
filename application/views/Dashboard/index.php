<?php
    $this->load->view('Layout/header.php',"data");
?>
<div id="body">
    <div>
        <h1>Records</h1>
        <br>

        <a id='addRecords' href="<?php echo base_url('register');?>" style='width: 200px !important;'>Add records</a>
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
                        <td>Country</td>
                        <td>State</td>
                        <td>City</td>
                        <td>Address</td>
                        <td>Image</td>
                        <td>Status</td>
                        <td colspan="2">Actions</td>
                    </tr>
                    <tr>
                        <td>---</td>
                        <td><input type="search" id='name' placeholder="Search Name"></td>
                        <td><input type="search" id='email'placeholder="Search Email"></td>
                        <td>
                            <select id='ddlgen'>
                                <option disabled selected>Select gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </td>
                        <td>-----------------</td>
                        <td><input type="search" id='number' placeholder="Search Number"></td>
                        <td>
                            <select id='ddlCountry'>
                                <option disabled selected>Select Country</option>
                                <?php
                                    foreach($country as $key => $val)
                                    {?>
                                        <option value="<?php echo $val['country_id']; ?>"><?php echo $val['country_name'];?></option>
                                <?php }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select id='ddlState'>
                                <option disabled selected>Select State</option>
                            </select>
                        </td>
                        <td>
                            <select id='ddlCity' disabled>
                                <option disabled selected>Select City</option>
                            </select>
                        </td>
                        <td><input type="search" id='address' placeholder="Search Address"></td>
                        <td>---------</td>
                        <td>
                            <select id='ddlstatus'>
                                <option disabled selected>Select Status</option>
                                <option>Active</option>
                                <option>Deactive</option>
                            </select>
                        </td>
                        <td colspan='2'><button id='submit'>Filter</button></td>
                    </tr>
                </thead>
                <tbody> 
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
                                            <button id="sub" value='<?php echo $val['status_id'];?>'><?php echo $val['status_name'];?></button>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('update/').$id;?>" name="edit" value="<?php echo $id;?>">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" onClick="javascript: return confirm('Are you sure to delete this record ?');" name="delete" id="delete" value="<?php echo $id;?>">
                                            Delete
                                        </a>
                                    </td>
                                    <input type='hidden' name='hdnID' id='hdnID' value='<?php echo $id;?>'/>
                                </tr>
                    <?php   $ind++;} 
                        }
                        else
                        {
                            echo "<tr style='height: 390px;'><td colspan='13' class='error' style='text-align: center;font-size: xxx-large !important;font-family: Arial;'>No Record Found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $("td").on('click','#sub',function (){
            var id = $(this).parents('tr').find('#hdnID').val();
            var value = $(this).val();

            $.ajax({
                type: 'post',
                url: '<?php echo base_url('Dashboard_Controller/getStatus');?>',
                data: {id: id, value: value},
                success: function(response){                    
                    var tmp = JSON.parse(response);
                    $('#data'+id).html("<button id='sub' value="+tmp.value+">"+ tmp.status +"</button>");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        });

        $('td').on('click','#delete',function (){
            var id = $(this).parents('tr').find('#hdnID').val();
            var el = $(this).parents('tr');
            $.ajax({
                url: '<?php echo base_url('delete/').$id;?>',
                method: 'post',
                data: {id: id},
                beforeSend: function() {
                    el.animate({
                        visibility: 'hidden',
                        opacity: 0,
                        transition: 'visibility 0s 2s, opacity 2s linear'
                    }, 200);
                },
                success: function(resp) {
                    el.slideUp('slow', function (){
                        el.remove();
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        });

        $('#submit').on('click', function(){
            var name = $('#name').val();
            var email = $('#email').val();
            var number = $('#number').val();
            var gender = $('#ddlgen').val();
            var addr = $('#address').val();
            var status = $('#ddlstatus').val();
            var country = $('#ddlCountry').val();
            var state = $('#ddlState').val();
            var city = $('#ddlCity').val();

            $.ajax({
                url: '<?php echo base_url('Dashboard_Controller/filterData')?>',
                method: 'post',
                data: { 
                    name: name, 
                    email: email,
                    number: number,
                    gender: gender,
                    address: addr,
                    status: status,
                    country: country,
                    state: state,
                    city, city
                },
                success: function(resp) {
                    var html = jQuery.parseHTML(resp);
                   $('tbody').html(html);
                }
            });
        });
    })
</script>
<?php
    $this->load->view('Layout/footer.php',"data");
?>