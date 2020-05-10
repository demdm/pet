<?php

namespace App\Hrm\Company\Service;

use App\Hrm\Company\Service\Exception\LogoNotRemovedException;
use App\Hrm\Company\Service\Exception\LogoNotWrittenException;
use Exception;
use League\Flysystem\FileExistsException;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\FilesystemInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LogoFileSystem
{
    private FilesystemInterface $filesystem;
    private string $logoPathFileDirectory;

    public function __construct(
        FilesystemInterface $filesystem,
        string $logoPathFileDirectory
    ) {
        $this->filesystem = $filesystem;
        $this->logoPathFileDirectory = $logoPathFileDirectory;
    }

    /**
     * @param UploadedFile $uploadedFile
     *
     * @throws LogoNotWrittenException
     * @throws FileExistsException
     * @throws Exception
     *
     * @return string
     */
    public function write(UploadedFile $uploadedFile)
    {
        $blankContractFileName = sprintf(
            '%s.%s',
            Uuid::uuid4()->toString(),
            $uploadedFile->guessExtension()
        );

        $blankContractFilePath = sprintf(
            '%s/%s',
            $this->logoPathFileDirectory,
            $blankContractFileName
        );

        $stream = fopen($uploadedFile->getRealPath(), 'r+');
        $isWrittenLogoFile = $this->filesystem->writeStream($blankContractFilePath, $stream);
        fclose($stream);

        if (!$isWrittenLogoFile) {
            throw new LogoNotWrittenException();
        }

        return $blankContractFileName;
    }

    /**
     * @param string $blankContractFileName
     *
     * @throws LogoNotRemovedException
     * @throws FileNotFoundException
     */
    public function delete($blankContractFileName)
    {
        $isDeletedLogoFile = $this->filesystem->delete(
            sprintf(
                '%s/%s',
                $this->logoPathFileDirectory,
                $blankContractFileName
            )
        );

        if (!$isDeletedLogoFile) {
            throw new LogoNotRemovedException();
        }
    }
}
