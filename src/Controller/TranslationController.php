<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\CreateArtistTranslationRequest;
use App\Request\CreatePaintingTranslationRequest;
use App\Service\TranslationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TranslationController extends BaseController
{

    private $autoMapping;
    private $translation;

    public function __construct(AutoMapping $autoMapping, TranslationService $translation)
    {
        $this->autoMapping = $autoMapping;
        $this->translation = $translation;
    }

    /**
     * @Route("/pantingtranslation", name = "pantingTranslation", methods={"POST"})
     * @IsGranted("ROLE_ADMIN", message="access denied")
     */
    public function PaintingTranslation(Request $request)
    {
        //ToDo: Validation :3

        $data = json_decode($request->getContent(), true);

        $request = $this->autoMapping->map(\stdClass::class,CreatePaintingTranslationRequest::class,(object)$data);

        $result = $this->translation->CreatePaintingTranslation($request);

        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/artisttranslation", name = "artisttranslation", methods={"POST"})
     * @IsGranted("ROLE_ADMIN", message="access denied")
     */
    public function ArtistTranslation(Request $request)
    {
        //ToDo: Validation :3

        $data = json_decode($request->getContent(), true);

        $request = $this->autoMapping->map(\stdClass::class,CreateArtistTranslationRequest::class,(object)$data);

        $result = $this->translation->CreateArtistTranslation($request);

        return $this->response($result, self::CREATE);
    }
}
