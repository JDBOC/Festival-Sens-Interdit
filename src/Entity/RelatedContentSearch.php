<?php
namespace App\Entity;

class RelatedContentSearch
{
    /**
     * @var int
     */
    private $contentType;

       /**
     * @return int
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param int $contentType
     *
     * @return self
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }
}
