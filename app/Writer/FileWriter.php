<?php

declare(strict_types=1);

namespace App\Writer;

/**
 * Class FileWriter
 *
 * @package App\Writer
 */
class FileWriter implements IWriter
{
	private const STORAGE_PATH = 'storage';

	/**
	 * @var string
	 */
	private $filePath;

	/**
	 * @inheritDoc
	 */
	public function write(string $line): void
	{
		$file = fopen($this->filePath, "r+");

		while (true) {
			if (flock($file, LOCK_EX)) {
				fseek($file, 0, SEEK_END);
				fwrite($file, $line);
				flock($file, LOCK_UN);

				break;
			}

			sleep(1);
		}

		fclose($file);
	}

	/**
	 * Инициализируем файл
	 *
	 * @param string $fileName
	 *
	 * @return $this
	 */
	public function initialize(string $fileName): self
	{
		$this->filePath = self::STORAGE_PATH . "/$fileName";

		fclose(fopen($this->filePath, "w"));

		return $this;
	}
}