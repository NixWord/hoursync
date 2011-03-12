<?php

class Meeting {
	const WEEKLY  = 0;
	const MONTHLY = 1;

	private $duration;
	private $frequency;
	private $days;

	public function setFrequency($frequency) {
		$this->frequency = $frequency;
	}

	public function setDuration($duration) {
		$this->duration = $duration;
	}

	public function getFrequency() {
		return $this->frequency;
	}

	public function getDuration() {
		return  $this->duration;
	}
}