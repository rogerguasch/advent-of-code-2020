<?php

declare(strict_types=1);


namespace App\Service;


use Symfony\Component\Finder\Finder;

class FileFinder
{
    private const FILE_FOLDER = 'public/files/';
    private Finder $finder;
    private array $content;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
        $this->content = [];
    }

    final public function find(string $nameFile): array
    {
        $this->finder->in(self::FILE_FOLDER)->name($nameFile);

        if ($this->finder->hasResults()) {
            foreach ($this->finder as $file) {
                $this->content = explode("\n", $file->getContents());
                $this->cleanLastBlankLine();
            }
        }

        return $this->content;
    }

    private function cleanLastBlankLine(): void
    {
        array_pop($this->content);
    }
}
