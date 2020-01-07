<?php

namespace Evaneos\Context;

use Evaneos\Entity\Site;
use Evaneos\Entity\User;
use Evaneos\Helper\SingletonTrait;
use Faker\Factory;

class ApplicationContext
{
    use SingletonTrait;

    /**
     * @var \Evaneos\Entity\Site
     */
    private $currentSite;
    /**
     * @var User
     */
    private $currentUser;

    protected function __construct()
    {
        $faker = Factory::create();
        $this->currentSite = new Site($faker->randomNumber(), $faker->url);
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
    }

    public function getCurrentSite()
    {
        return $this->currentSite;
    }

    public function getCurrentUser()
    {
        return $this->currentUser;
    }
}
