<?php

/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 30/03/2016
 * Time: 17:04
 */

namespace AppBundle\Antispam;

class Antispam
{
    private $antispamLength;
    private $mailer;
    public function __construct($antispamLength, \Swift_Mailer $mailer)
    {
        $this->antispamLength = $antispamLength;
        $this->mailer = $mailer;
    }

    public function isSpam($text)
    {
        return strlen($text) > $this->antispamLength;
    }
}