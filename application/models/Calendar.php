<?php
//$query = $this->db->query();
class Calendar extends CI_Model {
 function validateAttend($dateForQuery,$empID)
 {
	$this->load->database('new');	
	$query = $this->db->query("select * from attendance where Date='".$dateForQuery."' and empId='".$empID."'");
	$totalfound = $query->num_rows();
  return $totalfound;
 }
 
 function getRosterTime($empID){
	 $query = $this->db->query("SELECT Shiftcode,empid,Team FROM `roster_table` WHERE Date='".date('Y-m-d')."' AND empid='".$empID."'");	 
	 return $query;
 }
 
 function insertInAttendance($firstName,$empID,$lateVar){
	 $query = $this->db->query("INSERT INTO attendance(Name,Date,markinDate,empId,Late) VALUES ('".$firstName."','".date('d/m/Y')."','".date('Y-m-d G:i:s')."','".$empID."','".$lateVar."')");
 }
 
function getAttendance($empId,$calDate){		
		$query = $this->db->query("select * from attendance where Date='".$calDate."' AND empId='".$empId."'");
		return $query;
}
function getroster_table($empId,$calDate){
	$dateds = explode("/",$calDate);
	$query = $this->db->query("select * from roster_table where DATE='".$dateds[2]."-".$dateds[1]."-".$dateds[0]."' AND empid='".$empId."'");			
	return $query;
}
function getlogins($empId,$calDate){
	$dateds = explode("/",$calDate);
	$query = $this->db->query("select * from login where DATE='".$dateds[2]."-".$dateds[1]."-".$dateds[0]."' AND EmployeeID='".$empId."'");
	return $query;
}
function getroster($shiftCode){
	$query1 = $this->db->query("SELECT * FROM `roster` where ID='".$shiftCode."'");
	return $query1;
}


}//end of CI_Model