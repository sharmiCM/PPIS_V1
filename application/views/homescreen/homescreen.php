<style>
body {
    background: #424b5d;
}
.centered2 {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}
.ui-widget.ui-widget-content{
	width: 100%;
	cursor:pointer;
}
.ui-datepicker-calendar{
	line-height: 50px;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
	/*font-weight: 200;
	border-radius: 20px;*/
}

#tableForMail  {
    font-family: arial;
    border-collapse: collapse;
}

#tableForMail td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
#wrapperr{
	background:url("img/template.png")
}
.ui-datepicker .ui-datepicker-header {
    background-color: white;
    border: 0px;
}
#inoutCal{
	background:transparent; line-height:30px;width: 98%; border-radius: 10px;color: white; font-size: small;
}
#inoutCal th{
	border: 0px;border-right: 1px solid white;text-align: -webkit-center;
}
#welc{
	text-align:center; font-family:Futura,Trebuchet MS,Arial,sans-serif;color:white;
}
#myrandomtext{
	text-align:center; font-family:courier; color:white;font-size:46px; display:none;
}
#dates{
	width:55%; line-height: 40;margin-left: 20%;margin-top: 5%;font-family: Futura,Trebuchet MS,Arial,sans-serif; box-shadow: 3px 4px grey;

#daySelected{
		height: 80px; line-height:0px; background: transparent;
}
#dateSelected{
		font-size: 75px; line-height:0px;
}
#puncRea{
		height: 25px; line-height:0px;    margin-top: 50px;
}
#puncPer{
		height: 25px; line-height:0px;
}
	

</style>
<section class="content-header">
    <h1 id="welc"><b>Welcome</b></h1>	
	<table id="dates">
		<tr>
		<td>
		<h2 align='center' id='daySelected'></h2>
		<h1 id='dateSelected'>00</h1>
		<h5 id='puncRea'>Reason: - </h5>
		<h5 id='puncPer'></h5>
			<table align='center' id="inoutCal">
			<tr><th></th><th>Intime</th><th>Outtime</th><th>Hours</th></tr>
			<tr><th>Scheduled</th><th id='shedI'>Intime</th><th id='shedO'>Outtime</th><th>9.00</th></tr>
			<tr><th>Actual</th><th id='actI'>Intime</th><th id='actO'>Outtime</th><th id='hrsPres'>Hours</th></tr>
			<tr><td></td><td></td><td></td></tr>
			</table>
		</td>
		<td><div id="attendance"></div></td>
		</tr>
	</table>
</section>

<!-- Main content -->
<section class="content">
  
<?php
$this->load->library('session');
$session_data = $this->session->userdata('EmployeeID')."--".$this->session->userdata('fName')."".$this->session->userdata('lname')."--".$this->session->userdata('user_level')."--".$this->session->userdata('TeamName')."--".$this->session->userdata('fName');
setcookie("cookie",$session_data, time() + (86400 * 30), "/");
?>
<script src="<?php echo base_url();?>public/js/homescreen.js"></script>  

</section>