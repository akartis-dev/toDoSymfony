<?php

namespace App\Command;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TruncateDbCommand extends Command
{
	protected static $defaultName = 'app:truncate-db';
	private EntityManagerInterface $em;
	private string $migrationTable = "doctrine_migration_versions";

	public function __construct(string $name = null, EntityManagerInterface $em)
	{
		parent::__construct($name);
		$this->em = $em;
	}

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
	    $io = new SymfonyStyle($input, $output);

	    $c = $this->em->getConnection();

	    $io->title("Truncate en cours...");

	    $this->buildQuery($c,  $io, $output);

	    $io->write('Love Sf <3!');
	    $io->success('Truncate ok!');

	    return Command::SUCCESS;
    }

	private function buildQuery(Connection $c , SymfonyStyle $io, OutputInterface $output): void
	{

		$table = $c->getSchemaManager()->listTableNames();
		$db = $c->getDatabase();

		$progressBar = new ProgressBar($output, (count($table) - 1));

		$query = "SET FOREIGN_KEY_CHECKS=0;";
		$c->executeQuery($query);
		foreach ($table as $t){
			if($t !== $this->migrationTable){
				$query = sprintf("TRUNCATE TABLE %s.%s;", $db, $t) ;
				$progressBar->advance();
				$c->executeQuery($query);
				$io->text(sprintf("Truncate %s en cours...", $t));
			}
		}
		$query = "SET FOREIGN_KEY_CHECKS=1;";
		$c->executeQuery($query);
		$progressBar->finish();
	}
}
