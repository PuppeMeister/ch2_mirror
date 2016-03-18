$(document).ready(function(){

	$.getScript("assets/js/smsSender.js", function(){
			console.log("smsSender is incluced");
	});
	
	/*$("#mainContent").fadeIn(70000);*/
	
	console.log("refreshActiveAlarm is loaded");
	
	var sendSmsButton = "<div class='date_btn'><input type ='submit' value='Send' id='sendSMSButton' name=''/></div>";
	var table = $('#tablealarm').DataTable({
			"sPaginationType":"full_numbers",
			"iDisplayLength": 100,
			"timeout": 60000,
			"dom": "<'top'i>rt<'bottom'flp><'clear'>",	
			
			"ajax": "index.php/alarm/getAlarm",
			
		"columnDefs": [ 
		{ "targets": [0],
		   "data": "alarmname",
		   "width" :"90%"
		},
		{ "targets": [1],
		   "data": "site"
		},
		{ "targets": [2],
		   "data": "category",
		   "width" :"5%"
		},
		{ "targets": [3],
		   "data": "datetime",
		   "width": "40%"
		},
		{ "targets": [4],
		   "data" : "duration",
		   "width": "40%"
		},
		{ "targets": [5],
		   "data": "zone",
		   "width" : "30%"
		},
		
		{ "targets": [6],
		   "data": "manager",
		   "width" : "30%"
		},
		{ "targets": [7],
		   "data": "spvName",
		   "width" : "30%"
		},
		{
			"targets": [8],
			"data" : null,
			"defaultContent": "",
			"width" : "30%"
		},
		{
			"targets": [9],
			"data" : null,
			"defaultContent": "",
			"width" : "30%"
		}],
		
		"createdRow": function( row, data, index ) {
				$(row).find("td:eq(4)").append("  Minutes");
				if( data.duration > 60 ){
					
					/* ------- Send Message Automatically ------ */
					//submitForm(data.alarmname, data.site, data.category, data.datetime, data.duration, data.spvPhone);
					/* ------- -------------------------- ------ */
					
					finalDuration = convertingMinutesToHours(data.duration);
					$(row).find("td:eq(4)").empty();
					$(row).find("td:eq(4)").append(finalDuration);
					//$(row).find("td:eq(4)").replaceWith(finalDuration);
					
					$(row).css({ "background-color" : "#b10f1f", "color" : "#FFF"});
					$(row).find("td:eq(8)").html("Need to Call ( " +data.spvPhone+" )" );
					$(row).find("td:eq(9)").html(sendSmsButton);
					$(row).find("td:eq(9)").find("#sendSMSButton").attr('name', data.spvPhone);
					//$(row).find("td:eq(8)").append("woi woi");
				}
		}
		});
	
	table.on( 'click', 'input#sendSMSButton', function (e) {
	
		console.log(" index row : "+table.cell($(this).closest('td')).index().row);
		console.log(" index column data : "+table.cell($(this).closest('td')).index().column);
		
		var index = table.cell($(this).closest('td')).index().row;
		console.log("alarm data " + table.cell(index, 0).data());
		//console.log(" index : "+table.row(this).data("spvName"));
		
		/*console.log($(this).closest('tr').children("td:eq(8)").find("#sendSMSButton").attr('name'));
		console.log("it works!");
		
		$(this).closest('tr').children("td:eq(8)").find("#sendSMSButton").replaceWith('<img id="loadingImage" src="assets/images/waiting3.gif" width="50px" height="10px"/>');*/
		
		var alarmPower = table.cell(index, 0).data();
		var site = 	table.cell(index, 1).data();
		var type = table.cell(index, 2).data();
		var firstOccurrence = table.cell(index, 3).data();
		var currentDuration = table.cell(index, 4).data();
		var telephoneNumber = $(this).closest('tr').children("td:eq(8)").find("#sendSMSButton").attr('name');
		
		console.log("Alarm power " + alarmPower);
		console.log("Site " + site);
		console.log("type " + type);
		console.log("first occurrence " + firstOccurrence);
		console.log("current Duration " + currentDuration);
		
		
		//console.log("alarmPower "+alarmPower);
		var sendingResult = submitForm(alarmPower, site, type, firstOccurrence, currentDuration, telephoneNumber);
		
		if(sendingResult = 1){
			$(this).closest('tr').children("td:eq(8)").find("#loadingImage").replaceWith('<img id="successImage" src="assets/images/centang.png" weight="20" height="20"/>');
		}
		else{
			$(this).closest('tr').children("td:eq(8)").find("#loadingImage").replaceWith(sendSMSButton);
		}
		
	});
	
	function convertingMinutesToHours(minutes){
		 var hours = leftPad(Math.floor(Math.abs(minutes) / 60));  
		 var finalMinutes = leftPad(Math.abs(minutes) % 60);  
  
		return hours +'hrs '+ finalMinutes + 'min';  
	}
	
	function leftPad(number) {    
		return ((number < 10 && number >= 0) ? '0' : '') + number;  
	}
	
	var refreshTx = function(){ table.ajax.reload() };
	
	setInterval(refreshTx,90000);
	
});