<?php


namespace App\Response;


class CreatePaintingTranslationResponse
{
    public $originID;
    public $language;
    public $name;
    public $artist;
    public $keyWords;
    public $artType;
    public $colorsType;
    public $story;

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }


    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist): void
    {
        $this->artist = $artist;
    }

    /**
     * @return mixed
     */
    public function getKeyWords()
    {
        return $this->keyWords;
    }

    /**
     * @param mixed $keyWords
     */
    public function setKeyWords($keyWords): void
    {
        $this->keyWords = $keyWords;
    }

    /**
     * @return mixed
     */
    public function getArtType()
    {
        return $this->artType;
    }

    /**
     * @param mixed $artType
     */
    public function setArtType($artType): void
    {
        $this->artType = $artType;
    }

    /**
     * @return mixed
     */
    public function getColorsType()
    {
        return $this->colorsType;
    }

    /**
     * @param mixed $colorsType
     */
    public function setColorsType($colorsType): void
    {
        $this->colorsType = $colorsType;
    }

    /**
     * @return mixed
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * @param mixed $story
     */
    public function setStory($story): void
    {
        $this->story = $story;
    }


    /**
     * @return mixed
     */
    public function getOriginID()
    {
        return $this->originID;
    }

    /**
     * @param mixed $originID
     */
    public function setOriginID($originID): void
    {
        $this->originID = $originID;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


}