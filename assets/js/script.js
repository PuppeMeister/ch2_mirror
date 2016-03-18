$(document).ready(function(){
	
	console.log("script is loaded");
	
	/* Basket Notification*/
	notification();
	
	
	/* This code is executed after the DOM has been completely loaded */

	/* Changing thedefault easing effect - will affect the slideUp/slideDown methods: */
	$.easing.def = "easeOutBounce";

	/* Binding a click event handler to the links: */
	$('li.button a').click(function(e){
	
		/* Finding the drop down list that corresponds to the current section: */
		var dropDown = $(this).parent().next();
		
		/* Closing all other drop down sections, except the current one */
		$('.dropdown').not(dropDown).slideUp('slow');
		dropDown.slideToggle('slow');
		
		/* Preventing the default event (which would be to navigate the browser to the link's address) */
		e.preventDefault();
	})
	
	/* Customized by Me!!!!!!!!!!*/
	/* Extraction Button */
		$("#submitButton").click(function(){
		
		$.post($("#fastExtraction").attr("action"),
				   $("#fastExtraction :input").serializeArray(),
				   function(){
					console.log("terkirim");
					showFullMessage();
		});
	});
	
	
	$("#emptyBaskets").click(function(){
		$.ajax({url: 'index.php/index/getBasketsTruncated', success: function(data){
				//console.log(data);
				showEmptyMessage();
		}});
	});
	
	$("#refreshButton").click(function(){
		refreshTable();
	});
	
	function notification(){
		console.log("Initial notification for baskets is running");
		
		$.ajax({url: 'index.php/index/getNotification', success: function(data){
				if(data > 0){
					showFullMessage();
					}
				else{
					showEmptyMessage();
		}}});
	}
	
	function showFullMessage(){
		$("#basketsFull").show();
		$("#fullMessage").show();
		$("#basketsEmpty").hide();
		$("#emptyMessage").hide();
		
	}
	
	function showEmptyMessage(){
		$("#basketsEmpty").show();
		$("#emptyMessage").show();
		$("#basketsFull").hide();
		$("#fullMessage").hide();
	}

});