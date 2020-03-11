<?php

namespace App\Controller;



use App\AutoMapping;
use App\Request\CreateArtistRequest;
use App\Request\UpdatePaintingThumbImageRequest;
use App\Response\GetPaintingsResponse;
use App\Service\HealthCheckService;
use App\Service\ImagePathResolverService;
use App\Service\PaintingService;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Service\FilterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Validator\Constraints\Json;

class Controller extends AbstractController
{

    /**
     *@Route("/testpath")
     */
    public function testPath(FilterService $filterService, Request $request )
    {

       // $resolvedPath = $filterService->getUrlOfFilteredImage("http://dev-ishtar.96.lt/ImageUploads/PaintingImages/2019-11-07_15-53-27/03_Bashar_Barazi-5dc43df7c181f.jpeg",
        //    'thumb');
        $resolvedPath = $request->getLocale();
        return new JsonResponse(["done: " => $resolvedPath], 200);
    }

    /**
     * @Route("/k", name="k", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function hi(Request $request, FilterService $filterService, AutoMapping $autoMapping, PaintingService $paintingService)
    {
        $session = $this->get('session');
        $session->setLocale($request->getPreferredLanguage(array('de', 'en')));

        //$paintings = $paintingService->getPaintingById(175);
        $body = $request->getContent();
        $data = json_decode($body, true);


        /**
         * @var $painting GetPaintingsResponse
         */
        //foreach ($paintings as $painting)
        //{
        //get image path
        $imagePath = $data['thumbImage'];

        //fix pat
        //$path = explode('http://ishtar-art.de/ImageUploads/', $imagePath);
        $path = explode('F:/YesSoft/', $imagePath);

        // $output->writeln($path[1]);
        //change path to save

        //resolve image
        $resolvedImage = $filterService->getUrlOfFilteredImage($path[1], 'my');
       // dd($resolvedImage);
        //save new image path to DB
        $request = $autoMapping->map(\stdClass::class,UpdatePaintingThumbImageRequest::class,(object)$data);
        $request->setId(175);
        $request->setThumbImage($resolvedImage);

        $result = $paintingService->updatePaintingThumbImage($request);

        return new JsonResponse(['k'=> $result]);

    }
    /**
     * @Route("/m", name="m")
     */
    public function index(ImagePathResolverService $how, FilterService $imagine, CacheManager $resolver)
    {
        //$path = 'https://upload.wikimedia.org/wikipedia/commons/5/57/PT05_ubt.jpeg';
        $path = 'assets/images/to.jpg';

       // $resourcePath = $imagine->getUrlOfFilteredImage($path, 'my');
            $how->setNewPath('itWORK');
         $resolvedPath = $imagine->getUrlOfFilteredImage('ImageUploads/assets/images/j.jpg', 'thumb');
       // $resolver->()getBrowserPath()store($resolvedPath, "newPATH", "my");

        return $this->json([
            'message' => 'IS '. $resolvedPath,
            'path' => 'src/Controller/Controller.php',
        ]);
    }

    /**
     * @Route("headers", name="pre/flight",methods="GET")
     */
    public function getHeaders()
    {
        $resultResponse = new Response("STATE_OK", Response::HTTP_OK, ['content-type' => 'application/json']);
        $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
        $resultResponse->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $resultResponse->headers->set('Access-Control-Allow-Headers', 'DNT,User-Agent,X-Requested-With, If-Modified-Since, Cache-Control, Content-Type,Range, Authorization');
        $resultResponse->headers->set('Access-Control-Max-Age', 1728000);
        // $resultResponse->headers->set('Content-Length', 0);
        $resultResponse->headers->set('Content-Type', 'text/plain; charset=utf-8');
        return $resultResponse;
    }

    /**
     * @Route("/health-check", name="healthCheck", methods = "POST")
     */
    public function healthCheck(HealthCheckService $healthCheck)
    {
        try
        {
            $healthCheck->healthCheck();

            return new JsonResponse(["status" => "ok"], Response::HTTP_OK);
        }
        catch (\Exception $exception)
        {
            return new JsonResponse(["status" => "not ok", "exception" =>$exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}

