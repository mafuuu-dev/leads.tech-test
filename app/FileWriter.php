<?php

namespace App;


/**
 * Class FileWriter
 *
 * @package App
 */
class FileWriter
{
	private const STORAGE_PATH = 'storage';

	/**
	 * @var string
	 */
	private $filePath;

	/**
	 * FileWriter constructor.
	 *
	 * @param string $fileName
	 */
	public function __construct( string $fileName )
	{
		$this->filePath = self::STORAGE_PATH . "/$fileName";

		$this->initializeFile();
	}

	/**
	 * Пишем в файл с блокировкой
	 *
	 * @param string $line
	 *
	 * @return $this
	 */
	public function write( string $line ): self
	{
		$file = fopen( $this->filePath, "r+" );

		while ( true ) {
			if ( flock( $file, LOCK_EX ) ) {
				fseek( $file, 0, SEEK_END );
				fwrite( $file, $line );
				flock( $file, LOCK_UN );

				break;
			}

			sleep( 1 );
		}

		fclose( $file );

		return $this;
	}

	/**
	 * Инициализируем файл
	 *
	 * @return $this
	 */
	private function initializeFile(): self
	{
		fclose( fopen( $this->filePath, "w" ) );

		return $this;
	}
}