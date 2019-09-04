<?php

namespace App\Manager;

use Symfony\Component\HttpFoundation\Request;

interface CreateUpdateDeleteManagerInterface
{

    public function create(Request $request, $entity);

    public function update(Request $request, $entity);

    public function delete(Request $request, $entity);

}