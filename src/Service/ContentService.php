<?php
namespace App\Service;

use App\Entity\Content;
use App\Entity\SiFile;
use App\Repository\ContentRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    public function __construct(ContentRepository $contentRepository, EntityManagerInterface $entityManager)
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
     * @throws \Exception
     */
    public function uploadPicture(Content $content, UploadedFile $file, string $type): SiFile
    {
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file->guessExtension(), $extensions)) {
            throw new \Exception("Wrong extension");
        }

        return $this->upload($content, $file, $type);
    }

    public function upload(Content $content, UploadedFile $file, string $type): SiFile
    {
        $filename = $this->generateFilename();
        $filename  = $filename . '.' . $file->guessExtension();
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

    /**
     * Slugify a string
     * @param  string $string to slugify
     * @return string $cleaned string
     */
    public function slugify(string $string, $delimiter = '-'):string
    {
        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        setlocale(LC_ALL, $oldLocale);
        return $clean;
    }

    /**
     * slugify the title, checks if already exists
     * @param  string $title of the content
     * @return string $slug to save
     */
    public function slugAndCheck(string $title, $i = 2):string
    {
        $slug = $this->slugify($title);
        if ($this->contentRepository->findOneBy(['slug'=>$slug])!= null) {
            $i++;
            $this->slugAndCheck($title.$i, $i);
        }
        return $slug;
    }

    /**
     * verify if content is fully translated or not
     * @param  Content $content
     * @return bool
     */
    public function checkTanslated(Content $content) :bool
    {
        if ($content->getTitleEn() == null
            ||$content->getCountryEn() == null
            ||$content->getContentEn() == null) {
            return false;
        }
        return true;
    }

    /**
     * verify if content is fully filled
     * @param  Content $content
     * @return bool
     */
    public function checkComplete(Content $content) :bool
    {
        $type=$content->getContentType();
        switch ($type) {
            case 1: //festival
                return !(
                    $content->getContentFr() == null
                    ||  $content->getCountryFr() == null
                    ||  $content->getEdition() == null
                    ||  $content->getDirector() == null
                    || count($content->getPictures()) == 0
                    || count($content->getSessions()) == 0
                );
            case 2: //actualités
                return !(
                    $content->getContentFr() == null
                    ||  (   $content->getTopArticle() == true
                        &&  $content->getcarouselPicture() == null)
                );
            case 3: //static
                return !(
                    $content->getContentFr() == null
                    || count($content->getPictures()) == 0
                );
            case 4: //hors-scene
                return !(
                    $content->getContentFr() == null
                    ||  $content->getCountryFr() == null
                    ||  $content->getEdition() == null
                    ||  $content->getDirector() == null
                    || count($content->getPictures()) == 0
                );
            case 5: //tournée
                return !(
                    $content->getContentFr() == null
                    ||  $content->getEdition() == null
                    ||  $content->getDirector() == null
                    || count($content->getPictures()) == 0
                );
        }
    }
}
