<?php

namespace App\Controller;

use App\Entity\NotebookGoal;
use App\Entity\NotebookTask;
use App\Entity\Subject;
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
        // Récupère les données du formulaire
        $date = (string) $request->request->get('date');
        $timeStart = (string) $request->request->get('timeStart');
        $timeEnd = (string) $request->request->get('timeEnd');
        $subject = (int) $request->request->get('subject');
        $skills = (array) $request->request->get('skills');
        $goals = (array) $request->request->get('goals');
        $materials = $request->request->get('materials');
        $activityDescrition = (string) $request->request->get('activityDescrition');
        // Vérifie que la date et l'heure de début soient valide
        try {
            $datetimeStart = new \DateTime($date . ' ' . $timeStart);
        } catch (\Exception $e) {
            throw new NotAcceptableHttpException("L'heure de début de la séance n'est pas valide");
        }

        // Vérifie que la date et l'heure de fin soient valide
        try {
            $datetimeEnd = new \DateTime($date . ' ' . $timeEnd);
        } catch (\Exception $e) {
            throw new NotAcceptableHttpException("L'heure de fin de la séance n'est pas valide");
        }
        
        $entityManager = $this->getDoctrine()->getManager();

        $subject = $entityManager->getRepository(Subject::class)->find($subject);
        // vérifie qu'il y a bien une matière
        if (!$subject) {
            throw new NotAcceptableHttpException("La matière n'est pas valide");
        }

        $task = new NotebookTask;
        // Boucle dans le tableau goal pour les afficher dans le champs du formulaire
        foreach ($goals as $name) {
            $goal = new NotebookGoal;
            $goal->setName($name);
            $task->addGoal($goal);
        }
        // Pour envoyer vers la base de donnée ?
        $task
            ->setDescription($activityDescrition)
            ->setDatetimeStart($datetimeStart)
            ->setSubject($subject);

       
        return $this->json(true);
    }
}