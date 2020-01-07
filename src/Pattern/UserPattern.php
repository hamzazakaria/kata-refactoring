<?php

namespace Evaneos\Pattern;

use Evaneos\Context\ApplicationContext;
use Evaneos\Entity\User;

class UserPattern implements PatternInterface
{
    const USER = 'user';

    /**
     * @param       $text
     * @param array $data
     *
     * @return string|string[]
     */
    public function replace($text, array $data)
    {
        $APPLICATION_CONTEXT = ApplicationContext::getInstance();

        $user = (isset($data[static::USER]) && ($data[static::USER] instanceof User)) ? $data[static::USER] : $APPLICATION_CONTEXT->getCurrentUser();

        if ($user && strpos($text, '[user:first_name]') !== false) {
            $text = str_replace('[user:first_name]', ucfirst(mb_strtolower($user->firstname)), $text);
        }

        return $text;
    }
}
