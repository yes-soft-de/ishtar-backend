<?php

namespace App\Mapper;

    use App\Entity\ArtistArttypeEntity;
    use App\Entity\ArtistEntity;
    use App\Entity\ArtTypeEntity;

    class ArtistArtTypeMapper
{
    private $en;
    public function artistArttypeData($data, ArtistArttypeEntity $artistArttype,$entityManager)
    {
        $this->en=$entityManager;
        $artist =  $this->en->getRepository(ArtistEntity::class)->find($data["artist"]);
        $artType = $this->en->getRepository(ArtTypeEntity::class)->find($data["artType"]);


        $artistArttype->setArtist($artist)
            ->setArtType($artType);

        return $artistArttype;
    }
}
