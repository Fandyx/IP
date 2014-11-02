<?php

App::uses('AppController', 'Controller');

/**
 * Areas Controller
 *
 * @property Area $Area
 * @property PaginatorComponent $Paginator
 */
class HomeController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->layout = "home";
        if (!AppController::checkAuth()) {

            $this->render();
        } else {
            $this->redirect("../Usuarios");
        }
    }

    public function terms() {
        $this->layout = "terms";

        $this->render();
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
}
