<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeReactService extends Command
{
    protected $signature = 'make:react-service {name}';
    protected $description = 'Create a new React service class file';
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $name = $this->argument('name');
        $pathParts = explode('/', $name);
        $fileName = array_pop($pathParts);
        $directory = resource_path('js/Services/' . implode('/', $pathParts));
        $path = "{$directory}/{$fileName}.js";

        // Create directory if it doesn't exist
        if (!$this->filesystem->isDirectory($directory)) {
            $this->filesystem->makeDirectory($directory, 0755, true);
            $this->info("Created directory: {$directory}");
        }

        if ($this->filesystem->exists($path)) {
            $this->error("Service {$name} already exists!");
            return 1;
        }

        $stub = $this->getStub();
        $stub = str_replace('{{name}}', $fileName, $stub);

        $this->filesystem->put($path, $stub);

        $this->info("Service {$name} created successfully.");
        return 0;
    }

    protected function getStub()
    {
        return <<<'STUB'
import axios from 'axios';

class {{name}} {
    constructor() {
        this.api = axios.create({
            baseURL: '/api', // 기본 API URL
        });
    }

    async getAll() {
        try {
            const response = await this.api.get('/{{name}}');
            return response.data;
        } catch (error) {
            console.error('Error fetching data:', error);
            throw error;
        }
    }

    async create(data) {
        try {
            const response = await this.api.post('/{{name}}', data);
            return response.data;
        } catch (error) {
            console.error('Error creating data:', error);
            throw error;
        }
    }

    // 추가적인 메소드 정의 가능
}

export default new {{name}}();
STUB;
    }
}
