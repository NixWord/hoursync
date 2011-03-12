<?php

require_once 'src/Meeting.php';

class MeetingTest extends PHPUnit_Framework_TestCase {
	public function testFrequency_set_get() {
		$meeting = new Meeting();
		$frequency = Meeting::WEEKLY;
		$meeting->setFrequency($frequency);
		$this->assertEquals($frequency, $meeting->getFrequency());
	}

	public function testDuration_set_get() {
		$meeting = new Meeting();
		$duration = 3;
		$meeting->setDuration($duration);
		$this->assertEquals($duration, $meeting->getDuration());
	}
}