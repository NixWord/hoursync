<?php

class HourSync {
	private $calendars = array();

	public function addCalendarURI($calendarURI) {
		$this->calendars[] = $calendarURI;
	}

	public function getCalendars() {
		return $this->calendars;
	}
}
