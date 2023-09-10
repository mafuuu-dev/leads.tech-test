<?php

declare(strict_types=1);

namespace App\Handler;

use App\Writer\IWriter;
use App\Services\LogLine;

use LeadGenerator\Lead;
use parallel\{Runtime, Future};

/**
 * Class Handler
 *
 * @package App\Handler
 */
class RequestHandler
{
	private const PACKAGE_LIMIT = 2000;

	/**
	 * @var IWriter
	 */
	private $writer;

	/**
	 * @var Future[]
	 */
	private $futures = [];

	/**
	 * @var array|Lead[]
	 */
	private $requests = [];

	/**
	 * @var array
	 */
	private $exceptions = [];

	/**
	 * Handler constructor.
	 *
	 * @param IWriter $writer
	 */
	public function __construct(IWriter $writer)
	{
		$this->writer = $writer;
	}

	/**
	 * Запускаем обработчика заявок
	 *
	 * @return self
	 * @throws \Throwable
	 */
	public function run(): self
	{
		$this->handlingPackages();

		return $this;
	}

	/**
	 * Устанавливаем заявки
	 *
	 * @param array|Lead[] $requests
	 *
	 * @return self
	 */
	public function setRequests(array $requests = []): self
	{
		$this->requests = $requests;

		return $this;
	}

	/**
	 * Устанавливаем исключения
	 *
	 * @param array $exceptions
	 *
	 * @return $this
	 */
	public function setExceptions(array $exceptions = []): self
	{
		$this->exceptions = $exceptions;

		return $this;
	}

	/**
	 * Обрабатываем пакеты
	 *
	 * @return self
	 * @throws \Throwable
	 */
	private function handlingPackages(): self
	{
		$packages = array_chunk($this->requests, self::PACKAGE_LIMIT);

		foreach ($packages as $package) {
			$this
				->handlingPackage($package)
				->handlingEventLoop();
		}

		return $this;
	}

	/**
	 * Обрабатываем цикл событий
	 *
	 * @return $this
	 * @throws \Throwable
	 */
	private function handlingEventLoop(): self
	{
		do {
			foreach ($this->futures as $index => $future) {
				if ($future->done()) {
					$request = $future->value();

					if ($request) {
						$logLine = new LogLine($request['id'], $request['category']);
						$this->writer->write((string) $logLine);
					}

					unset($this->futures[$index]);
				}
			}

			sleep(1);
		} while(count($this->futures) > 0);

		return $this;
	}

	/**
	 * Обрабатываем пакеты заявок
	 *
	 * @param array $package
	 *
	 * @return self
	 */
	private function handlingPackage(array $package = []): self
	{
		foreach ($package as $request) {
			$runtime = new Runtime();

			$this->futures[] = $runtime->run(function (int $id, string $category, array $exceptions) {
				sleep(2);

				if (in_array( $category, $exceptions)) {
					return false;
				}

				return ['id' => $id, 'category' => $category];
			}, [$request->id, $request->categoryName, $this->exceptions]);
		}

		return $this;
	}
}