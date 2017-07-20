<?php

namespace App\Controllers;

use App\Models\DB;
use App\Services\VnExpressCrawler;
use App\Views\JsonView;
use App\Views\View;

class HomeController
{
    private $crawler;

    public function __construct()
    {
        $this->crawler = new VnExpressCrawler();
    }

    public function index()
    {
        $message =  array('Hello', 'Thuan Pham');
        View::render('home/index', $message);
    }

    public function news()
    {
        $data = $this->crawler->crawler();
        View::render('home/news', $data);
    }

    public function apiStaff()
    {
        $data = DB::getAll('staff');
        JsonView::render($data);
    }

    public function apiStaffById($id)
    {
        $message = array();
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($id)) {
            $data = DB::getById('staff', $id);
            JsonView::render($data);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($id)) {
            $up = DB::updateData($id);
            $message[] = $up;
            View::render('home/message', $message);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($id)) {
            $del = DB::deleteData($id);
            $message[] = $del;
            View::render('home/message', $message);
        } else {
            $message[] = "Method khong hop le";
            View::render('home/message', $message);
        }
    }

    public function addStaff()
    {
        $message = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $add =DB::insertData('staff');
            $message[] = $add;
        } else {
            $message[] = "Method khong hop le";
        }
    View::render('home/message', $message);

    }

    public function errorNotFind ()
    {
        $message = array('404', 'Not find');
        View::render('home/message', $message);
    }
}