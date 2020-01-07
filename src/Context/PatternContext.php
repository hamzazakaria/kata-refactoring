<?php

namespace Evaneos\Context;

use Evaneos\Helper\SingletonTrait;
use Evaneos\Pattern\PatternInterface;

class PatternContext
{
    use SingletonTrait;

    /**
     * @var PatternInterface
     */
    private $pattern;

    private $text;

    private $data;


    /**
     * @param \Evaneos\Pattern\PatternInterface $pattern
     * @param null                              $data
     *
     * @return $this
     */
    public function setPattern(PatternInterface $pattern, $data = null)
    {
        if ($data !== null) {
            $this->data = $data;
        }

        $this->pattern = $pattern;

        return $this;
    }

    /**
     * @param null $text
     *
     * @return $this
     */
    public function replaceData($text = null)
    {
        $this->text = $this->pattern->replace(isset($text) ? $text : $this->text, $this->data);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

}
