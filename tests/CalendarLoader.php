<?php

require_once 'src/CalendarLoader.php';

class CalendarLoaderTest extends PHPUnit_Framework_TestCase {
	const VALID_CALENDAR_URI = "http://localhost/calendar.ics";

	public function testLoad() {
		$calendar = self::VALID_CALENDAR_URI;

		CalendarLoader::load($calendar);

		$this->assertFileExists('src/cache/' . md5($calendar));
	}
}