<?php

namespace App;


/**
 * Class ExecutionTime
 *
 * @package App
 */
class ExecutionTime
{
	/**
	 * @var int
	 */
	private $end = 0;

	/**
	 * @var int
	 */
	private $start = 0;

	/**
	 * Устанавливаем время запуска
	 *
	 * @return $this
	 */
	public function start(): self
	{
		$this->start = time();

		return $this;
	}

	/**
	 * Устанавливаем время завершения
	 *
	 * @return $this
	 */
	public function end(): self
	{
		$this->end = time();

		return $this;
	}

	/**
	 * Получаем результат выполнения
	 *
	 * @return float
	 */
	public function get(): float
	{
		return round( $this->end - $this->start, 3 );
	}

	/**
	 * Получаем результат в виде строки
	 *
	 * @return string
	 */
	public function __toString()
	{
		return "Execution time: " .  $this->get() . " sec.";
	}
}