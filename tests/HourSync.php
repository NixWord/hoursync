<?php

require 'src/HourSync.php';

class HourSyncTest extends PHPUnit_Framework_TestCase {

	const VALID_CALENDAR_URI = "http://localhost/calendar.ics";
	const INVALID_CALENDAR_URI = "invalid://invalid/calendar.ics";
	const UNREADABLE_CALENDAR_URI = "http://localhost/404/calendar.ics";

	protected $hoursync;

	protected function setUp() {
		$this->hoursync = new HourSync();
	}

	public function testAddCalendarURI_valid_URI() {
		$this->hoursync->addCalendarURI(self::VALID_CALENDAR_URI);

		$calendars = $this->hoursync->getCalendars();
		$this->assertEquals($calendars[0], self::VALID_CALENDAR_URI);
	}

	public function testAddCalendarURI_invalid_URI() {
		$this->hoursync->addCalendarURI(self::INVALID_CALENDAR_URI);

		$calendars = $this->hoursync->getCalendars();
		$this->assertEquals(count($calendars), 0);
	}

	public function testLoadCalendars_unreadable_calendar() {
		$this->hoursync->addCalendarURI(self::UNREADABLE_CALENDAR_URI);
		$this->assertFalse($this->hoursync->loadCalendars());
	}

	public function testLoadCalendars_without_cache() {
		$this->hoursync->addCalendarURI(self::VALID_CALENDAR_URI);
		$this->hoursync->loadCalendars(false);
	}

	public function testLoadCalendars_with_cache() {
		$this->hoursync->addCalendarURI(self::VALID_CALENDAR_URI);
		$this->hoursync->loadCalendars();

		$cache = 'src/cache/' . md5(self::VALID_CALENDAR_URI);

		$this->assertFileExists($cache);
	}

	public function testFindPlaceFor() {
		$this->hoursync->addCalendarURI(self::VALID_CALENDAR_URI);
		$this->hoursync->loadCalendars();

		$meeting = new Meeting();
		$meeting->setFrequency(Meeting::WEEKLY);
		$meeting->setDuration(2);

		$place = $this->hoursync->findPlaceFor($meeting);

		$this->assertNotEquals($place, false);
	}

}
