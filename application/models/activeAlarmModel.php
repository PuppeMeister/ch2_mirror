<?php

class activeAlarmModel extends CI_Model{

	
	public function getActiveAlarm(){
		$queriesArray = array();
		$queriesArray["activeAlarm"] = "
			SELECT alarm.alarmname AS alarmname,
					alarm.Site AS site,
					core.site_category AS category,
					alarm.FirstOccurrence AS datetime,
					TIMESTAMPDIFF(MINUTE, LastOccurrence, NOW()) AS duration,
					alarm.zone AS zone,
					core.spvName AS spvname,
					core.spvPhone AS spvphone
			FROM (SELECT alarmname, SiteId,Site, FirstOccurrence, LastOccurrence, FirstReceived, LastReceived, zone, summary
						FROM netcool.activealarm
						WHERE summary RLIKE 'power|genset|L123|l1|l2|l3|temp') AS alarm
			INNER JOIN (SELECT siteId, site_category, spvName, spvPhone FROM pm.CoreHutHub) AS core ON alarm.SiteId = core.siteId
			ORDER BY duration DESC";
			
		$queriesArray["highTemp"]= "
			SELECT alarm.alarmname, alarm.Site,
				   core.site_category, alarm.FirstOccurrence AS 'date time',
		           TIMESTAMPDIFF(MINUTE, LastOccurrence, NOW()) AS duration,
				   alarm.zone
			FROM (SELECT alarmname, SiteId,Site, FirstOccurrence, LastOccurrence, FirstReceived, LastReceived, zone, summary
					FROM netcool.hightemp_external_alarm
					WHERE WHERE summary RLIKE 'power|genset|L123|l1|l2|l3|temp') AS alarm
					INNER JOIN (SELECT siteId, site_category FROM pm.CoreHutHub) AS core
					ON alarm.SiteId = core.siteId; ";
			
		//array_walk($queriesArray[$act], array($this, 'doQuery'));
		
		$result1 = $this->db->query( $queriesArray["activeAlarm"])->result();
		$result2 = $this->db->query( $queriesArray["highTemp"])->result();
		$finalResult = array_merge($result1, $result2);
		return $finalResult;
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