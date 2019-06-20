<?php
namespace App\Service;

use App\Entity\Content;
use App\Entity\SiFile;
use App\Repository\ContentRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ContentService which manage content business logic.
 * @package App\Service
 */
class ContentService
{
    private $contentRepository;
    private $entityManager;
    private $dir = "";

    public function __construct(ContentRepository $contentRepository, EntityManager $entityManager)
    {
        $this->contentRepository = $contentRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * Upload a file and link it to a content
     * @param Content $content content related to the upload
     * @param UploadedFile $file file to upload
     * @param string $type content upload type
     * @return SiFile the created SiFile object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function upload(Content $content, UploadedFile $file, string $type): SiFile
    {
        $filename = $this->generateFilename();
        $filename  = $filename . '.' . $file->guessExtension();
        $file->move($this->dir, $filename);

        $siFile = new SiFile();
        $siFile->setMediaFileName($filename);
        if (in_array($type, SiFile::FILE_TYPE)) {
            $siFile->setType(SiFile::FILE_TYPE[$type]);
        }

        $content->addPicture($siFile);

        $this->entityManager->persist($siFile);
        $this->entityManager->flush();

        return $siFile;
    }

    /**
     * Return an unique filename.
     * @return string the unique file name
     */
    private function generateFilename()
    {
        return md5(uniqid());
    }
}
