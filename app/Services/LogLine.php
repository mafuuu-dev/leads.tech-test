<?php

namespace App\Services;


/**
 * Class LogLine
 *
 * @package App\Services
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
	 * @param int $id
	 * @param string $category
	 */
	public function __construct( int $id, string $category )
	{
		$this->leadId = $id;
		$this->leadCategory = $category;

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