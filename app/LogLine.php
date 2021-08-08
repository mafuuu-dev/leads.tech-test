<?php

namespace App;

use LeadGenerator\Lead;


/**
 * Class LogLine
 *
 * @package App
 */
class LogLine
{
	/**
	 * @var int
	 */
	private $leadId;

	/**
	 * @var string
	 */
	private $leadCategory;

	/**
	 * @var int
	 */
	private $currentTime;

	/**
	 * LogLine constructor.
	 *
	 * @param Lead $lead
	 */
	public function __construct( Lead $lead )
	{
		$this->leadId = $lead->id;
		$this->leadCategory = $lead->categoryName;

		$this->currentTime = time();
	}

	/**
	 * Получаем строку лога
	 *
	 * @return string
	 */
	public function __toString(): string
	{
		return "$this->leadId|$this->leadCategory|$this->currentTime\n";
	}
}