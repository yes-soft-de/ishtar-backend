<?php


namespace App\Validator;


use App\Entity\VideoEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;

class VideoValidate implements VideoValidateInterface
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }


    /**
     * @param Request $request
     * @param $type
     * @return false|string|null
     */
    public function videoValidator(Request $request, $type)
    {
        $input = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([

            'id' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'painting' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'artist' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'url' => [
                new Required(),
                new Assert\NotBlank(),

            ],
            'addingDate' => [
                new Required(),
                new Assert\NotBlank(),
            ],

        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['painting']);
            unset($constraints->fields['artist']);
            unset($constraints->fields['url']);
            unset($constraints->fields['date']);
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
            if (!$this->entityManager->getRepository(VideoEntity::class)->find($input["id"])) {
                return "No Video with this id!";
            }
        }
        return null;
    }
}