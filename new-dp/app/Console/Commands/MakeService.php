<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';
    protected $filesystem;
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $servicePath = app_path("Services/{$name}.php");

        // 파일 경로에서 디렉토리 부분을 추출
        $directory = dirname($servicePath);

        // 디렉토리가 존재하지 않으면 생성
        if (!$this->filesystem->isDirectory($directory)) {
            $this->filesystem->makeDirectory($directory, 0755, true);
        }

        if (File::exists($servicePath)) {
            $this->error("Service {$name} already exists!");
            return 1;
        }
        $fileName = basename($name);
        $stub = File::get(base_path('stubs/service.stub'));
        $serviceContent = str_replace('{{ class }}', $fileName, $stub);

        File::ensureDirectoryExists(app_path('Services'));
        File::put($servicePath, $serviceContent);

        $this->info("Service {$name} created successfully.");
        return 0;
    }
}
