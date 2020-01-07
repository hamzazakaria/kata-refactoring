<?php

namespace Evaneos\Repository;

use Evaneos\Entity\Site;
use Evaneos\Helper\SingletonTrait;
use Faker\Factory;

class SiteRepository implements Repository
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Site
     */
    public function getById($id)
    {
        // DO NOT MODIFY THIS METHOD
        $faker = Factory::create();
        $faker->seed($id);
        return new Site($id, $faker->url);
    }
}
