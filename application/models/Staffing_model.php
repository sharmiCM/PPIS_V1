<?php
//$query = $this->db->query();
class Staffing_model extends CI_Model {
 
 function getTeams(){
	 $query = $this->db->query("SELECT * FROM teams");
	 $opt="";
	 foreach ($query->result() as $row){
        $Shiftcode =  $row->teams;
		$opt = $opt."<option value='".$row->value."'>".$row->teams."</b></option>";
	 }
	 return $opt;
 }
 
 function getSelectedTeam($one){
	 $query = $this->db->query("SELECT * FROM signup WHERE TeamName LIKE '".$one."'");
	 return $query;
 }
 
 function getTeamShiftes($date,$date2,$empId){
	 $query = $this->db->query("SELECT r.Shiftcode,r.empid,r.DATE  FROM roster_table r WHERE  r.DATE BETWEEN '".$date."' AND '".$date2."' AND r.empid = '".$empId."'");
	 foreach ($query->result() as $row){
		 $chosenCategory = $row->Shiftcode;
	 }
	 return $chosenCategory;
 }
 
 function getShiftTime(){
	  $query = $this->db->query("SELECT intime,outtime,ID,Shifts FROM roster");
	  return $query;
 }

 function getRosters(){
	$query = $this->db->query("Select * from roster");
	  return $query; 
 }

 function createRosters($date,$empid,$name,$Shift,$teamNamevar){
	$query = $this->db->query("SELECT * FROM roster_table WHERE DATE='".$date."' && empid='".$empid."'");	
	$selectQueryNor = $query->num_rows();
	if($selectQueryNor==0){
		$query = $this->db->query("INSERT INTO roster_table(empid,DATE,name,Shiftcode,Team) VALUES ('".$empid."','".$date."','".$name."','".$Shift."','".$teamNamevar."')");
		//return "INSERT INTO roster_table(empid,DATE,name,Shiftcode,Team) VALUES ('".$empid."','".$date."','".$name."','".$Shift."','".$teamNamevar."')";
	}	
 }
}//end of CI_Model