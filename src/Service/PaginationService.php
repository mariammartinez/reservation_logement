<?php

namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class PaginationService {

    private $entityClass;
    private $limit = 10;
    private $currentPage = 1;
    private $manager;
    private $twig;
    private $route;
    private $templatePath;

    public function __construct(ManagerRegistry $manager, Environment $twig, RequestStack $request, $templatePath) {
       $this->route = $request->getCurrentRequest()->attributes->get('_route');

        $this->manager = $manager->getManager();
        $this->twig = $twig;
        $this->templatePath = $templatePath;
    }

    public function setTemplatePath($templatePath){
        $this->$templatePath = $templatePath;
        return $this;
    }
    Public function getTemplatePath() {
        return $templatePath;
    }

    public function setRoute($route) {
        $this->route = $route;

        return $this;
    }

    Public function getRoute() {
        return $route;
    }

    public function display(){
        $this->twig->display($this->templatePath, [
            'page' => $this->currentPage,
            'pages' => $this->getPages(),
            'route' => $this->route
            ]);
    }


    public function getPages() {
        //total d'enregistrement
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());

        //division
        $pages = ceil($total / $this->limit);

        return $pages;
    }

    public function getData(){
        //calculer l'offset
        $offset = $this->currentPage * $this->limit - $this->limit;

        //repo de trouver  les ele
        $repo = $this->manager->getRepository($this->entityClass);
        $data = $repo->findBy([], [], $this->limit, $offset);
        //renvoyer les ele
        return $data;
    }

    public function setPage($page) {
        $this->currentPage = $page;
        return $this;
    }

    public function getPage() {
        return $this->currentPage;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }
    public function getLimit() {
        return $this->limit;
    }

    public function setEntityClass($entityClass){
        $this->entityClass = $entityClass;
        return $this;
    }

    public function getEntityClass(){
        return $this->entityClass;
    }
}