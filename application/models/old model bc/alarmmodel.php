<?php

class alarmModel extends CI_Model{

	
	public function getActiveAlarm(){
		$queriesArray = array();
		$queriesArray["getActiveAlarm"][0]="TRUNCATE TABLE alarmRecap.tempForActiveAlarm";
		$queriesArray["getActiveAlarm"][1]="INSERT INTO alarmRecap.`tempForActiveAlarm`
											(alarmName, siteid, site, firstOccurrence, duration, zone)
											SELECT alarm.alarmname,
												alarm.siteId,
												   alarm.Site,
												   alarm.FirstOccurrence,
												   TIMESTAMPDIFF(MINUTE, LastOccurrence, NOW()),
												   alarm.zone
											FROM (
													SELECT alarmname,
													SiteId,
													Site,
													FirstOccurrence,
													LastOccurrence,
													zone
													FROM netcool.`activealarm`
													WHERE	
															summary LIKE '%power%' OR
															summary LIKE '%genset%' OR
															summary LIKE '%l123%' OR
															summary LIKE '%L1 Failure%' OR
															summary LIKE '%L2 Failure%' OR
															summary LIKE '%L3 Failure%' OR
															summary LIKE '%temp%'
												  )alarm";
		
		$queriesArray["getActiveAlarm"][2]="INSERT INTO alarmRecap.`tempForActiveAlarm`
											(alarmName, siteid, site, firstOccurrence, duration, zone)
											SELECT alarm.alarmname,
												   alarm.siteId,
												   alarm.Site,
												   alarm.FirstOccurrence,
												   TIMESTAMPDIFF(MINUTE, LastOccurrence, NOW()),
												   alarm.zone
											FROM (
													SELECT alarmname,
														   SiteId,
														   Site,
														   FirstOccurrence,
														   LastOccurrence,
														   zone
													FROM netcool.`hightemp_external_alarm`
													WHERE	summary LIKE '%power%' OR
															summary LIKE '%genset%' OR
															summary LIKE '%l123%' OR
															summary LIKE '%l1%' OR
															summary LIKE '%l2%' OR
															summary LIKE '%l3%' OR
															summary LIKE '%temp%'
												  )alarm";
												  
		/*$queriesArray["getActiveAlarm"][2] = "UPDATE alarmRecap.`tempForActiveAlarm` a,*/
		$queriesArray["getActiveAlarm"][3] = "UPDATE alarmRecap.`tempForActiveAlarm` a, pm.`CoreHutHub` b
													SET a.`category` = b.`site_category`,
														a.`spvName` = b.`spvName`,
														a.`spvPhone` = b.`spvPhone`
												WHERE a.`siteid` = b.`siteid`";
											  
		/*$queriesArray["getActiveAlarm"][4] = "DELETE FROM alarmRecap.`tempForActiveAlarm`*/
		$queriesArray["getActiveAlarm"][4] = "DELETE FROM alarmRecap.`tempForActiveAlarm`
											  WHERE category IS NULL";
		$queriesArray["getActiveAlarm"][5] = "DELETE FROM alarmRecap.`tempForActiveAlarm`
											  WHERE category ='OnAir'";
		$queriesArray["getActiveAlarm"][6] = "DELETE FROM alarmRecap.`tempForActiveAlarm`
											  WHERE category ='integration process'";
		$queriesArray["getActiveAlarm"][7] = "DELETE FROM alarmRecap.`tempForActiveAlarm`
											  WHERE category ='temporary dismantled'";
		$queriesArray["getActiveAlarm"][8] = "DELETE FROM alarmRecap.`tempForActiveAlarm`
											  WHERE category ='dismantled'";
											  
											  
		/*$queriesArray["getActiveAlarm"][4] = "DELETE FROM alarmRecap.`tempForActiveAlarm`
											  WHERE category IS NULL OR
											  category NOT LIKE '%HUB%' OR
											  category NOT LIKE '%HUT%' OR
											  category NOT LIKE '%CORE%'";*/
											  
		array_walk($queriesArray["getActiveAlarm"], array($this, 'doQuery'));
		
		$result = $this->db->query("SELECT alarmName as alarmname,
												   site,
												   category,
												   firstOccurrence as datetime,
												   duration,
												   zone,
												   spvName,
												   spvPhone FROM alarmRecap.`tempForActiveAlarm` ORDER BY duration DESC")->result();
		//$result = $this->db->query("SELECT * FROM alarmRecap.`tempForActiveAlarm`")->result();
		return $result;
	}
	
	public function doQuery($query){
		$resultQuery = $this->db->query($query);
		return $resultQuery;
		//return $resultQuery->result();
	}
	
	public function getAffectedRows(){
		return $this->db->affected_rows();
	}
}

?>