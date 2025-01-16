<?php

namespace App\Command;

use App\Service\ArtiestService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'data:export',
    description: 'Add a short description for your command',
)]
class ExportDataCommand extends Command
{

    private ArtiestService $as;

    public function __construct(ArtiestService $as)
    {
        parent::__construct();

        $this->as = $as;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'Argument description')
            ->addOption('json', null, InputOption::VALUE_NONE, 'JSON File')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('file');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('json')) {
            // ...
        }

        $data = $this->as->fetchAllArtiesten();
        $return = [];
        foreach($data as $artiest) {
            $return[] = [
                "id" => $artiest->getId(),
                "naam" => $artiest->getNaam(),
                "genre" => $artiest->getGenre(),
            ];
        }

        file_put_contents($arg1, json_encode($return));
        $io->success('Data geexporteerd naar ' . $arg1);

        return Command::SUCCESS;
    }
}
