<?php

namespace TeamBuilder\controller;

class HomeController
{

    /**
     * Go to the home page.
     */
    public function home()
    {
        require_once 'src/TeamBuilder/views/home.php';
    }
}
