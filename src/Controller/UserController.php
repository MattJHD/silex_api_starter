<?php

namespace Controller;

use Model\User;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    /**
     * Get all users in Db.
     *
     * @param Request     $request
     * @param Application $app
     *
     * @return JsonResponse
     */
    public function cgetAction(Request $request, Application $app)
    {
        $sql = 'SELECT * FROM users';
        $dataDb = $app['db']->fetchAll($sql);

        $users = array_map(function ($arrayUser) {
            $user = new User();

            return $user->fill($arrayUser);
        }, $dataDb);
//        dump(gettype($users));
//        die();

        //return new JsonResponse($app['serializer']->serialize($users, 'json'), 200, [], true);
        return new Response($app['serializer']->serialize($users, 'json'));
    }
    
//    public function cgetAction(Request $request, Application $app)
//    {
//        $sql = 'SELECT * FROM users';
//        $dataDb = $app['db']->fetchAll($sql);
//
//
//            $user = $app['serializer']->serialize($dataDb, 'json');
//
//        return new Response($user);
//    }

    /**
     * Get a specific user.
     *
     * @param Request     $request
     * @param Application $app
     *
     * @return JsonResponse
     */
    public function getAction(Request $request, Application $app)
    {
        $id = (int) $request->get('id');
        $sql = 'SELECT * FROM users WHERE id = ?';
        $dataDb = $app['db']->fetchAssoc($sql, [$id]);

        if (!$dataDb) {
            return new JsonResponse('User not found.', 404);
        }

        $user = new User();
        $user = $user->fill($dataDb);

        return new JsonResponse($app['serializer']->serialize($user, 'json'), 200, [], true);
    }
    
    public function postAction(Request $request, Application $app)
    {
        $jsonData = $request->getContent();
        $user = $app['serializer']->deserialize($jsonData, User::class, 'json');
//        dump($user->getTitle());
//        die();
        $sql = 'INSERT INTO users (title, login, is_group)'
                . 'VALUES ("'.$user->getTitle().'","'.$user->getLogin().'","'.$user->getIs_group().'");';
    
        $statement = $app['db']->prepare($sql);
        $result = $statement->execute();
        
        if (!$jsonData) {
            return new JsonResponse('Error.', 404);
        }
        return new JsonResponse($result);
    }
}
