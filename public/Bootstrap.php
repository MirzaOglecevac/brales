<?php

//Imports
use Symfony\Component\DependencyInjection;
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\FileLocator;

class Bootstrap
{

    public function handle($request,$config,$ipRange)
    {
        // get configuration files location
        $locator = new FileLocator(__DIR__ . '/../config');
        // DI container
        $container = new DependencyInjection\ContainerBuilder;
        $loader = new DependencyInjection\Loader\YamlFileLoader($container, $locator);
        $loader->load($config);
        $container->compile();
        // routing
        $loader = new Routing\Loader\YamlFileLoader($locator);
        $context = new Routing\RequestContext();
        $context->fromRequest($request);
        $matcher = new Routing\Matcher\UrlMatcher(
            $loader->load('routing.yml'),
            $context
        );
        try{
            $parameters = $matcher->match($request->getPathInfo());
            foreach ($parameters as $key => $value) {
                $request->attributes->set($key, $value);
            }
            $command = $request->getMethod() . $request->get('action');
            $resource = "controller.{$request->get('controller')}";
            $controller = $container->get($resource);
            $data = $controller->{$command}($request);
        }catch(\Error $e){
            $data = [
                'status'=>404,
                'message'=>'Not found 1',
                'info'=>$e->getMessage()
            ];
        }catch(\Symfony\Component\Routing\Exception\MethodNotAllowedException $e){
            $data = [
                'status'=>404,
                'message'=>'Not found 2',
                'info'=>$e->getMessage()
            ];
        }catch(ResourceNotFoundException $e){
            $data = [
                'status'=>404,
                'message'=>'Not found 3',
                'info'=>$e->getMessage()
            ];
        }

        // check if json in array from
        if(is_array($data)){
            // helper response
            $responseData = $data;
            // remove status and message
            if(isset($responseData['status'])){
                unset($responseData['status']);
                // if message exsists
                if(isset($responseData['message'])){
                    unset($responseData['message']);
                }
            }
            // check if array empty
            if(!empty($responseData)){
                // with json response
                $response = new JsonResponse($responseData);
            }
            else{
                // no json response
                $response = new Response;
            }
            //Set custom headers
            $response->setStatusCode(
                (int)$data['status'],
                isset($data['message']) ? $data['message'] : null
            );
        }
        // if not array
        else{
            $response = new Response($data);
        }

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,HEAD,OPTIONS,POST,PUT,DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, Authorization');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        // send reponse
        $response->send();
        return $response;
    }

}