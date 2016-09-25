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

        $em = $this->getDoctrine()->getManager();
        $count = $em->getRepository('SimpleLotteryBundle:Participant')->count();

        if ($form->isSubmitted() && $form->isValid()) {

            // save the User
            $em->persist($participant);
            $em->flush();

            return $this->redirect($this->generateUrl(
                'simple_lottery_thankyou'
            ));
        }

        return $this->render("SimpleLotteryBundle:SimpleLottery:form.html.twig", array(
            'form' => $form->createview(),
            'count' => $count
        ));
    }

    public function createWinnerAction()
    {
        $winner="";

        $em = $this->getDoctrine()->getManager();
        $count = $em->getRepository('SimpleLotteryBundle:Participant')->count();

        if ($count>0){
            $winner = $this->get('lottery.winner');
            $winner = $winner->createRandomWinner();
        }

        return $this->render("SimpleLotteryBundle:SimpleLottery:winner.html.twig", array(
                'nickName' => $winner,
                'count' => $count
            )
        );
    }
}

