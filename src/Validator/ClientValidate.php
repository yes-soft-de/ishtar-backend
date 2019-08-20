<?php


namespace App\Validator;


use App\Entity\ClientEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ClientValidate implements ClientValidateInterface
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }



    public function clientValidator(Request $request, $type)
    {
        $input = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([

            'id' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'name' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'userName' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'password' => [
                new UserPassword(),
                new Assert\NotBlank
            ],
            'email' => [
                new Email(),
                new Assert\Blank(),
                ]
        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['name']);
            unset($constraints->fields['userName']);
            unset($constraints->fields['password']);
            unset($constraints->fields['email']);
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
            if (!$this->entityManager->getRepository(ClientEntity::class)->find($input["id"])) {
                return "No Client with this id!";
            }
        }
        return null;
    }
}