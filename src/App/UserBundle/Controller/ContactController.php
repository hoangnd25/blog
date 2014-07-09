<?php

namespace App\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContactController extends Controller
{
    /**
     * @Route("send-message")
     * @Template()
     */
    public function sendMessageAction()
    {
//        ladybug_dump_die($this->getRequest()->getMethod());
        if($this->getRequest()->getMethod() === 'POST'){
            $name = $this->getRequest()->get('name');
            $email = $this->getRequest()->get('email');
            $message = $this->getRequest()->get('message');
            $humanTest = $this->getRequest()->get('human-test');

            if(!($name & $email & $message & $humanTest)){
                $this->get('session')->getFlashBag()->add('error','Please fill out all the required fields');
                return $this->redirect($this->generateUrl('index').'#contact');
            }

            if(intval($humanTest) != intval($this->get('session')->get('human-test-number'))){
                $this->get('session')->getFlashBag()->add('error','You failed the human test');
                return $this->redirect($this->generateUrl('index').'#contact');
            }

            try{
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact form: '.$name.' - '.$email)
                    ->setFrom('contact@hoangnd.me')
                    ->setTo('contact@hoangnd.me')
                    ->setBody(
                        $message
                    )
                ;
                $this->get('mailer')->send($message);
            }catch (\Exception $e){
                $this->get('session')->getFlashBag()->add('error','Failed: '+ $e->getMessage());
                return $this->redirect($this->generateUrl('index').'#contact');
            }

            $this->get('session')->getFlashBag()->add('success','Message sent successfully');

        }else{
            $this->get('session')->getFlashBag()->add('error','Action is not allowed');
        }
        return $this->redirect($this->generateUrl('index').'#contact');
    }

    /**
     * @Route("_internal/human-test")
     * @Template()
     */
    public function humanTestAction(){
        $firstNumber = rand ( 1 , 25 );
        $secondNumber = rand ( 1 , 25 );
        $total = $firstNumber + $secondNumber;
        $this->get('session')->set('human-test-number',$total);
        return array(
            'first' => $firstNumber,
            'second' => $secondNumber
        );
    }
}
