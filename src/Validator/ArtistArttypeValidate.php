<?php


namespace App\Validator;


use App\Entity\ArtistArttypeEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;

class ArtistArttypeValidate implements ArtistArtTypeValidateInterface
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }

    public function artistArttypeValidator(Request $request, $type)
    {
        $input = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([

            'id' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'artist' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'artType' => [
                new Required(),
                new Assert\NotBlank(),
            ],

        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['artist']);
            unset($constraints->fields['arttype']);
        }

        $violations = $this->validator->validate($input, $constraints);

        if (count($violations) > 0) {
            $accessor = PropertyAccess::createPropertyAccessor();

            $errorMessages = [];

            foreach ($violations as $violation) {
                $accessor->setValue($errorMessages,
                    $violation->getPropertyPath(),
                    $violation->getMessage());
            }

            $result = json_encode($errorMessages);

            return $result;
        }

        if ($type != "create") {
            if (!$this->entityManager->getRepository(ArtistArttypeEntity::class)->find($input["id"])) {
                return "No ArtistArttype with this id!";
            }
        }
        return null;
    }
}