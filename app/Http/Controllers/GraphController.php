<?php

namespace Library\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use League\Flysystem\Exception;
<<<<<<< HEAD:app/Http/Controllers/GraphController.php
use Library\Album;
use Library\Photo;
=======
use Library\Author;
>>>>>>> 629fd088986786839b8a161fc7fc82e04ad2a49f:app/Http/Controllers/AuthorsController.php
use Library\Http\Requests;
use Library\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AlbumsController extends Controller
{
    /**
     * Get list of Albums in order by alphabet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $album = new Album();
        return view('albums', ['albums' => $album->getAllAlbums()]);
    }

    /**
     * Get new Album from request and store it to DB
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $album = new Album();
        try {
<<<<<<< HEAD:app/Http/Controllers/GraphController.php
            $album->addAlbum($request->input('album'));
=======
            $author->addAuthor($request->input('author'));
>>>>>>> 629fd088986786839b8a161fc7fc82e04ad2a49f:app/Http/Controllers/AuthorsController.php
            return Redirect::back();
        } catch (Exception $e) {
            echo 'Sorry, something going wrong';
        }
    }

    /**
     * Delete Album and all his Photos
     * @param Request $request
     * @return string
     */
    public function deleteAlbum(Request $request)
    {
<<<<<<< HEAD:app/Http/Controllers/GraphController.php
        $album = new Album();
        try {
            $album->deleteAlbum($request->input('deleteSubject'));
=======
        $author = new Author();
        try {
            $author->deleteAuthor($request->input('deleteSubject'));
>>>>>>> 629fd088986786839b8a161fc7fc82e04ad2a49f:app/Http/Controllers/AuthorsController.php
            $afterDelete = ['result' => true];
        } catch (Exception $e) {
            $afterDelete = ['result' => false];
        }
        return json_encode($afterDelete);
    }

}
