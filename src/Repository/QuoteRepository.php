<?php

namespace Evaneos\Repository;

use Evaneos\Entity\Quote;
use Evaneos\Helper\SingletonTrait;
use Faker\Factory;

class QuoteRepository implements RepositoryInterface
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Quote
     */
    public function getById($id)
    {
        $generator = Factory::create();
        $generator->seed($id);

        return new Quote(
            $id,
            $generator->numberBetween(1, 10),
            $generator->numberBetween(1, 200),
            $generator->dateTime()
        );
    }
}
