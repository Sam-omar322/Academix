<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        // $n_of_books = Book::all()->count();
        // $n_of_publishers = Publisher::all()->count();
        // $n_of_authors = Author::all()->count();
        // $n_of_categories = Category::all()->count();
        return view("admin.index");
    }
}
