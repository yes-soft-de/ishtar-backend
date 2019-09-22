<?php


namespace App\Validator;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;

class ImageUploadValidate implements ImageUploadValidateInterface
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }

    public function uploadedFileValidator(Request $request, $type)
    {
        /** @var UploadedFile $input */
        $input = $request->files->get('image');

        $constraints = new Assert\Collection([
            'image' => [
                new Assert\NotBlank(['message' => "dd"]),
                new Assert\NotNull(),
                new Required(),
                new Assert\Image(),
            ],

        ]);

        $violations = $this->validator->validate($input, $constraints);

        if (count($violations) > 0)
        {
            $accessor = PropertyAccess::createPropertyAccessor();

            $errorMessages = [];

            foreach ($violations as $violation)
            {
                    $accessor->setValue($errorMessages,
                    $violation->getPropertyPath(),
                    $violation->getMessage());
            }

            $result = json_encode($errorMessages);

            return $result;
        }

        return null;
    }
}