<?php

require_once 'CalendarLoaderException.php';

class CalendarLoader {
	/**
	 * Load a calendar URI
	 * @param string $calendarURI
	 * @throws CalendarLoaderException on invalid URI
	 */
	public static function load($calendarURI) {
		$ical = @file_get_contents($calendarURI);

		if($ical === false) {
			throw new CalendarLoaderException();
		}

		$hash = md5($calendarURI);
		$cache = dirname(__FILE__) . '/cache/' . $hash;
		file_put_contents($cache, $ical);
		touch($cache);
	}
}