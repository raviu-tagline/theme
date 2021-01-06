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
                        foreach($records as $row){?>
                            <tr>
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
                                        echo "<td id='id' >{$ind}</td>";
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
                        }?>
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
    })
</script>
<?php
    $this->load->view('Layout/footer.php',"data");
?>