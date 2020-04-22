<?php

namespace App\Hrm\Company\Command;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateCompany
{
    public string $creatorId;
    public string $id;
    public string $name;
    public ?string $address;
    public ?UploadedFile $logoFile;

    public function __construct(
        string $creatorId,
        string $id,
        string $name,
        ?string $address = null,
        ?UploadedFile $logoFile = null
    ) {
        $this->creatorId = $creatorId;
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->logoFile = $logoFile;
    }
}
