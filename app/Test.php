<?php
namespace App;

/**
 * Class Test
 *
 * @package App
 */
class Test
{
	/**
	 * Запуск
	 */
	public static function run()
	{
		$i = 0;
		while ( $i < 10 ) {
			echo "Hello World " . $i . "\n";

			sleep( 5 );
			$i++;
		}
	}
}