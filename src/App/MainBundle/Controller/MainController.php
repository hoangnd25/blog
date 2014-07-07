<?php

namespace App\MainBundle\Controller;

use App\UserBundle\Entity\History;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MainController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        /**
         * @var EntityManager $em
         */
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb
            ->select('h')
            ->from('AppUserBundle:History', 'h')
            ->orderBy('h.year','desc')
        ;
        $query = $qb->getQuery();
        $history = $query->getResult(Query::HYDRATE_ARRAY);

        $workHistory = array();
        $educationHistory = array();
        foreach($history as $h){
            if ($h['type'] == History::EDUCATION){
                $educationHistory[] = $h;
            }else{
                $workHistory[] = $h;
            }
        }

        $qb = $em->createQueryBuilder();
        $qb
            ->select('pd')
            ->from('AppUserBundle:PersonalDetail', 'pd')
        ;
        $query = $qb->getQuery();
        $personalDetails = $query->getResult(Query::HYDRATE_ARRAY);
        $transformedPersonalDetails = array();
        foreach($personalDetails as $pd){
            $transformedPersonalDetails[$pd['key']] = $pd['value'];
        }

        $qb = $em->createQueryBuilder();
        $qb
            ->select('s')
            ->from('AppUserBundle:Skill', 's')
            ->orderBy('s.level','desc')
        ;
        $query = $qb->getQuery();
        $skills = $query->getResult(Query::HYDRATE_ARRAY);

        return array(
            'workHistory'=>$workHistory,
            'educationHistory'=>$educationHistory,
            'personalDetails' => $transformedPersonalDetails,
            'skills' => $skills
        );
    }
}
