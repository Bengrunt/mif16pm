<?php 
/**
 * 
 * A basic class used to generate a calendar
 * 
 * Example : 
 *  
 * $cal = new SimpleCalendar(09, 2008, array('locale' => 'en'))
 * $cal->toDate('next month');
 * $cal->toNextYear();
 * $cal->toDate('previous year');
 * $cal->showCalendar(); // will output october 2009 calendar
 * 
 * PHP versions 4 and 5
 * 
 * 
 * @author			Cholot Christophe (christophe.cholot@gmail.com)
 * @package			calendar
 * @since			v 0.3
 * @lastmodified	$Date: 2008-02-03 13:33:52 +0100 (Sun, 03 Feb 2008) $
 *
 */
 
class SimpleCalendar {
	
	var $_month;
	var $_day;
	var $_year;
	var $_registeredMonth;
	var $_registeredYear;
		
	var $_activeLinks = false;
	var $_options = array(
		'locale' => 'FR_fr.UTF8',
		'fullDayName' => false,
		'fullMonthName' => true,
		'fullYearName' => true,

		'tableClassName' => 'calendar',
		'dayClassName' => 'day',
		'monthClassName' => 'month',
		'yearClassName' => 'year',
		'disabledClassName' => 'disabled',
		'weekEndClassName' => 'weekend',
		'todayClassName' => 'today',
		'activeLinkClassName' => 'link',
		
		'weekEndDays' => array(6, 7),
		'activeLinks' => false
	);

		
	function SimpleCalendar($month = null, $year = null, $options = array()){
	
		$this->_day = date('d');
		$this->_month = $this->_registeredMonth = null !== $month ? $month : date('m');
		$this->_year = $this->_registeredYear = null !== $year ? $year : date('Y');
		$this->_options = array_merge($this->_options, $options);
		setlocale(LC_TIME, $this->_options['locale']);
	}
	
	function _currentTimestamp(){
	
		return mktime(0, 0, 0, $this->_month, $this->_day, $this->_year);
	}
	
	 function _getDayNames(){
	 	
		for($day = 1; $day <= 7; ++$day)
			$days[$day] = strftime(!$this->_options['fullDayName'] ? '%a' : '%A', mktime(0, 0, 0, 0, 0 + $day, 1970));
		return $days; 
	}
	
	function toPreviousMonth(){
	
		if($this->_month == 1){
			$this->_month = 12;
			--$this->_year;
		}
		else 
			--$this->_month;
	}	
	
	function toNextMonth(){
	
		if($this->_month == 12){
			$this->_month = 1;
			++$this->_year;
		}
		else 
			++$this->_month;			
	}
	
	function toRegisteredMonth(){
	
		$this->_month = $this->_registeredMonth;
	}
	
	function toPreviousYear(){
	
		--$this->_year;
	}
	
	function toRegisteredYear(){
	
		$this->_year = $this->_registeredYear;
	}
	
	function toNextYear(){
	
		++$this->_year;
	}
	
	function toMonth($month){
	
		$this->_month = $month;
	}
	
	function toYear($year){
	
		$this->_year = $year;
	}
	
	function toDay($day){
	
		$this->_day = $day;
		
	}
	
	function resetDate(){
		$this->_day = date('d');
		$this->_month = $this->_registeredMonth;
		$this->_year = $this->_registeredYear;
	}
	
	function toDate($timestamp){
	
		extract(getdate(strtotime($timestamp)));
		$this->_month = $mon;
		$this->_year = $year;
		$this->_day = $mday < 10 ? '0' . $mday : $mday;
	}
		
	function getCalendar(){
	
		$calendar = array();
		$calendar['header'] = $this->_getDayNames();
		$calendar['body'] = $this->_getWeeks();
		return $calendar;
	}
			
	function showCalendar(){
	
		$dayNames = $this->_getDayNames();
		$weeks = $this->_getWeeks();
		
		echo '<table class="' . $this->_options['tableClassName'] . '">' . "\n";
		echo "\t" . '<caption>' . $this->_day . ' ' . ucfirst(strftime($this->_options['fullMonthName'] ? '%B' : '%b', $this->_currentTimestamp())) .' '. strftime($this->_options['fullYearName'] ? '%Y' : '%y', $this->_currentTimestamp()) . '</caption>' . "\n";
		echo "\t" . '<thead>' . "\n";
		echo "\t\t" . '<tr>';
		foreach($dayNames as $dayName)
			echo "\n\t\t\t" . '<th>' . $dayName . '</th>' . "\n";
		echo "\t\t" . '</tr>' . "\n";
		echo "\t" . '</thead>' . "\n";
		echo "\t" . '<tbody>' . "\n";
		for($week = 1; $week <= sizeof($weeks) ; ++$week){
			echo "\t\t" . '<tr>' . "\n";
		 	for($weekDay = 1; $weekDay <= 7; ++$weekDay){		
		 		$className = $this->_options['disabledClassName'];
		 		if(isset($weeks[$week][$weekDay])){
			 		$className = $this->_options['dayClassName'];
			 		if($day['dayNumber'] == date('d') && $this->_month == date('m') && $this->_year == date('Y'))
			 			$className .= ' ' . $this->_options['todayClassName'];
			 		if(in_array($weekDay, $this->_options['weekEndDays']))
			 			$className .= ' ' . $this->_options['weekEndClassName'];
		 		}
				echo "\t\t\t" . '<td id="d_' . $week . '-'. $weekDay . '" class="' . $className . '">';
				
				if($day = isset($weeks[$week][$weekDay]) ? $weeks[$week][$weekDay] : false){ 
					$markupStart = $markupEnd = null;					
					if($this->_options['activeLinks'] && is_array($this->_options['activeLinks']['links'])){
						$dayStartTimestamp = $this->_getStartOfDay($this->_month, $day['dayNumber'], $this->_year);
						$dayEndTimestamp = $this->_getEndOfDay($this->_month, $day['dayNumber'], $this->_year);
						foreach($this->_options['activeLinks']['links'] as $link){
							if($this->_isBetween(strtotime($link['date']), $day['timestamp'], $dayEndTimestamp)){
								$markupStart = '<a href="' . $this->_options['activeLinks']['path'] . urlencode($link['href']) . '" title="' . $link['title'] . '" class="' . $this->_options['activeLinkClassName'] . '">';
								$markupEnd = '</a>';
							}
						}
					}
					echo $markupStart . $day['dayNumber'] . $markupEnd;
				}
				echo '</td>'. "\n";
			}
			echo "\t\t" . '</tr>' . "\n";
		}
		echo "\t" . '</tbody>' . "\n";		
		echo '</table>' . "\n";
	}
	
	function _getWeeks(){
	
		$weeks = array();
		$weekCount = 1;		
		$dayCount = date('t', $this->_currentTimestamp());
		for($day = 1; $day <= $dayCount; ++$day){
			
			$tstamp = mktime(0, 0, 0, $this->_month, $day, $this->_year);
						
			$dayNumber = date('j', $tstamp);
			$dayName = strftime('%a', $tstamp);
			$dayNameLong = strftime('%A', $tstamp);			
			$weekDay = strftime('%u', $tstamp);
			$yearDay = strftime('%j', $tstamp);
			$yearWeek = strftime('%U', $tstamp);			

			$weekCount =  $weekDay % 7 == 1 ? ++$weekCount : $weekCount;

			$weeks[$weekCount][$weekDay] = array(
				'dayNumber' => $dayNumber, 
				'dayName' => $dayName, 
				'dayNameLong' => $dayNameLong,
				'weekDay' => $weekDay, 
				'yearDay' => $yearDay,	
				'yearWeek' => $yearWeek,		
				'timestamp' => $tstamp	
			);		
		}
		return $weeks;
	}
	
	function _getMonthDayCount(){
		return date('t', mktime(0, 0, 0, 
					$this->_month,
					$this->_day,
					$this->_year
		));
	}

	function _getStartOfDay($month, $day, $year){
		return mktime(0, 0, 0, $month, $day, $year);
	}
	
	function _getEndOfDay($month, $day, $year){
		return mktime(23, 59, 59, $month, $day, $year);		
	}
	
	function _isBetween($time, $start, $end){
		return $time >= $start && $time < $end;
	}

}
?>
