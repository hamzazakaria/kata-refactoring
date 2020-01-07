<?php

namespace Evaneos\Entity;

class Quote
{
    public $id;
    public $siteId;
    public $destinationId;
    public $dateQuoted;

    /**
     * Quote constructor.
     *
     * @param $id
     * @param $siteId
     * @param $destinationId
     * @param $dateQuoted
     */
    public function __construct($id, $siteId, $destinationId, $dateQuoted)
    {
        $this->id = $id;
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
        $this->dateQuoted = $dateQuoted;
    }

    /**
     * @param \Evaneos\Entity\Quote $quote
     *
     * @return string
     */
    public static function renderHtml(Quote $quote)
    {
        return '<p>' . $quote->id . '</p>';
    }

    /**
     * @param \Evaneos\Entity\Quote $quote
     *
     * @return string
     */
    public static function renderText(Quote $quote)
    {
        return (string)$quote->id;
    }
}
