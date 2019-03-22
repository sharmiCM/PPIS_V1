$(document).ready(function(){
	var c = $("#dates > tbody >tr >td");
	c[0].style.color='white';c[0].style.textAlign='center';c[0].style.fontFamily='unset';c[0].style.backgroundColor='grey';c[0].style.width='60%';
	$( "#attendance" ).datepicker({
		inline: true,
		dayNamesMin: [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ],
		showWeek: true,
		onChangeMonthYear: function( year, month, inst ){
			monthCurr=(month<10)?'0'+(month):(month);
			var s = setInterval(function() {
			displayAttendance(monthCurr,yearCurr);
			clearInterval(s);
			},500);			
		}
	});
	var monthCurr= $(".ui-datepicker-month")[0].innerText; var yearCurr= $(".ui-datepicker-year")[0].innerText;
	monthCurr = monthCurrfn(monthCurr);
	displayAttendance(monthCurr,yearCurr);
});
var orderDate=[];var ordDat=0;var tableCal;
var today = new Date();
var dd = today.getDate();var mm = today.getMonth() + 1;

dd = (dd < 10)?('0' + dd):dd;	mm = (mm < 10)?('0' + mm):mm;
dateSelectedVal = dd + '/' + mm + '/' + today.getFullYear();


var daySelectedVal="";
function monthCurrfn(monthCurr){
	var mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	for(var ie=0;ie<mlist.length;ie++){
		if(mlist[ie]==monthCurr){
			if((ie+1)<10){
				monthCurr=(ie<10)?'0'+(ie+1):(ie+1);
			}
			else{
				monthCurr=(ie<10)?(ie+1):(ie+1);
			}
		}
	}
	return monthCurr;
}
function displayAttendance(monthCurr,yearCurr){
	var inf = ((document.cookie).split("=")[1]).split("--");
	
	tableCal = $(".ui-datepicker-calendar")[0].children[1].children;	//$(".ui-datepicker-calendar")[0].style.Minwidth="770px";	$(".ui-datepicker-calendar")[0].style.Maxwidth="900px";
	for(var i=0;i<tableCal.length;i++){//for table row
		var tdCal = tableCal[i].children;
		for(var j=0;j<tdCal.length;j++){
			if(tdCal[j].className != " ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled" && tdCal[j].className!=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled" && tdCal[j].className!="ui-datepicker-week-col"){
				tdCal[j].style.columnWidth="40px";
				var dateCur = (Number(tdCal[j].innerText)<10)? "0"+Number(tdCal[j].innerText) : Number(tdCal[j].innerText);
			var data = dateCur+"/"+monthCurr+"/"+yearCurr;
			$.ajax({
				type:'POST',
				url:$(".base")[0].value+"/Home/getCalendarResult",//attendancePM.php
				data:{date:"",empId:inf[0],name:inf[1],check:1,calDate:data,trow:i,tdata:j},
				success:function(html){
					//console.log(html);
					var date = html.split("_")[1];
					var hip = html.split("*"); var und = (hip[1]).split("_");
					var late = (html.split("*")[0]).replace("		","");								
					var cc = tableCal[und[3]].children[und[4]];
						orderDate[Number(und[1])] = late;
						if(late!='0'){
							if(late==''){
									cc.innerHTML="<a class='ui-state-default' style='text-align: -webkit-center;border: 0px;'>"+und[1]+"</a>";//late
								}
							else{
								cc.innerHTML="<a class='ui-state-default' style='text-align: -webkit-center;color:red;'>"+und[1]+"</a>";
							}
						}
						
					if(und[6]=='1'){
						cc.childNodes[0].style.backgroundColor="lightgray";
					}
					ordDat++;
					
					var d = new Date();
					var currentMonth = d.getMonth()+1;
					d= (""+d).split(" ")[2];
					var reD = (und[2]).split("/");
					
					if(und[7]!='' && und[7]!="Week off" && currentMonth==Number(reD[1]) && late!=""){
						if(late!="1"){	cc.childNodes[0].innerHTML = und[1]+"  ("+und[7]+")";	}
						if(late=="0"){	cc.childNodes[0].innerHTML = und[1];	}
					 }
	
					if(Number(currentMonth) == Number(reD[1])){
						if(Number(reD[0]) <= Number(d)){
							totalDays++;
							if(late=="1"){
								totalLateDays++;
							}
						}
					}
					else{
						totalDays++;
						if(late=="1"){
							totalLateDays++;
						}
					}
					if(dateSelectedVal==und[2]){
						$("#shedI")[0].innerHTML= und[8];
						$("#shedO")[0].innerHTML= und[9];
						$("#actI")[0].innerHTML= (und[5]=="")?"-":(und[5]);
						$("#actO")[0].innerHTML= (und[10]=="")?"-":(und[10]);
						$("#hrsPres")[0].innerHTML= (und[11]=="")?"-":und[11];
						$("#inoutCal").show();daySelectedVal=und[12];
						$("#daySelected")[0].innerHTML = daySelectedVal.toUpperCase();
						$("#dateSelected")[0].innerHTML = und[1];
						$("#puncRea")[0].innerHTML = "Reason:- "+und[13];
						dateSelectedVal="";
					}
					if(ordDat==Number(und[0])){
						$(".ui-datepicker-calendar >tbody >tr >td >a").css({'border':'0px'});
						$("#puncPer").html("Punctuality Percentage:&nbsp;&nbsp;"+(((totalDays-totalLateDays)*100)/totalDays).toFixed(0)+"%");totalDays=0;totalLateDays=0;ordDat=0;
						$("#attendance > div >table >tbody >tr >td").click(function(res,val) {
							if(res.target.className!="ui-datepicker-week-col"){
								if(isNaN(res.target.innerHTML)){
									var val = (res.target.innerHTML).split(" ")[0];
									dateSelectedVal= val+"/"+monthCurr+"/"+yearCurr;
								}
								else{
									dateSelectedVal= res.target.innerHTML+"/"+monthCurr+"/"+yearCurr;
								}
								displayAttendance(monthCurr,yearCurr);
							}
						});
					}
				}
			});
			}
		}
	}	
}
var totalDays =0;var totalLateDays =0; var dateSelectedVal;