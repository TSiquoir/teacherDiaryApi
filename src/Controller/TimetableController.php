<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TimetableController extends AbstractController
{
    /**
     * @Route("/timetable/task", name="api_timetable_task")
     */
    public function timetableTask(Request $request)
    {
        $dateStart = $request->request->get('start');

        return $this->json(true);
    }
}