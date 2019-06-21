<?php
namespace App\Service;

use App\Entity\Content;
use App\Entity\SiFile;
use App\Repository\ContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ContentService which manage content business logic.
 * @package App\Service
 */
class ContentService
{
    private $contentRepository;
    private $entityManager;
    private $dir = "upload/file";
    private $container;

    public function __construct(Container $container, ContentRepository $contentRepository,
                                EntityManagerInterface $entityManager)
    {
        $this->contentRepository = $contentRepository;
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    /**
     * Upload a file and link it to a content
     * @param Content $content content related to the upload
     * @param UploadedFile $file file to upload
     * @param string $type content upload type
     * @return SiFile the created SiFile object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function upload(Content $content, UploadedFile $file, string $type): SiFile
    {
        $filename = $this->generateFilename();
        $filename  = $filename . '.' . 'jpg';
        $file->move($this->dir, $filename);

        $siFile = new SiFile();
        $siFile->setMediaFileName($filename);
        $siFile->setUpdatedAt(new \DateTime('now'));
        if (in_array($type, array_keys(SiFile::FILE_TYPE))) {
            $siFile->setType(SiFile::FILE_TYPE[$type]);
        }

        $content->addPicture($siFile);

        $this->entityManager->persist($siFile);
        $this->entityManager->flush();

        return $siFile;
    }

    /**
     * Delete the picture related to the content in parameter.
     * @param Content $content related content
     * @param SiFile $siFile SiFIle to delete
     */
    public function deletePicture(Content $content, SiFile $siFile)
    {
        $fs = new Filesystem();
        $filepath = $this->dir . '/' . $siFile->getMediaFileName();
        if ($fs->exists($filepath)) {
            $fs->remove($filepath);
        }
        $content->removePicture($siFile);

        $this->entityManager->remove($siFile);
        $this->entityManager->flush();
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
