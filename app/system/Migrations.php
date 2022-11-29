<?php

namespace Crud\Mvc\system;

use Crud\Mvc\core\traits\DatabaseConnect;

class Migrations
{

    private object $database;
    private string $directory = "database/tables";
    private array $tables;


    public function dump($model)
    {
        $this->database = $model;

        $this->getTableNames();

        $this->importTable();

    }

    private function getTableNames(): void
    {
        foreach (glob($this->directory . '/*.*') as $file) {
            preg_match('/[^\/]*$/', $file, $match);
            $this->tables[] = $file;
        }
    }

    public function importTable()
    {
        $maxRuntime = 8; // less then your max script execution limit
        $deadline = time() + $maxRuntime;

        foreach ($this->tables as $filename) {
            $progressFilename = $filename . '_filepointer'; // tmp file for progress
            $errorFilename = $filename . '_error'; // tmp file for error


            ($fp = fopen($filename, 'r')) or die('failed to open file:' . $filename);

            // go to previous file position
            $filePosition = 0;
            if (file_exists($progressFilename)) {
                $filePosition = file_get_contents($progressFilename);
                fseek($fp, $filePosition);
            }

            $queryCount = 0;
            $query = '';
            while ($deadline > time() and ($line = fgets($fp, 1024000))) {
                if (substr($line, 0, 2) == '--' or trim($line) == '') {
                    continue;
                }

                $query .= $line;
                if (substr(trim($query), -1) == ';') {

                    $igweze_prep = $this->database->prepare($query);

                    if (!($igweze_prep->execute())) {
                        $error = 'Error performing query \'<strong>' . $query . '\': ' . print_r($this->database->errorInfo());
                        file_put_contents($errorFilename, $error . "\n");
                        exit;
                    }
                    $query = '';
                    file_put_contents($progressFilename, ftell($fp)); // save the current file position for
                    $queryCount++;
                }
            }
        }
    }
}