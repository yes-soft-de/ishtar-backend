<?php





namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaintingTransactionController extends AbstractController
{
    private $CUDService;

    public function __construct(CreateUpdateDeleteServiceInterface $CUDService)
    {
        $this->CUDService = $CUDService;
    }

    /**
     * @Route("/createPaintingTransaction", name="createPaintingTransaction")
     * @param Request $request
     */
    public function create(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->create($request, "PaintingTransaction");
        return $result;
    }

    /**
     * @Route("/updatePaintingTransaction", name="updatePaintingTransaction")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->update($request, "PaintingTransaction");
        return $result;
    }

    /**
     * @Route("/deletePaintingTransaction", name="deletePaintingTransaction")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->delete($request, "PaintingTransaction");
        return $result;
    }
}
