<?php

class MapperArtist
{
    /**
     * @var ObjectArtist $artist
     */
    private $artist;

    public function __construct()
    {

    }

    public function setArtist($name, $nationality, $residence, $birthDate, $story,
                              $details, $image, $artType, $facebook, $instagram,
                              $twitter, $linkedin)
    {
        $this->artist = new ObjectArtist();

        $this->artist->setName($name);
        $this->artist->setNationality($nationality);
        $this->artist->setResidence($residence);
        $this->artist->setBirthDate($birthDate);
        $this->artist->setStory($story);
        $this->artist->setDetails($details);
        $this->artist->setImage($image);
        $this->artist->setArtType($artType);
        $this->artist->setFacebook($facebook);
        $this->artist->setInstagram($instagram);
        $this->artist->setTwitter($twitter);
        $this->artist->setLikedIn($linkedin);
    }

    /**
     * @return ObjectArtist
     */
    public function getArtist(): ObjectArtist
    {
        return $this->artist;
    }

    /**
     * @return array
     */
    public function getArtistAsArray(): array
    {
        return [
            "name" => $this->artist->getName(),
            "nationality" => $this->artist->getNationality(),
            "residence" => $this->artist->getResidence(),
            "birthDate" => $this->artist->getBirthDate(),
            "story" => $this->artist->getStory(),
            "details" => $this->artist->getDetails(),
            "image" => $this->artist->getImage(),
            "artType" => $this->artist->getArtType(),
            "Facebook" => $this->artist->getFacebook(),
            "Instagram" => $this->artist->getInstagram(),
            "Twitter" => $this->artist->getTwitter(),
            "Linkedin" => $this->artist->getLikedIn()
        ];
    }
}
