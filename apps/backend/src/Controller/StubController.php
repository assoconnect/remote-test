<?php

/**
 * ⚠️⚠️⚠️
 * ⚠️⚠️
 * ⚠️
 * THIS CONTROLLER IS A SIMPLE STUB USED FOR THE FRONTEND TECHNICAL EXERCISE.
 * THE CODE WRITTEN IN THERE SHOULD NOT BE USED AS A MODEL.
 * IT USES SOME HACKS AND BREAKS THE SYMFONY STANDARD WAY OF CODING.
 * ⚠️
 * ⚠️⚠️
 * ⚠️⚠️⚠️
 */

namespace App\Controller;

use Faker;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/users", name="api_users_")
 */
class StubController extends AbstractController
{
    public function __construct()
    {
        $this->faker = Faker\Factory::create("fr_FR");
    }

    /**
     * @Route("", name="get_collection", methods={"GET"})
     */
    public function getCollectionOperation(): JsonResponse
    {
        return $this->json([
            $this->generateUserData(),
            $this->generateUserData(),
            $this->generateUserData(),
            $this->generateUserData(),
            $this->generateUserData()
        ]);
    }

    /**
     * @Route("", name="post_collection", methods={"POST"})
     */
    public function postCollectionOperation(
        Request $request,
        ValidatorInterface $validator
    ): JsonResponse {
        $user = json_decode($request->getContent(), true);

        $errors = $validator->validate($user, $this->getUserConstraint());
        if ($user && !$errors->count()) {
            return $this->json(array_merge($user, ["id" => $this->faker->uuid]), Response::HTTP_CREATED);
        }
        return $this->json($this->getErrorsJson($errors), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{uuid}", name="get_item", methods={"GET"})
     */
    public function getItemOperation(string $uuid, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($uuid, new Assert\Uuid());
        if ($errors->count()) {
            return $this->json(["message" => "User not found"], Response::HTTP_NOT_FOUND);
        }
        return $this->json($this->generateUserData());
    }

    /**
     * @Route("/{uuid}", name="delete_item", methods={"DELETE"})
     */
    public function deleteItemOperation(string $uuid, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($uuid, new Assert\Uuid());
        if ($errors->count()) {
            return $this->json(["message" => "User not found"], Response::HTTP_NOT_FOUND);
        }
        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{uuid}", name="put_item", methods={"PUT"})
     */
    public function putItemOperation(string $uuid, Request $request, ValidatorInterface $validator): JsonResponse
    {
        $errors = $validator->validate($uuid, new Assert\Uuid());
        if ($errors->count()) {
            return $this->json(["message" => "User not found"], Response::HTTP_NOT_FOUND);
        }

        $user = json_decode($request->getContent(), true);

        $errors = $validator->validate($user, $this->getUserConstraint(true));

        if (!$errors->count()) {
            return $this->json($this->generateUserData());
        }
        return $this->json($this->getErrorsJson($errors), Response::HTTP_BAD_REQUEST);
    }

    private function generateUserData(): array
    {
        $sections = ['Tennis', 'Soccer', 'Baseball', 'Ultimate', 'Volleyball'];
        return [
            'email' => $this->faker->email,
            'first_name' => $this->faker->firstname,
            'id' => $this->faker->uuid,
            'last_name' => $this->faker->lastname,
            'phone' => $this->faker->e164PhoneNumber,
            'date_of_birth' => $this->faker->dateTimeBetween("-50 years", "-18 years")
                ->format("Y-m-d"),
            'country' => $this->faker->countryCode,
            'section' => $sections[array_rand($sections)],
        ];
    }

    private function getUserConstraint(bool $editing = false): Assert\Collection
    {
        return new Assert\Collection([
            "fields" => [
                "email" => [
                    new Assert\NotNull(),
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Regex([
                        "pattern" => "/_|-/",
                        "match" => false,
                    ])
                ],
                "firstname" => [
                    new Assert\NotNull(),
                    new Assert\NotBlank()
                ],
                "lastname" => [
                    new Assert\NotNull(),
                    new Assert\NotBlank()
                ],
                "password" => [
                    new Assert\NotNull(),
                    new Assert\NotBlank(),
                    new Assert\Length([
                        "min" => 8
                    ])
                ],
                "phone" => [
                    new Assert\NotNull(),
                    new Assert\NotBlank(),
                    new AssertPhoneNumber()
                ]
            ],
            "allowMissingFields" => $editing
        ]);
    }

    private function getErrorsJson(ConstraintViolationListInterface $violations): array
    {
        $errors = [];
        foreach ($violations as $violation) {
            $propertyName = str_replace(["[", "]"], "", $violation->getPropertyPath());
            $errors[$propertyName] = $violation->getMessage();
        }

        return ["message" => "Invalid form", "violations" => $errors];
    }
}
