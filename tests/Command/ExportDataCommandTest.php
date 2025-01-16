<?php

namespace App\Tests\Command;

use App\Command\ExportDataCommand;
use App\Service\ArtiestService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ExportDataCommandTest extends TestCase
{
    private $artiestServiceMock;

    protected function setUp(): void
    {
        $this->artiestServiceMock = $this->createMock(ArtiestService::class);
    }

    public function testExecute()
    {
        $this->artiestServiceMock->method('fetchAllArtiesten')->willReturn([
            ['id' => 1, 'naam' => 'Artiest 1', 'genre' => 'Genre 1'],
            ['id' => 2, 'naam' => 'Artiest 2', 'genre' => 'Genre 2'],
        ]);

        $application = new Application();
        $application->add(new ExportDataCommand($this->artiestServiceMock));

        $command = $application->find('data:export');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'file' => 'test.json',
            '--json' => true,
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Data geexporteerd naar test.json', $output);

        $this->assertFileExists('test.json');
        $this->assertJsonStringEqualsJsonFile('test.json', json_encode([
            ['id' => 1, 'naam' => 'Artiest 1', 'genre' => 'Genre 1'],
            ['id' => 2, 'naam' => 'Artiest 2', 'genre' => 'Genre 2'],
        ]));

        // Clean up
        unlink('test.json');
    }
}