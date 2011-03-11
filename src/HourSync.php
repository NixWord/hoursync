<?php

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
	 * @throws CalendarLoaderException
	 */
	public function loadCalendars($useCache = true) {
		foreach($this->calendars as $calendar) {
			$ical = file_get_contents($calendar);

			if($ical == false) {
				throw new CalendarLoaderException();
			}

			$hash = md5($calendar);
			$cache = './cache/' . $hash;
			file_put_contents($cache, $ical);
			touch($cache);
		}

		return true;
	}

	/**
	 *
	 * @return array
	 */
	public function getCalendars() {
		return $this->calendars;
	}
}
