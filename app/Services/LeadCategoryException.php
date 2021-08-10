<?php

namespace App\Services;


/**
 * Class LeadCategoryException
 *
 * @package App\Services
 */
final class LeadCategoryException
{
	private const LEAD_CATEGORIES = [
		'Buy auto',
		'Buy house',
		'Get loan',
		'Cleaning',
		'Learning',
		'Car wash',
		'Repair smth',
		'Barbershop',
		'Pizza',
		'Car insurance',
		'Life insurance'
	];

	/**
	 * Получаем рандомные категории для исключений
	 *
	 * @param int $count
	 *
	 * @return array
	 */
	public static function make( int $count = 0 ): array
	{
		$randomIndexes = $count ? array_rand( self::LEAD_CATEGORIES, $count ) : [];

		$randomCategories = [];
		foreach ( $randomIndexes as $index ) {
			$randomCategories[] = self::LEAD_CATEGORIES[ $index ];
		}

		return $randomCategories;
	}
}