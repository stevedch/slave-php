<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $redis = $this->get('snc_redis.default');
        $redis->set('foo', 'bars');
        $top20 = $redis->zrevrange('leaderboard', 0, 20, 'WITHSCORES');
        $canSet = $redis->set('exclusive:onehour', 2, 'NX', 'EX', 3600);


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => 1,
        ]);
    }
}
