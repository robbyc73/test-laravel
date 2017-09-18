<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 18/09/17
 * Time: 8:40 PM
 */

namespace App;


use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class Post
 * @package App
 */
class Post
{
    /**
     * @param $session
     * @return mixed
     */
    public function getPosts($session)
    {
        if (!$session->has('posts')) {
            $this->createDummyData($session);
        }
        return $session->get('posts');
    }

    /**
     * @param $session
     */
    private function createDummyData($session)
    {
        $posts = [
            [
                'title' => 'Learning Laravel',
                'content' => 'This blog post will get you right on track with Laravel!'
            ],
            [
                'title' => 'Something else',
                'content' => 'Some other content'
            ]
        ];
        $session->put('posts', $posts);
    }
}