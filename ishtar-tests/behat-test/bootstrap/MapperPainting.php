<?php

class MapperPainting
{

    /*
     * Keys
     */

    // region The Keys
    private $KEY_NAME = "name";
    private $KEY_ARTIST = "artist";
    private $KEY_ART_TYPE = "artType";
    private $KEY_STORY = "story";
    private $KEY_STATE = "state";
    private $KEY_HEIGHT = "height";
    private $KEY_WIDTH = "width";
    private $KEY_PRICE = "price";
    private $KEY_COLORS_TYPE = "colorsType";
    private $KEY_ACTIVE = "active";
    private $KEY_IMAGE = "image";
    private $KEY_GALLERY = "gallery";
    private $KEY_KEYWORDS = "keyWords";
    // endregion

    /**
     * @var ObjectPainting $painting
     */
    private $painting;

    public function __construct()
    {

    }

    public function setPainting(
        $name, $artist, $artType, $state,
        $height, $width, $price, $colorsType,
        $active, $image, $gallery, $keyWords,
        $story)
    {
        $this->painting = new ObjectPainting();

        $this->painting->setName($name);
        $this->painting->setArtist($artist);
        $this->painting->setState($state);
        $this->painting->setHeight($height);
        $this->painting->setWidth($width);
        $this->painting->setPrice($price);
        $this->painting->setImage($image);
        $this->painting->setArtType($artType);
        $this->painting->setImage($image);
        $this->painting->setActive($active);
        $this->painting->setGallery($gallery);
        $this->painting->setKeyWords($keyWords);
        $this->painting->setColorsType($colorsType);
        $this->painting->setStory($story);
    }

    /**
     * @return ObjectPainting
     */
    public function getPainting(): ObjectPainting
    {
        return $this->painting;
    }

    /**
     * @return array
     */
    public function getPaintingAsArray(): array
    {
        return [
            $this->KEY_NAME => $this->painting->getName(),
            $this->KEY_ARTIST => $this->painting->getArtist(),
            $this->KEY_ART_TYPE => $this->painting->getArtType(),
            $this->KEY_STORY => $this->painting->getStory(),
            $this->KEY_STATE => $this->painting->getState(),
            $this->KEY_HEIGHT => $this->painting->getHeight(),
            $this->KEY_WIDTH => $this->painting->getWidth(),
            $this->KEY_PRICE => $this->painting->getPrice(),
            $this->KEY_COLORS_TYPE => $this->painting->getColorsType(),
            $this->KEY_ACTIVE => $this->painting->getActive(),
            $this->KEY_IMAGE => $this->painting->getImage(),
            $this->KEY_GALLERY => $this->painting->getGallery(),
            $this->KEY_KEYWORDS => $this->painting->getKeyWords()
        ];
    }

    /**
     * @param ObjectPainting $painting
     * @return bool
     */
    function isEqual($painting): bool
    {

        $second = $this->getPainting();
        if (is_object($painting)) {
            $first = $this->getPaintingAsArray();
        } else if (is_array($painting)) {
            $first = $painting;
        } else {
            return false;
        }

        // If its an array
        if ($first[$this->KEY_NAME] != $second->getName())
            return false;
        if ($first[$this->KEY_ARTIST] != $second->getArtist())
            return false;
        if ($first[$this->KEY_STATE] != $second->getState())
            return false;
        if ($first[$this->KEY_HEIGHT] != $second->getHeight())
            return false;
        if ($first[$this->KEY_WIDTH] != $second->getWidth())
            return false;
        if ($first[$this->KEY_PRICE] != $second->getPrice())
            return false;
        if ($first[$this->KEY_IMAGE] != $second->getArtType())
            return false;
        if ($first[$this->KEY_ACTIVE] != $second->getActive())
            return false;
        if ($first[$this->KEY_GALLERY] != $second->getGallery())
            return false;
        if ($first[$this->KEY_KEYWORDS] != $second->getKeyWords())
            return false;
        if ($first[$this->KEY_COLORS_TYPE] != $second->getColorsType())
            return false;
        if ($first[$this->KEY_STORY] != $second->getStory())
            return false;

        // If all the above is OK then the Objects are equal
        return true;
    }
}
