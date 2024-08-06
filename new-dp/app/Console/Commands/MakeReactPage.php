<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeReactPage extends Command
{
    protected $signature = 'make:react-page {name}';
    protected $description = 'Create a new React page file';
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = resource_path("js/Pages/{$name}.jsx");

        // 파일 경로에서 디렉토리 부분을 추출
        $directory = dirname($path);

        // 디렉토리가 존재하지 않으면 생성
        if (! $this->filesystem->isDirectory($directory)) {
            $this->filesystem->makeDirectory($directory, 0755, true);
        }

        if ($this->filesystem->exists($path)) {
            $this->error("Page {$name} already exists!");
            return 1;
        }

        // 파일명에서 확장자와 경로를 제외한 이름을 추출
        $fileName = basename($name);

        $stub = $this->getStub();
        $content = str_replace('{{name}}', $fileName, $stub);

        $this->filesystem->put($path, $content);

        $this->info("Page {$name} created successfully.");
        return 0;
    }

    protected function getStub()
    {
            return <<<'STUB'
        import React, { useState, useEffect } from 'react';

        const {{name}} = () => {
        const [state, setState] = useState(null);

        useEffect(() => {
            // Component did mount logic
            fetchData();
        }, []);

        const fetchData = async () => {
            // Fetch data and update state
            const data = await fetch('/api/data');
            const json = await data.json();
            setState(json);
        };

        return (
            <div>
                <h1>{{name}} Page</h1>
                {state ? (
                    <div>{JSON.stringify(state)}</div>
                ) : (
                    <div>Loading...</div>
                )}
            </div>
        );
        };

        export default {{name}};
        STUB;
    }
}
