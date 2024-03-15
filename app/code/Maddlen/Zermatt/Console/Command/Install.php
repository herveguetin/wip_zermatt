<?php
/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

namespace Maddlen\Zermatt\Console\Command;

use Maddlen\Zermatt\Service\App\Install as AppInstall;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Install extends Command
{
    const TARGET_THEME_CODE = 'targetThemeCode';
    private OutputInterface $output;

    public function __construct(
        protected readonly AppInstall $install,
        ?string                       $name = null
    )
    {
        parent::__construct($name);
    }

    /**
     * Initialization of the command.
     */
    protected function configure()
    {
        $this->setName('zermatt:install');
        $this->setDescription('Install Zermatt.');
        $this->addArgument(self::TARGET_THEME_CODE, InputArgument::REQUIRED, 'The theme code in which to install Zermatt. Ex: MyVendor/mytheme');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->install->install($input->getArgument(self::TARGET_THEME_CODE));

        $this->messages([
            "<info>Zermatt was successfully installed in {$this->install->getTargetThemeDir(false)}</info>",
            "<comment>Go to this new directory and run `npm install`.</comment>",
            "<comment>Ex: `cd {$this->install->getTargetThemeDir()} && npm install`</comment>",
        ]);

        return Command::SUCCESS;
    }

    private function messages(array $messages): void
    {
        array_walk($messages, fn($message) => $this->output->writeln($message));
    }
}
