<?php

namespace Oro\Bundle\TestFrameworkBundle\Behat\Cli;

use Behat\Testwork\Cli\Controller;
use Oro\Bundle\TestFrameworkBundle\Behat\Suite\SuiteConfigurationRegistry;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AvailableSuiteSetsController implements Controller
{
    /**
     * @var SuiteConfigurationRegistry
     */
    private $suiteConfigRegistry;

    /**
     * @param SuiteConfigurationRegistry $suiteConfigRegistry
     */
    public function __construct(SuiteConfigurationRegistry $suiteConfigRegistry)
    {
        $this->suiteConfigRegistry = $suiteConfigRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function configure(SymfonyCommand $command)
    {
        $command
            ->addOption(
                '--available-suite-sets',
                null,
                InputOption::VALUE_NONE,
                'Output all available suite sets'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getOption('available-suite-sets')) {
            return;
        }

        foreach (array_keys($this->suiteConfigRegistry->getSets()) as $set) {
            $output->writeln($set);
        }

        return 0;
    }
}
