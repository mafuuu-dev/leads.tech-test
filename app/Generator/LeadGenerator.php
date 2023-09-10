<?php

declare(strict_types=1);

namespace App\Generator;

use LeadGenerator\{Generator, Lead};

/**
 * Class LeadGenerator
 *
 * @package App\Generator
 */
class LeadGenerator implements IGenerator
{
	/**
	 * @var array
	 */
	private $leads = [];

	/**
	 * @inheritDoc
	 */
	public function get(): array
	{
		return $this->leads;
	}

	/**
	 * @inheritDoc
	 */
	public function generate(int $count = 0): void
	{
		$generator = new Generator();

		$generator->generateLeads($count, function (Lead $lead) {
			$this->leads[] = $lead;
		});
	}
}