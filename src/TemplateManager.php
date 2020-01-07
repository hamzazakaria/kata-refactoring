<?php

namespace Evaneos;

use Evaneos\Context\ApplicationContext;
use Evaneos\Entity\Quote;
use Evaneos\Entity\Template;
use Evaneos\Entity\User;
use Evaneos\Repository\DestinationRepository;
use Evaneos\Repository\QuoteRepository;
use Evaneos\Repository\SiteRepository;

class TemplateManager
{
    public function getTemplateComputed(Template $tpl, array $data)
    {
        if (!$tpl) {
            throw new \RuntimeException('no tpl given');
        }

        $replaced = clone($tpl);
        $replaced->subject = $this->computeText($replaced->subject, $data);
        $replaced->content = $this->computeText($replaced->content, $data);

        return $replaced;
    }

    private function computeText($text, array $data)
    {
        $APPLICATION_CONTEXT = ApplicationContext::getInstance();

        $quote = (isset($data['quote']) && $data['quote'] instanceof Quote) ? $data['quote'] : null;

        if ($quote)
        {
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

        $_user  = (isset($data['user'])  && ($data['user']  instanceof User))  ? $data['user'] : $APPLICATION_CONTEXT->getCurrentUser();

        if($_user) {
            if(strpos($text, '[user:first_name]') !== false)
            {
                $text = str_replace('[user:first_name]', ucfirst(mb_strtolower($_user->firstname)), $text);
            }
        }

        return $text;
    }
}
