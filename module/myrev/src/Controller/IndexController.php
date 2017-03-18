<?php

namespace myrev\Controller;

use myrev\Model\ReviewTable;
use myrev\Model\UserTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $userTable;
    private $reviewTable;

    public function __construct(UserTable $userTable, ReviewTable $reviewTable)
    {
        $this->userTable = $userTable;
        $this->reviewTable = $reviewTable;
    }

    public function indexAction()
    {
        return new ViewModel([
            'user' => $this->userTable->getUser(1),
            'review' => $this->reviewTable->getReview(1)
    ]);
    }
}
