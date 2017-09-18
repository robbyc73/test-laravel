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
     * @param $id
     * @return mixed
     */
    public function getPost($session, $id)
    {
        if (!$session->has('posts')) {
            $this->createDummyData();
        }
        return $session->get('posts')[$id];
    }

    /**
     * @param $session
     * @param $title
     * @param $content
     */
    public function addPost($session, $title, $content)
    {
        if (!$session->has('posts')) {
            $this->createDummyData();
        }
        $posts = $session->get('posts');
        array_push($posts, ['title' => $title, 'content' => $content]);
        $session->put('posts', $posts);
    }

    /**
     * @param $session
     * @param $id
     * @param $title
     * @param $content
     */
    public function editPost($session, $id, $title, $content)
    {
        $posts = $session->get('posts');
        $posts[$id] = ['title' => $title, 'content' => $content];
        $session->put('posts', $posts);
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