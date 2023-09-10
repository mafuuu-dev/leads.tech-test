<?php

declare(strict_types=1);

namespace App;

use App\Writer\FileWriter;
use App\Handler\RequestHandler;
use App\Services\ExecutionTime;
use App\Generator\LeadGenerator;
use App\Services\LeadCategoryException;

/**
 * Class Application
 *
 * @package App
 */
class Application
{
	private const NUMBER_OF_LEADS = 10000;
	private const NUMBER_OF_EXCEPTIONS = 2;
	private const LOG_FILENAME = 'log.txt';

	/**
	 * @var FileWriter
	 */
	private $fileWriter;

	/**
	 * @var ExecutionTime
	 */
	private $executionTime;

	/**
	 * @var LeadGenerator
	 */
	private $leadGenerator;

	/**
	 * @var array
	 */
	private $exceptions = [];

	/**
	 * Application constructor.
	 */
	public function __construct()
	{
		$this->fileWriter = new FileWriter();
		$this->executionTime = new ExecutionTime();
		$this->leadGenerator = new LeadGenerator();
	}

	/**
	 * Запускаем выполнение
	 *
	 * @return $this
	 * @throws \Throwable
	 */
	public function start(): self
	{
		$this->executionTime->start();

		$this->fileWriter->initialize(self::LOG_FILENAME);
		$this->leadGenerator->generate(self::NUMBER_OF_LEADS);

		$requests = $this->leadGenerator->get();
		$this->exceptions = LeadCategoryException::make(self::NUMBER_OF_EXCEPTIONS);

		$requestHandler = new RequestHandler($this->fileWriter);
		$requestHandler
			->setRequests($requests)
			->setExceptions($this->exceptions)
			->run();

		$this->executionTime->end();

		return $this;
	}

	/**
	 * Получаем результат выполнения в виде строки
	 *
	 * @return string
	 */
	public function __toString(): string
	{
		$exceptions = "Category exceptions: " . implode(', ', $this->exceptions);

		return $exceptions . "\n" . $this->executionTime;
	}
}