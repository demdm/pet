<?php

namespace App\CompanyBundle\Service;

use App\CompanyBundle\Service\Exception\LogoNotExistsException;
use App\CompanyBundle\Service\Exception\LogoNotRemovedException;
use App\CompanyBundle\Service\Exception\LogoNotWrittenException;
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
    public function write(UploadedFile $uploadedFile): string
    {
        $logoFileName = sprintf(
            '%s.%s',
            Uuid::uuid4()->toString(),
            $uploadedFile->guessExtension()
        );

        $logoFilePath = sprintf(
            '%s/%s',
            $this->logoPathFileDirectory,
            $logoFileName
        );

        $stream = fopen($uploadedFile->getRealPath(), 'r+');
        $isWrittenLogoFile = $this->filesystem->writeStream($this->getFilePath($logoFilePath), $stream);
        fclose($stream);

        if (!$isWrittenLogoFile) {
            throw new LogoNotWrittenException();
        }

        return $logoFileName;
    }

    /**
     * @param string $logoFileName
     *
     * @throws LogoNotRemovedException
     * @throws FileNotFoundException
     */
    public function delete($logoFileName)
    {
        $isDeletedLogoFile = $this->filesystem->delete($this->getFilePath($logoFileName));

        if (!$isDeletedLogoFile) {
            throw new LogoNotRemovedException();
        }
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function getFilePath(string $fileName): string
    {
        return sprintf(
            '%s/%s',
            $this->logoPathFileDirectory,
            $fileName
        );
    }

    /**
     * @param string $fileName
     * @return string
     * @throws LogoNotExistsException
     */
    public function getFullFilePath(string $fileName): string
    {
        $filePath = sprintf(
            '%s/%s',
            $this->filesystem->getAdapter()->getPathPrefix(),
            $this->getFilePath($fileName)
        );

        if (!file_exists($filePath)) {
            throw new LogoNotExistsException();
        }

        return $filePath;
    }
}
