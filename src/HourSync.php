<?php

require_once 'CalendarLoader.php';

/**
 * Simple tool to find free time to set up a meeting
 * @package HourSync
 * @author NixWord
 *
 */
class HourSync {
	private $calendars = array();

	/**
	 * Add one calendar to load
	 * @param string $calendarURI
	 */
	public function addCalendarURI($calendarURI) {
		$this->calendars[] = $calendarURI;
	}

	/**
	 * Load calendars
	 * @param bool $useCache
	 * @return true on success
	 */
	public function loadCalendars($useCache = true) {
		$success = true;
		foreach($this->calendars as $calendar) {
			try {
				CalendarLoader::load($calendar);
			}
			catch(CalendarLoaderException $e) {
				$success = false;
			}
		}

		return $success;
	}

	/**
	 *
	 * @return array
	 */
	public function getCalendars() {
		return $this->calendars;
	}
}
