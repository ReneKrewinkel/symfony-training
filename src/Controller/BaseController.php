<?php

namespace App\Controller;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController {

    protected $log;
    public function __construct(LoggerInterface $log) {
        $this->log = $log;
    }
}