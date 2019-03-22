<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
	parent::__construct();
		$this->load->library('template');
		$this->load->helper('url');
	}
	
	public function index()
	{
		date_default_timezone_set('Asia/Calcutta');$elapseTime=0;
		$curDate=date('Y-m-d G:i:s');		
		$dates = explode(":",explode(" ",date('Y-m-d G:i:s'))[1])[0];
		if((int)$dates>=5){
			$dateForQuery = date('d/m/Y');
		}
		else{
			$dateForQuery = date('d/m/Y', strtotime('-1 day'));
		}		
			
		$CI =& get_instance();
		$CI->load->model('Calendar');
		$numberOfRows = $CI->Calendar->validateAttend($dateForQuery,$_SESSION['EmployeeID']);
		
		if($numberOfRows<1){
			$query = $CI->Calendar->getRosterTime($_SESSION['EmployeeID']);
			foreach ($query->result() as $row){
				$Shiftcode =  $row->Shiftcode;
				$query1 = $this->db->query("SELECT * FROM `roster` where ID='".$Shiftcode."'");
				foreach ($query1->result() as $row1){
					$intime =  $row1->intime;
					$intime = date('Y-m-d')." ".$intime;
					$timestamp1 = strtotime($intime);	$curDate=date('Y-m-d G:i:s');
					$timestamp2 = strtotime($curDate);
					$usedHour = ($timestamp1 - $timestamp2);
					if(((int)$usedHour)<0){
						$lateVar=1;
					}
					else{
						$lateVar=0;
					}
				}
			 }
			
			$insert = $CI->Calendar->insertInAttendance($_SESSION['fName'],$_SESSION['EmployeeID'],$lateVar);
		}
	
		$this->CI = & get_instance();
		$this->template
				->title('Home','My App')
				->build('homescreen/homescreen');
	}
	public function getCalendarResult(){
		$lateVal="";$weekOffs='';
		date_default_timezone_set('Asia/Calcutta');$markinDate="";$markoutDate="";
		$calDate= $_POST['calDate'];
		$dateds = explode("/",$calDate);
		$d=cal_days_in_month(CAL_GREGORIAN,(int)$dateds[1],(int)$dateds[2]);
		
		$this->load->model('Calendar'); 
		$query = $this->Calendar->getAttendance($_POST['empId'],$calDate);
		
		foreach ($query->result() as $row){
			$markinDate =  $row->markinDate;
			$markoutDate =  $row->markoutDate;
			$lateVal =  $row->Late;
		}
		
		//if($lateVal==""){
			$query = $this->Calendar->getroster_table($_POST['empId'],$calDate);
//echo $query;			
			foreach ($query->result() as $row){
				if( $row->Shiftcode=='26'){	$weekOffs=1;	}
				$shiftCode = $row->Shiftcode;
			}
		//}
		$reason='';
		$query = $this->Calendar->getlogins($_POST['empId'],$calDate);
		foreach ($query->result() as $row){
			$reason =  $row->Reason;
		}
		$shedI='';$shedO='';$hrePres="-";
		$query = $this->Calendar->getroster($shiftCode);
		
		foreach ($query->result() as $row1){
			$shedI=$row1->intime;$shedO=$row1->outtime;$futureShifts = $row1->Shifts;
			if(!$markoutDate){
				$hrePres="-";
			}
			else{
				$timestamp1 = strtotime($markinDate);
				$timestamp2 = strtotime($markoutDate);
				$hrePres = round(($timestamp2-$timestamp1)/3600,2);
			}
		}
		$unixTimestamp = strtotime($dateds[2]."-".$dateds[1]."-".$dateds[0]); 
		$dayOfWeek = date("l", $unixTimestamp);
		//get future shifts
		$timestamp1 = strtotime($calDate);
		$timestamp2 = strtotime(date('d/m/Y'));
		$futureShifts="";
		$differ = $timestamp2-$timestamp1;
		if($differ>0){$futureShifts="";}
		/*if($differ<0){
			$query1 = $this->Calendar->getroster($shiftCode);
			foreach ($query1->result() as $row1){
				$futureShifts = $row1->Shifts;
			}
		}*/
		echo $lateVal."*".$d."_".$dateds[0]."_".$calDate."_".$_POST['trow']."_".$_POST['tdata']."_".$markinDate."_".$weekOffs."_".$futureShifts."_".$shedI."_".$shedO."_".$markoutDate."_".$hrePres."_".$dayOfWeek."_".$reason;/**/
	}	
}
