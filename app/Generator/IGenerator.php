<?php

declare(strict_types=1);

namespace App\Generator;

/**
 * Interface IGenerator
 *
 * @package App\Generator
 */
interface IGenerator
{
	/**
	 * Получаем записи
	 *
	 * @return array
	 */
	public function get(): array;

	/**
	 * Генерируем записи
	 *
	 * @param int $count
	 *
	 * @return void
	 */
	public function generate(int $count = 0): void;
}