<?php

namespace App\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogController extends Controller
{
    /**
     * @Route("/blog/{id}")
     * @Template()
     */
    public function indexAction($id)
    {
        $repo = $this->getDoctrine()->getRepository("AppBlogBundle:Post");
        $blog = $repo->find($id);
        return array('blog'=> $blog);
    }
}
