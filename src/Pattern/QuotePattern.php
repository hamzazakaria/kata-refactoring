<?php

namespace Evaneos\Pattern;

use Evaneos\Entity\Quote;
use Evaneos\Repository\DestinationRepository;
use Evaneos\Repository\QuoteRepository;
use Evaneos\Repository\SiteRepository;

class QuotePattern implements PatternInterface
{
    const QUOTE = 'quote';

    /**
     * @param       $text
     * @param array $data
     *
     * @return string|string[]
     */
    public function replace($text, array $data)
    {

        if (isset($data[self::QUOTE]) && $data[self::QUOTE] instanceof Quote) {
            $quote = $data[self::QUOTE];

            $site = SiteRepository::getInstance()->getById($quote->siteId);
            $destination = DestinationRepository::getInstance()->getById($quote->destinationId);
            $quote = QuoteRepository::getInstance()->getById($quote->id);


            if (strpos($text, '[quote:destination_link]') !== false) {
                $url = '';
                if ($destination) {
                    $url = $site->url . '/' . $destination->countryName . '/quote/' . $quote->id;
                }
                $text = str_replace('[quote:destination_link]', $url, $text);
            }

            if (strpos($text, '[quote:summary_html]') !== false) {
                $text = str_replace(
                    '[quote:summary_html]',
                    Quote::renderHtml($quote),
                    $text
                );
            }

            if (strpos($text, '[quote:summary]') !== false) {
                $text = str_replace(
                    '[quote:summary]',
                    Quote::renderText($quote),
                    $text
                );
            }

            if (strpos($text, '[quote:destination_name]') !== false) {
                $text = str_replace('[quote:destination_name]', $destination->countryName, $text);
            }
        }

        return $text;
    }
}
