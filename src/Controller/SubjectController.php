<?php

namespace App\Controller;

use App\Entity\Subject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SubjectController extends AbstractController
{
    /**
     * @Route("/subject", name="api_subject")
     */
    public function subject(Request $request)
    {
        $subjects = $this->getDoctrine()
            ->getRepository(Subject::class)
            ->findAll();

        $response = [];

        foreach ($subjects as $subject) {
            $response[] = [
                'id' => $subject->getId(),
                'name' => $subject->getName(),
            ];
        }

        return $this->json($response);
    }
}