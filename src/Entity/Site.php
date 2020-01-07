<?php

namespace Evaneos\Entity;


class Site
{
    public $id;
    public $url;

    /**
     * Site constructor.
     *
     * @param $id
     * @param $url
     */
    public function __construct($id, $url)
    {
        $this->id = $id;
        $this->url = $url;
    }
}
