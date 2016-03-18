<?php

class alarmModel extends CI_Model{

	
	public function getActiveAlarm(){
		$queriesArray = array();
		$queriesArray["getActiveAlarm"][0]="TRUNCATE TABLE alarmRecap.tempForActiveAlarm";
		$queriesArray["getActiveAlarm"][1]="TRUNCATE TABLE alarmRecap.tempForActiveAlarm_mirror";
		$queriesArray["getActiveAlarm"][2]="INSERT INTO alarmRecap.`tempForActiveAlarm_mirror`
											(eventid, alarmName, summary, siteid, site, firstOccurrence, duration, zone, manager, `table`)
											SELECT alarm.eventid
												   alarm.alarmname,
												   alarm.summary,
												   alarm.siteId,
												   alarm.Site,
												   alarm.FirstOccurrence,
												   TIMESTAMPDIFF(MINUTE, LastOccurrence, NOW()),
												   alarm.zone,
												   alarm.manager,
												   'activealarm'
											FROM (
												    SELECT `Event ID` AS eventid, 
													alarmname,
													summary,
													SiteId,
													Site,
													FirstOccurrence,
													LastOccurrence,
													zone,
													manager
													FROM netcool.`activealarm`
													WHERE	
															summary RLIKE 'power|genset|L123 failure|l1 failure|l2 failure|l3 failure|temp'
												  )alarm";
		
		$queriesArray["getActiveAlarm"][3]="INSERT INTO alarmRecap.`tempForActiveAlarm_mirror`
											(eventid, alarmName, summary, siteid, site, firstOccurrence, duration, zone, manager, `table`)
											SELECT alarm.eventid
												   alarm.alarmname,
												   alarm.summary,
												   alarm.siteId,
												   alarm.Site,
												   alarm.FirstOccurrence,
												   TIMESTAMPDIFF(MINUTE, LastOccurrence, NOW()),
												   alarm.zone,
												   alarm.manager,
												   'hightemp'
											FROM (
													SELECT `Event ID` AS eventid,
														   alarmname,
														   summary,
														   SiteId,
														   Site,
														   FirstOccurrence,
														   LastOccurrence,
														   zone,
														   manager
													FROM netcool.`hightemp_external_alarm`
													WHERE	summary RLIKE 'power|genset|L123 failure|l1 failure|l2 failure|l3 failure|temp'
												  )alarm";
												  
		/*$queriesArray["getActiveAlarm"][2] = "UPDATE alarmRecap.`tempForActiveAlarm` a,*/
		$queriesArray["getActiveAlarm"][4] = "UPDATE alarmRecap.`tempForActiveAlarm_mirror` a, pm.`CoreHutHub` b
													SET a.`category` = b.`site_category`,
														a.`spvName` = b.`spvName`,
														a.`spvPhone` = b.`spvPhone`
												WHERE a.`siteid` = b.`siteid`";
											  
		/*$queriesArray["getActiveAlarm"][4] = "DELETE FROM alarmRecap.`tempForActiveAlarm`*/
		$queriesArray["getActiveAlarm"][5] = "DELETE FROM alarmRecap.`tempForActiveAlarm_mirror`
											  WHERE category IS NULL";
		$queriesArray["getActiveAlarm"][6] = "DELETE FROM alarmRecap.`tempForActiveAlarm_mirror`
											  WHERE category ='OnAir'";
		$queriesArray["getActiveAlarm"][7] = "DELETE FROM alarmRecap.`tempForActiveAlarm_mirror`
											  WHERE category ='integration process'";
		$queriesArray["getActiveAlarm"][8] = "DELETE FROM alarmRecap.`tempForActiveAlarm_mirror`
											  WHERE category ='temporary dismantled'";
		$queriesArray["getActiveAlarm"][9] = "DELETE FROM alarmRecap.`tempForActiveAlarm_mirror`
											  WHERE category ='dismantled'";
		$queriesArray["getActiveAlarm"][10] = "INSERT INTO alarmRecap.`tempForActiveAlarm`
											  (eventid, alarmName, summary, siteid, site, category, firstOccurrence, duration, zone, spvName, spvPhone, manager, `table`)
											  SELECT alarm.eventid.
													 alarm.alarmName,
													 alarm.summary,
													 alarm.siteid,
													 alarm.site,
													 alarm.category,
													 alarm.firstOccurrence,
													 alarm.duration,
													 alarm.zone,
													 alarm.spvName,
													 alarm.spvPhone,
													 alarm.manager,
													 alarm.table
											  FROM (
													SELECT eventid, alarmName, 
														   (CASE WHEN summary REGEXP '{'
															THEN MID(summary, LOCATE('{', summary)) ELSE summary END)
														    as summary, 
														   siteid, 
														   site, category, firstOccurrence, duration, zone, spvName, spvPhone, manager, `table`
													FROM alarmRecap.`tempForActiveAlarm_mirror`
													WHERE manager RLIKE 'ericsson') alarm";
													
		$queriesArray["getActiveAlarm"][11] =  "INSERT INTO alarmRecap.`tempForActiveAlarm`
											  (eventid, alarmName, summary, siteid, site, category, firstOccurrence, duration, zone, spvName, spvPhone, manager, `table`)
											  SELECT alarm.eventid,
													 alarm.alarmName,
													 alarm.alarmConcated,
													 alarm.siteid,
													 alarm.site,
													 alarm.category,
													 alarm.firstOccurrence,
													 alarm.duration,
													 alarm.zone,
													 alarm.spvName,
													 alarm.spvPhone,
													 alarm.manager,
													 alarm.table
											  FROM
												  (SELECT eventid, alarmName,
														  GROUP_CONCAT(DISTINCT alarmName) AS alarmConcated,
														  siteid,
														  site, category, firstOccurrence, duration, zone, spvName, spvPhone, manager, `table`
												   FROM alarmRecap.`tempForActiveAlarm_mirror`
												   WHERE manager REGEXP 'huawei+'
												   GROUP BY firstOccurrence
												   ORDER BY siteid ASC) alarm";
											  
											  
		/*$queriesArray["getActiveAlarm"][4] = "DELETE FROM alarmRecap.`tempForActiveAlarm`
											  WHERE category IS NULL OR
											  category NOT LIKE '%HUB%' OR
											  category NOT LIKE '%HUT%' OR
											  category NOT LIKE '%CORE%'";*/
											  
		array_walk($queriesArray["getActiveAlarm"], array($this, 'doQuery'));
		
		$result = $this->db->query("SELECT summary as alarmname,
												   site,
												   category,
												   firstOccurrence as datetime,
												   duration,
												   zone,
												   (CASE WHEN manager REGEXP 'huawei+'
													THEN 'huawei' ELSE 'ericsson' END) AS manager,
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