<?php

namespace Evaneos;

use Evaneos\Context\PatternContext;
use Evaneos\Entity\Template;
use Evaneos\Exception\TemplateException;
use Evaneos\Pattern\QuotePattern;
use Evaneos\Pattern\UserPattern;
use RuntimeException;


class TemplateManager
{
    /**
     * @param \Evaneos\Entity\Template $tpl
     * @param array                    $data
     *
     * @return \Evaneos\Entity\Template
     * @throws \Evaneos\Exception\TemplateException
     */
    public function getTemplateComputed(Template $tpl, array $data)
    {
        if (!$tpl) {
            throw new TemplateException('no tpl given');
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
