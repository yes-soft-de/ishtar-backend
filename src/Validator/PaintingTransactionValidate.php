<?php


namespace App\Validator;


use App\Entity\PaintingTransactionEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;

class PaintingTransactionValidate implements PaintingTransactionValidateInterface
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }


    public function paintingTransactionValidator(Request $request, $type)
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
            'client' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'date' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'price' => [
                new Required(),
                new Assert\NotBlank(),
            ],

        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['painting']);
            unset($constraints->fields['client']);
            unset($constraints->fields['date']);
            unset($constraints->fields['price']);
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
            if (!$this->entityManager->getRepository(PaintingTransactionEntity::class)->find($input["id"])) {
                return "No PaintingTransaction with this id!";
            }
        }
        return null;
    }
}