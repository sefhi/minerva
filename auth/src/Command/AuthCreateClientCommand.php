<?php

namespace App\Command;

use Auth\Application\Client\CreateClientCommand;
use Auth\Application\Client\CreateClientCommandHandler;
use Auth\Domain\Client\ClientIdentifier;
use Auth\Domain\Client\ClientName;
use Auth\Domain\Client\ClientSecret;
use Auth\Domain\Client\Grant;
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
            ->setHelp('This command allows you to create a client')
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
                Grant::cases()
            )
            ->addOption(
                'scope',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets allowed scope for client. Use this option multiple times to set multiple scopes.',
                []
            )
            ->addOption(
                'name',
                null,
                InputOption::VALUE_REQUIRED,
                'The client name'
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

            $name = $input->getOption('name');
            /** @var list<string> $grantStrings */
            $grantStrings = $input->getOption('grant-type') ?? [Grant::CLIENT_CREDENTIALS];


            $command = CreateClientCommand::create(
                ClientName::fromString($name),
                $grantStrings,
            );

            $result = ($this->commandHandler)($command);

            $io->success('New OAuth2 client created successfully.');

            $headers = ['Identifier', 'Secret'];
            $rows = [
                [(string)$result->getIdentifier(), (string)$result->getCredentials()->getSecret()],
            ];
            $io->table($headers, $rows);

            return Command::SUCCESS;

        } catch (\InvalidArgumentException $exception) {
            $io->error($exception->getMessage());

            return 1;
        }
    }
}
