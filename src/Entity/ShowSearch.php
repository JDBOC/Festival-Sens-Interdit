<?php
namespace App\Entity;

class ShowSearch
{
    private $isComplete;

    private $isTranslated;

    private $exactEdition;

    private $contentType;

    /**
     * @return mixed
     */
    public function getIsComplete()
    {
        return $this->isComplete;
    }

    /**
     * @param mixed $isComplete
     *
     * @return self
     */
    public function setIsComplete($isComplete)
    {
        $this->isComplete = $isComplete;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsTranslated()
    {
        return $this->isTranslated;
    }

    /**
     * @param mixed $isTranslated
     *
     * @return self
     */
    public function setIsTranslated($isTranslated)
    {
        $this->isTranslated = $isTranslated;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExactEdition()
    {
        return $this->exactEdition;
    }

    /**
     * @param mixed $exactEdition
     *
     * @return self
     */
    public function setExactEdition($exactEdition)
    {
        $this->exactEdition = $exactEdition;

        return $this;
    }

    /**
     * Get the value of contentType
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set the value of contentType
     *
     * @return  self
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }
}
