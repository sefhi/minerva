<?php

namespace App\Command;

use Auth\Application\Client\CreateClientCommandHandler;
use Auth\Domain\Client\ClientIdentifier;
use Auth\Domain\Client\ClientSecret;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:auth-create-client',
    description: 'Add a short description for your command',
)]
class AuthCreateClientCommand extends Command
{

    public function __construct(private readonly CreateClientCommandHandler $commandHandler)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new OAuth2 client')
            ->addOption(
                'redirect-uri',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets redirect uri for client. Use this option multiple times to set multiple redirect URIs.',
                []
            )
            ->addOption(
                'grant-type',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets allowed grant type for client. Use this option multiple times to set multiple grant types.',
                []
            )
            ->addOption(
                'scope',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets allowed scope for client. Use this option multiple times to set multiple scopes.',
                []
            )
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'The client name'
            )
            ->addArgument(
                'identifier',
                InputArgument::OPTIONAL,
                'The client identifier'
            )
            ->addArgument(
                'secret',
                InputArgument::OPTIONAL,
                'The client secret'
            )
        ;
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {

            $name = $input->getArgument('name');
            $identifier = $input->getArgument('identifier') ?? (string)ClientIdentifier::generate();
            $secret = $input->getArgument('secret') ?? (string)ClientSecret::generate();
            /** @var list<string> $redirectUriStrings */
            $redirectUriStrings = $input->getOption('redirect-uri');
            /** @var list<string> $grantStrings */
            $grantStrings = $input->getOption('grant-type');
            /** @var list<string> $scopeStrings */
            $scopeStrings = $input->getOption('scope');

        } catch (\InvalidArgumentException $exception) {
            $io->error($exception->getMessage());

            return 1;
        }

        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
