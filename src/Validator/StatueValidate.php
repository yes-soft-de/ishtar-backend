<?php


namespace App\Validator;


use App\Entity\StatueEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Required;

class StatueValidate implements StatueValidateInterface
{
    private $validator;
    private $entityManager;

    public function __construct(ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface)
    {
        $this->validator = $validator;
        $this->entityManager = $entityManagerInterface;
    }

    public function statueValidator(Request $request, $type)
    {
        $input = json_decode($request->getContent(), true);
        $constraints = new Assert\Collection([

            'name' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'artist' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'material' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'image' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'state' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'height'=>[
                new Required(),
                new Assert\NotBlank(),
            ],
            'width'=>[
                new Required(),
                new Assert\NotBlank(),
            ],
            'price' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'description' => [
                new Required(),
                new Assert\NotBlank(),
            ],
            'active'=>[
                new Required(),
                new Assert\NotBlank(),
            ],
            'style'=>[
                new Required(),
                new Assert\NotBlank(),
            ],
            'mediums'=>[
                new Required(),
                new Assert\NotBlank(),
            ],
            'keyWords'=>[
                new Required(),
                new Assert\NotBlank(),
            ],
            'features'=>[
                new Required(),
                new Assert\NotBlank(),
                ],
            'period'=>[
                new Required(),
                new Assert\NotBlank(),
            ],
            'weight'=>[
                new Required(),
                new Assert\NotBlank(),
            ],
            'length'=>[
                new Required(),
                new Assert\NotBlank(),
            ],

        ]);

        if ($type == 'create') {
            unset($constraints->fields['id']);
        }
        if ($type == "delete") {
            unset($constraints->fields['name']);
            unset($constraints->fields['artist']);
            unset($constraints->fields['artType']);
            unset($constraints->fields['addingDate']);
            unset($constraints->fields['story']);
            unset($constraints->fields['keyWords']);
            unset($constraints->fields['colorsType']);
            unset($constraints->fields['price']);
            unset($constraints->fields['state']);
            unset($constraints->fields['gallery']);
            unset($constraints->fields['image']);
            unset($constraints->fields['active']);
            unset($constraints->fields['height']);
            unset($constraints->fields['width']);

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

        return null;
    }
}