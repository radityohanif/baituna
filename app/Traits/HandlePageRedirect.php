<?php

namespace App\Traits;

trait HandlePageRedirect
{
    protected function getRedirectUrl(): string
    {
        $resource = $this->getResource();

        if ($resource::hasPage('view') && $this->record) {
            return $resource::getUrl('view', ['record' => $this->record]);
        }

        return $resource::getUrl('index');
    }
}
