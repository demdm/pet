<?php

namespace App\Hrm\Company\Message;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateCompany
{
    public string $creatorAccountId;
    public string $id;
    public string $name;
    public ?string $address;
    public ?UploadedFile $logoFile;

    public function __construct(
        string $creatorAccountId,
        string $id,
        string $name,
        ?string $address = null,
        ?UploadedFile $logoFile = null
    ) {
        $this->creatorAccountId = $creatorAccountId;
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->logoFile = $logoFile;
    }
}
