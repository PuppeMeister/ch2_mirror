<div class="resp-tabs-container">
							<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
							<div class="booking-info">
									<h2>Please Enter the dates </h2>
							</div>
									<div class="facts">
										<div class="booking-form">
											<!---strat-date-piker---->
											<script>
												$(function() {
													$( "#datepicker,#datepicker1" ).datepicker();
												});
											</script>
											<!---/End-date-piker---->
											<!-- Set here the key for your domain in order to hide the watermark on the web server -->
											
											<div class="online_reservation">
													<div class="b_room">
														<div class="booking_room">
															<div class="reservation">
																<!-- <ul>
																	<li><h5>Please <a id="refreshButton">refresh</a> first</h5></li>
																</ul> -->
																<!-- <ul>
																	<li>
																		<h5>Baskets are
																		<span id="basketsFull" class="notification hideElements">Full</span>
																		<span id="basketsEmpty" class="notification hideElements">Empty</span>
																		<span id="fullMessage" class="hideElements">Please <a id="emptyBaskets" class="buttonDariA">empty</a> baskets before doing the extraction</span>
																		<span id="emptyMessage" class="hideElements">Ready to extract</span></h5>
																	</li>
																</ul> -->
																<div class="clearfix"></div>
															</div>
															<form name ="fastExtraction" id="fastExtraction" method="POST">
															<div class="reservation">
																<ul>
																	<li class="span1_of_1">
																		<h5>Area</h5>
																		<div class="book_date">
																			 <select id="areaList" name="areaList">
																				<option selected> --- Choose the Area --- </option>
																				<option value="log_alarm_jabo1">Jabo 1</option>
																				<option value="log_alarm_jabo2">Jabo 2</option>
																				<option value="log_alarm_west1">West 1</option>
																				<option value="log_alarm_west2">West 2</option>
																				<option value="log_alarm_central">Central</option>
																				<option value="log_alarm_north">North</option>
																				<option value="log_alarm_east">East</option>
																			</select> 
																		</div>
																	</li>
																	 <li  class="span1_of_1">
																		 <h5>From</h5>
																		 <div class="book_date">
																		 
																			<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
																			<input type="date" value="Select date"
																			id="datepicker" name="datepicker" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Select date';}">
																		 
																		 </div>		
																	 </li>
																	 <li  class="span1_of_1 left">
																		 <h5>Until</h5>
																		 <div class="book_date">
																			 <form>
																				<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
																				<input type="date" value="Select date" 
																				id="datepicker1" name="datepicker1" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Select date';}">
																			</form>
																		 </div>					
																	 </li>
																	 <div class="clearfix"></div>
																</ul>
															</div>
															<!-- Filter Place -->
															<div class="reservation"> 
																<h5>Recent Filter</h5>
																<!-- Recent Filter Display -->
																	<table class="table table-striped display backtable" id="filterTable" width="50%">
																			<thead>
																				<tr>
																					<th>Alias</th>
																					<th>Filter</th>
																					<th>Action</th>
																				</tr>
																			</thead>
																			<tbody>
																			</tbody>
																		</table>
																		
																	<div class="reservation">
																		<input type="text" id="filterInput" name="filterInput"/>
																		<!-- Input button for adding new filter-->
																		<div class="date_btn">
																					 <input type="submit" value="Submit" id="addFilterButton"/>
																		</div>	
																	</div>	
															</div>
															
															
															<!-- !!!!!!!!Div of Submit Button!!!!!!!!!! -->
															<div class="reservation">
																<ul id="ulRecapSubmitButton">	
																	 <li class="span1_of_3">
																			<div class="date_btn">
																					 <input type="submit" value="Submit" id="recapSubmitButton"/>
																			</div>
																	 </li>
																	 <div class="clearfix"></div>
																</ul>
															</div>
															
															<div class="reservation">
															<div class="reservation backtable" id="divRecapAlarmTable">
															</div>
															
															<div class="clearfix"></div>
															<div class="reservation backtable" id="divDetailRecap">
															<!-- !!!!!!!!!!!End div of Submit Button!!!!!!!!!!! -->
															</form>
														</div>
														<div class="clearfix"></div>
													</div>
											</div>
											<!---->
										</div>	
									</div>
							</div> 			        					            	      
						  </div>