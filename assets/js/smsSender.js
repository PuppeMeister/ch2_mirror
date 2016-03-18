function validateForm() 
      {
         var msg = "You must enter recipient number, separated by semicolon ";"\n";
         var valid = true;

         if (document.myform.rcpt.value.length < 3) {
            //msg = "You must enter recipient number, separated by semicolon ";"\n";
            valid = false;
         } else {   
            valid =  IsNumeric(document.myform.rcpt.value);
         }
         
         if (valid) {
            submitForm();
            return true;
         } else {
            alert(msg + "\n\t\n");
            return false;
         }      
      }
      
      function pause(ms) 
      {
         var now = new Date();
         var exitTime = now.getTime() + ms;
         while (true) {
            now = new Date();
            if (now.getTime() > exitTime)
                return;
        }
      }

      // input number validation
      function IsNumeric(input)
      {
         // use semicolon as separator
         var ValidChars = "0123456789;";
         var IsNumber = true;
         var Char;

       
         for (i = 0; i < input.length && IsNumber == true; i++) { 
            Char = input.charAt(i); 
            if (ValidChars.indexOf(Char) == -1) {
               IsNumber = false;
            }
         }
         return IsNumber;
      }
      
	  function submitForm(alarmPower, site, type, firstOccurrence, currentDuration, telephoneNumber)
      { 
         var req = null;
         // get msg from user
         var node = "?node=RFM"; 
		 var site = "&site=_";
         //var occur = "&occur=1435334700";
         var occur = "&occur=" + Number.parseInt(new Date().getTime()/1000);
         // replace "&" char as java URLEncoder has bug
         //var summary = "ALARM SLOGAN: 1034L2_KJERUK3 {OML FAULT: , MO=RXOCF-109}";
		 
         /*var summary = "Dear FOP, please follow up Alarm power: "+alarmPower+" Site:"+site+"Type (HUT):"+type +
						"First Occurrence :"+firstOccurrence+"Current Duration :"+currentDuration+"Potential Impact Services";*/
		
		/*var summary = "Dear FOP, please follow up Alarm power: "+alarmPower+" Site:"+site+
					  "First Occurrence :"+firstOccurrence+"Current Duration :"+currentDuration;*/
					  
		var summary = "Ngetest ";	
		
         summary = summary.replace('&', 'and');
         summary = "&summary=" + encodeURI(summary);
         
         //var rcpt = "087786502897";
		// var rcpt = "0819621114";
		 //var rcpt = telephoneNumber;
		 //var rcpt = "083871882725";
		 var rcpt = "0818586821";
		 var url = "http://10.22.254.116:8260/webtop-tools/sendsms2.jsp" + node + site + occur + summary + "&rcpt=" + rcpt;
        
         if (window.XMLHttpRequest) {
            req = new XMLHttpRequest();
         } else if (window.ActiveXObject) {
            try {
               req = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
               try {
                  req = new ActiveXObject("Microsoft.XMLHTTP");
               } catch (e) {}
            }
         }

         req.onreadystatechange = function()
         { 
            
            if(req.readyState == 4) {
               //give some delay before showing the result
               //pause(1000);
               
               if(req.status == 200) {
				  console.log("pesan terkirim");
				  return 1;
				  
               } else {
                  console.log("pesan tidak terkirim");
				  return 0;
               }
            }
         }; 
         req.open("GET", url, true);
         req.send(null);
      }
	  
      