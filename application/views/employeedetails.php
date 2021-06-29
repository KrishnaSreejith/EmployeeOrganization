<!DOCTYPE html>
<html>
<head>
    <title>Employee Organization</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url(); ?>site/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
<h11><u>Employee information for an organization</u><?php if(!empty($employeeInfo)){?>(Total Records :  <?php  echo  $total_count; ?> ) <?php } ?>
 </h11>
     
    
<span class="alert-success">
    <h3><b style="margin-left: 500px"> 
    <?=$this->session->tempdata('msg');?> 
     <?=$this->session->tempdata('success');?>
     <?=$this->session->tempdata('error_msg');?></b></h3></span>
  
<table style="width:70%">
  <tr>
    <th>SI.No:</th>
    <th>Employee Code</th>
    <th>Employee Name</th> 
    <th>Department</th>
    <th>Age</th>
    <th>Experience in the organization</th> 
   
  </tr>
  <?php 
  
  if(!empty($employeeInfo)){
   $x= 1 + ($this->pagination->cur_page-1)*$this->pagination->per_page;     
   foreach ($employeeInfo as $value) {
   $from = new DateTime($value['DateofBirth']);
   $to   = new DateTime('today');
   $datetime1 = new DateTime($value['JoiningDate']);
   $datetime2 = new DateTime('today');
   $interval = $datetime1->diff($datetime2);
      
  ?>
  <tr>
     <td><?php echo $x++;?></td>
     <td><?php echo $value['Employeecode'];?></td>
     <td><?php echo $value['Name'];?></td>
     <td><?php echo $value['Department'];?></td>
     <td><?php echo $from->diff($to)->y;?></td>
     <td><?php echo  $interval->format('%y year(s) %m month(s) %d day(s)');?></td>
  </tr>
      <?php  } }else { ?>
  
 <tbody>
 <tr><td colspan="5">No Record(s) found.....</td></tr>
 </tbody>
 
 <?php } ?>
 
</table>
    <br><br><br><br>
          <span style="width:40%">
              
            <?php if (isset($employeeInfo) && is_array($employeeInfo)) echo $page_links; ?>
              
          </span>
        
    
    <br><br> <br><br> <br><br> <br><br> <br><br> <br><br>

    <h2 style=" margin-left: 450px; color: #E74C3C"><u>Upload Details</u></h2>
<div class="alert alert-success alert-dismissible" id="success" style="display:none; width:50% ;color: #009926; text-transform: uppercase
     "></div>

<div style="width:50%; margin-left: 190px;">

    <label for="fname">Employee Code</label>
         <input type="text" id="epcode" name="epcode" placeholder="Employee Code" >

    <label for="lname">Employee Name</label>
         <input type="text" id="epname" name="epname" placeholder="Employee name" >

    <label for="country">Department</label>
        <input type="text" id="dept" name="dept" placeholder="Department" >
    <label for="country">Date of birth</label>
        <input type="date" id="dob" name="dob" placeholder="Date of birth" >

    <label for="country">Joining Date</label>
        <input type="date" id="joining" name="joining" placeholder="Joining Date" >
  
    <button type="submit" class="btn btn-primary" id="butsave">Submit</button>
     
    <br> &nbsp;&nbsp; -OR- <br>
    
    <form action="<?php echo base_url("user/import");?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required="csv"  size="20" >
        <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT CSV" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>files/sample.csv" download="sample.csv" style="color: red;">
            <u>Sample CSV Download</u></a>
            </form> 
   
</div>


<script>
$(document).ready(function() {
	$('#butsave').on('click', function() {
		var epcode = $('#epcode').val();
		var epname = $('#epname').val(); 
		var dept = $('#dept').val();
		var dob = $('#dob').val();
		var joining = $('#joining').val();
		if(epcode!="" && epname!="" && dept!="" && dob!="" && joining!=""){
                 $("#butsave").attr("disabled", "disabled");

			$.ajax({
				url: "<?php echo base_url("user/savedata");?>",
				type: "POST",
				data: {
					type: 1,
					epcode: epcode,
					epname: epname,
					dept: dept,
					dob: dob,
                                        joining:joining
				},
                                      
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$('#fupForm').find('input:text').val('');
						$("#success").show();
						$('#success').html('Data added successfully !'); 
                                                setTimeout(function(){  
                                                $('#success').fadeOut("Slow");  
                                                }, 2000);  
                                      
                                          
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});
</script>


</body>
</html>
