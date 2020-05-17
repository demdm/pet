<?php

namespace App\CompanyBundle\Message;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateCompany
{
    public ?string $creatorAccountId = null;
    public ?string $id = null;
    public ?string $name = null;
    public ?string $address = null; // nullable
    public ?UploadedFile $logoFile = null; // nullable
    public ?string $logoFilePath = null; // nullable
}
