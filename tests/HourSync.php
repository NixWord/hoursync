<?php

require 'src/HourSync.php';

class HourSyncTest extends PHPUnit_Framework_TestCase {

	const VALID_CALENDAR_URI = "http://localhost/calendar.ics";
	const INVALID_CALENDAR_URI = "invalid://invalid/calendar.ics";

	protected $hoursync;

	protected function setUp() {
		$this->hoursync = new HourSync();
	}

	public function testAddCalendarURI_Valid_URI() {
		$this->hoursync->addCalendarURI(self::VALID_CALENDAR_URI);

		$calendars = $this->hoursync->getCalendars();
		$this->assertEquals($calendars[0], self::VALID_CALENDAR_URI);
	}

	public function testAddCalendarURI_Invalid_URI() {
		$this->hoursync->addCalendarURI(self::INVALID_CALENDAR_URI);

		$calendars = $this->hoursync->getCalendars();
		$this->assertEquals(count($calendars), 0);
	}

	public static function tearDownAfterClass() {
	}
}
