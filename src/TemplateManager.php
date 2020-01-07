<?php

namespace Evaneos;

use Evaneos\Context\PatternContext;
use Evaneos\Entity\Template;
use Evaneos\Pattern\QuotePattern;
use Evaneos\Pattern\UserPattern;
use RuntimeException;

/**
 * Class TemplateManager
 *
 * @package Evaneos
 */
class TemplateManager
{
    public function getTemplateComputed(Template $tpl, array $data)
    {
        if (!$tpl) {
            throw new RuntimeException('no tpl given');
        }

        $replaced = clone($tpl);
        $replaced->subject = $this->computeText($replaced->subject, $data);
        $replaced->content = $this->computeText($replaced->content, $data);

        return $replaced;
    }


    /**
     * @param       $text
     * @param array $data
     *
     * @return mixed
     */
    private function computeText($text, array $data)
    {
        $patternContext = PatternContext::getInstance();

        return $patternContext->setPattern(new QuotePattern(), $data)
                              ->replaceData($text)
                              ->setPattern(new UserPattern())
                              ->replaceData()
                              ->getText()
            ;
    }
}
