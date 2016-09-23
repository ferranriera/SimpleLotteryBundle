<?php

namespace SimpleLotteryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use SimpleLotteryBundle\Entity\Participant;
use SimpleLotteryBundle\Form\ParticipantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParticipantController extends Controller
{
    public function addParticipantAction(Request $request)
    {
        // build the form
        $participant = new Participant();
        $form = $this->createForm(new ParticipantType(), $participant);

        // handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // save the User
            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

            return $this->redirect($this->generateUrl(
                'simple_lottery_thankyou'
            ));
        }

        return $this->render("SimpleLotteryBundle:SimpleLottery:form.html.twig", array(
            'form' => $form->createview()
        ));
    }

    public function createWinnerAction()
    {
        //TODO: Do it random
        $query = $this->getDoctrine()->getEntityManager()->createQueryBuilder();
        $query
            ->select(array('d.id'))
            ->from('SimpleLotteryBundle:Participant', 'd');

        //if
        $results = $query->getQuery()->getResult();
        $winnerId = $results[array_rand($results,1)];

        $participant = $this->getDoctrine()
            ->getRepository('SimpleLotteryBundle:Participant')
            ->find($winnerId);


        return $this->render("SimpleLotteryBundle:SimpleLottery:winner.html.twig", array(
                'nickName' => $participant->nickName,
            )
        );
    }
}

