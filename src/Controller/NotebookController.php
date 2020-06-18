<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotebookController extends AbstractController
{
    /**
     * @Route("/notebook/task", name="api_notebook_task")
     */
    public function notebookTask(Request $request)
    {
        $timeStart = $request->request->get('timeStart');

        if (!$timeStart || preg_match('#^[01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $timeStart)) {
            throw new NotAcceptableHttpException("L'heure est invalide");
        }

        return $this->json(true);

        
    }
}