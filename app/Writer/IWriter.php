<?php

namespace App\Writer;


/**
 * Interface IWriter
 *
 * @package App\Writer
 */
interface IWriter
{
	/**
	 * Записываем строку
	 *
	 * @param string $line
	 *
	 * @return void
	 */
	public function write( string $line ): void;
}