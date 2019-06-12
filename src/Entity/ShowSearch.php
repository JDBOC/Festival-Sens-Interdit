<?php
namespace App\Entity;

class ShowSearch
{
    private $isComplete;

    private $isTranslated;

    private $exactEdition;

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
}
