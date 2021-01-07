<?php
    $this->load->view('Layout/header.php',"data");
?>
<div id="body">
    <div>
        <h1>Records</h1>
        <br>
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
                        <td>Status</td>
                        <td colspan="2">Actions</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="search" id='name' placeholder="Search Name"></td>
                        <td><input type="search" id='email'placeholder="Search Email"></td>
                        <td>
                            <select id='ddlgen'>
                                <option disabled selected>Select gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </td>
                        <td></td>
                        <td><input type="search" id='number' placeholder="Search Number"></td>
                        <td><input type="search" id='address' placeholder="Search Address"></td>
                        <td></td>
                        <td><input type="search" id='status' placeholder="Search Status"></td>
                        <td colspan='2'><button id='submit'>Filter</button></td>
                    </tr>
                </thead>
                <tbody>
                    
                    <!-- <tr></tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $("td").on('click','#sub',function (){
            var id = $(this).val();
            var value = $(this).text();
            $.ajax({
                type: 'post',
                url: '<?php echo base_url('Dashboard_Controller/getStatus');?>',
                data: {id: id, value: value},
                success: function(response){                    
                    var tmp = JSON.parse(response);
                    $('#data'+id).html("<button id='sub' value="+tmp.id+">"+ tmp.value +"</button>");
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
            var status = $('#status').val();

            $.ajax({
                url: '<?php echo base_url('Dashboard_Controller/filterData')?>',
                method: 'post',
                data: { 
                    name: name, 
                    email: email,
                    number: number,
                    gender: gender,
                    address: addr,
                    status: status
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