<?php


namespace App\Service;

 use Symfony\Component\HttpFoundation\Request;

 interface CommentServiceInterface
{
     public function create ($request);
     public function update( $request);
     public function delete( $request);
     public function getEntityComment($request);
     public function getClientComment($request);
     public function getAll();
     public function setSpacial($request);
}