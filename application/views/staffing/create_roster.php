<style>
input[type="date"]::before {
	color: #999999;
	content: attr(placeholder);
}
input[type="date"] {
	color: #ffffff;
}
input[type="date"]:focus,
input[type="date"]:valid {
	color: #666666;
}
input[type="date"]:focus::before,
input[type="date"]:valid::before {
	content: "" !important;
}
.row{padding:0px 0px 15px 0}
#padding30{padding:30px 0px 10px 0;}
#padding0{padding:0px 0px 0px 18px}
.table.table-hover.table-inverse.table-responsive{width:500px; height:50%}
.textD{padding:0px 0px 15px 0;}
</style>


<!-- Content Header (Page header) -->
<section class="content-header">

</section>

<!-- Main content -->
<section class="content">
	<script>
	$(document).ready(function () {
	$(document).on('change','#shift-11',function(){
		
		 $("#shift_h").val($("#shift-11").val());
		 var shift_h =$("#shift-11").val();
		  $.ajax({
					type:'POST',
					URL:"<?php echo base_url();?>public/Reports/roster_ajax.php",
					data:{'shift_h':shift_h},
					success:function(data){
					var nums=$("#shift_h1").val(data);
					//alert(data);
					}
				}); 
		});
	});
	</script>
	<script type="text/javascript">
		function recp(id) {
		$('#myStyle').load('test.php?id=' + id);
		}
		function changenextdropdown(ret){
			var tdLen  = ret.parentElement.parentElement.cells.length;
			var selIndex = ret.selectedIndex;
			 for (var i = ret.parentElement.cellIndex; i < tdLen; i++) {
			//ret.parentElement.nextElementSibling.nextElementSibling.firstElementChild[ret.selectedIndex].selected = true;
			ret.parentElement.parentElement.cells[i].nextElementSibling.nextElementSibling.firstElementChild[ret.selectedIndex].selected = true;
			 }
		}
	</script>
<?php
error_reporting(0);		
	$one=$_POST['teamname'];//$this->session->userdata('TeamNames');
	$date = $_POST['date'];//$this->session->userdata('dates');
	$date2 = $_POST['date2'];//$this->session->userdata('date2');
	$si=1;
	$da=1;
	 $na=1;
	 
	 $CI =& get_instance();
	$CI->load->model('Staffing_model');
	$opt = $CI->Staffing_model->getTeams();
	
?>
<div class="row">
	<form id="myform" action="<?php echo base_url(); ?>Staffing/index" method="POST">
	<div class="col-sm-2">
		<input type="date"  name="date" id="date" placeholder="Start Date" value="<?php echo $date;?>" required>
	</div>
	<div class="col-sm-2">
		<input type="date" placeholder="End Date" name="date2" id="date2" value="<?php echo $date2;?>" required>
	</div>
	<div class="col-sm-2">
		<select name="teamname" class="form-control" id="leave" onchange="showUser(this.value)">
			<?php
			echo $opt;
			?>
		</select>
	</div>
	<div class="col-sm-5">
		<input type="submit" class="btn btn-primary" name="submit" value="GO" onClick="recp('1')">
	</div>
	</form>
</div>

<div id="textD">
	<?php
		echo '<font size="2px" face="Arial"><span>Start :  </span>'; echo $date; echo  '<br>';
		echo '<span>End :  </span>'; echo $date2; echo  '<br>';
		echo '<span>Team :  </span>'; echo $one;
	?>
</div>


<div class="row">
			<form action="" method="POST">
		<div>
			<table class="table table-striped table-bordered one table-responsive">

			<tr>
				<th>Count</th>
				<th>Employee ID</th> 
				<th>Employee Name</th>
				<th>Team Name</th>
				
					<?php   

			for($d=$date;$d<=$date2;)
			{?>
			<td><input type="hidden" name="arraycoun[]"><input type="hidden" name="date<?php echo $da;?>" value="<?php echo $d;?>"><?php  echo $d; ?>
				<?php 
				$d++;
				$da++;
			}?>
			</tr>
			<tr>

			
			<?php 
		$CI->load->model('Staffing_model');
		$opts = $CI->Staffing_model->getSelectedTeam($one);
		foreach ($opts->result() as $row){
		?>

		<tr>
			<td><?php echo $si; ?></td>
			<td> <input type="hidden" name="arraycount[]"> <input type="hidden" name="empid<?php echo $si; ?>" value="<?php echo $row->EmployeeID?>" > <?php echo $row->EmployeeID ?></td>
			<td><input type="hidden" name="arrayc[]"><input type="hidden" name="name<?php echo $na; ?>" value='<?php echo $row->Firstname.' '.$row->Lastname?>'><?php echo $row->Firstname.' '.$row->Lastname;?></td>
			<td><input type="hidden" name="arraycTeam[]"><input type="hidden" name="teamNames<?php echo $na; ?>" value='<?php echo $row->TeamName?>'><?php echo $row->TeamName;?></td>

		<?php
		 
		$ro=1;
		  for ($j=1;$j<$da;$j++)  
		  {
			$CI->load->model('Staffing_model');
			$chosenCategory = $CI->Staffing_model->getTeamShiftes($date,$date,$row->EmployeeID);

			$CI->load->model('Staffing_model');
			$result = $CI->Staffing_model->getShiftTime();
			

		?>	
		<td>
		<select class="shift"  onchange="changenextdropdown(this);" id="shift-<?PHP echo $si.$j; ?>" name="shift<?PHP echo $si.$j; ?>"> 
		<?PHP
		foreach ($result->result() as $row){
		if($row->ID == $chosenCategory)
		{
			?>  <option name="shiftcode<?PHP echo $ro; ?>"  selected value=<?PHP  echo $row->ID ?>  > <?PHP echo $row->Shifts; ?> </b></option>";			
	<?PHP 
		}
		else
		{?>
			<option name="shiftcode<?PHP echo $ro; ?>" value=<?PHP  echo $row->ID ?>  > <?PHP echo $row->Shifts; ?> </b></option>";
		
			<?PHP
		}

		?>
		
		<?PHP echo $ro++;
		}
		?>
		</select>

		</td> <input type="hidden" name="kcount[]"value="<?PHP echo $k; ?>"> 
		  <?php  echo $k;
		  }   ?>  
		  
		</tr>

		<?php 
			$na++;
		   $si++; 
		   $j++; 
			}
		 ?>		 
		 </table>
		</div>
	<div id="padding0">
		<input type="submit"  class="btn btn-success" name="Register" value="Submit">
	</div>	 
		 </form>
	</div>
<button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Roster Timings</button>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Shift Codes</h4>
        </div>
        <div class="modal-body">
		
		<!--  Baala content -->
          	<div class="row">
		<div class="col-md-offset-1">
			<table class=" table table-hover table-inverse  table-responsive ">

			<tr class=" bg-primary">
			<th>Shift ID</th>
			<th>Shift Code</th>
			<th>In time</th>
			<th>Out time</th>
			<th>Duration</th>
			</tr>

			<?php  
			
			$CI->load->model('Staffing_model');
			$result = $CI->Staffing_model->getRosters();
			foreach ($result->result() as $row){			
			 $id = $row->ID;
			 $Shifts = $row->Shifts;
			 $intime = $row->intime;
			 $outtime = $row->outtime;
			 $totalhours = $row->totalhours;
			
			?>
			<tr class="bg-info">
			<td scope="row"><?php echo $id ?></td>
			<td><?php echo $Shifts ?></td>
			<td><?php echo $intime ?></td>
			<td><?php echo $outtime ?></td>
			<td><?php echo $totalhours ?></td>
			</tr>
			<?php } ?>
			</table>
		</div>
	</div>
		<!--  Baala content Ends-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <?php 

if($_POST['Register'])
{
$arraycount=$_POST['arraycount'];
  $total=count($arraycount);   
  
$arraycoun=$_POST['arraycoun'];
$total1=count($arraycoun); 
  for($a=1;$a<=$total;$a++)
	{	  
  for($b=1;$b<=$total1;$b++)
  {			
		$date=$_POST['date'.$b];
		$empid=$_POST['empid'.$a];	
		$name=$_POST['name'.$a];	
		$Shift=$_POST['shift'.$a.$b];
		$teamNamevar = $_POST['teamNames'.$a];			
		$CI->load->model('Staffing_model');
		$result = $CI->Staffing_model->createRosters($date,$empid,$name,$Shift,$teamNamevar);				
	}
}
echo "<script>alert('Success')</script>";
	$_POST = array();
	header("Refresh: 0");
	}
	?>
	
</section>
