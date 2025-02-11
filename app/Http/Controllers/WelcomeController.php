<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Mailbox',
            'list' => ['Home']
        ];
        $page = (object) [
            'title' => 'Homepage'
        ];
        $activeMenu = 'home';
        $activeSubMenu = 'inbox';
        return view('dashboard', ['breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu,
            'activeSubMenu' => $activeSubMenu
        ]);
    }
}
