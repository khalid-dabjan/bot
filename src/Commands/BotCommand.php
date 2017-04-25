<?php

namespace app;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BotCommand extends Command
{
    /**
     * Set the configuration for the command
     */
    protected function configure()
    {
        $this->setName('bot:move')
            ->setDescription('Move the bot')
            ->setHelp('Use this command to move the bot in a given fashion')
            ->addArgument('direction', InputArgument::REQUIRED, 'The direction string for the bot to move');
    }

    /**
     * Execute the command
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($input->getArguments('direction'));
    }
}