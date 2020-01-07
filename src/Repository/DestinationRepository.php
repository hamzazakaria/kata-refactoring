<?php

namespace Evaneos\Repository;

use Evaneos\Entity\Destination;
use Evaneos\Helper\SingletonTrait;
use Faker\Factory;

class DestinationRepository implements RepositoryInterface
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Destination
     */
    public function getById($id)
    {
        // DO NOT MODIFY THIS METHOD

        $faker = Factory::create();
        $faker->seed($id);

        return new Destination(
            $id,
            $faker->country,
            'en',
            $faker->slug()
        );
    }
}
