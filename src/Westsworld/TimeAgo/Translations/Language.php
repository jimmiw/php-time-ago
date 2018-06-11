<?php

namespace Westsworld\TimeAgo\Translations;

class Language
{
    private $translations = [];

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }
}
