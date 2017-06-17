<?php

namespace AppBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCSVCommand extends Command
{
    protected function configure()
    {
        $this->setName('app:generate:csv')
            ->addArgument('dir', InputArgument::REQUIRED, 'This field required');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln('Iniciando carga de datos');

        $location = dirname(__DIR__ . '/../../');
        $dir = $location . $input->getArgument('dir');
        $csv = $location . 'files/file.csv';
        shell_exec('in2csv ' . $dir . ' > ' . $csv);
        $array = $fields = array();
        $i = 0;

        if ($handle = @fopen($csv, 'r')) {

            while (($row = fgetcsv($handle, 4096)) !== false) {

                if (empty($fields)) {

                    $fields = $row;
                    continue;
                }

                foreach ($row as $k => $value) {

                    $array[$i][$fields[$k]] = $value;
                }

                $i++;
            }

            if (!feof($handle)) {

                $output->writeln('Error: unexpected fgets() fail\n');
            }

            fclose($handle);
        }
    }
}