#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Console\Application;

$app = new Application("The moving bot", 1.0);

$app->add(new \app\Commands\BotCommand());

$app->run();