<?php

namespace Library;

use DB;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function authors()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getBooksByAuthor($id)
    {
        return DB::table('books')->where(['author_id' => $id])->get();
    }

    /**
     * Add new book to author
     * @param $paramsBook
     * @return mixed
     */
    public function addBook($paramsBook)
    {
        return DB::table('books')->insert(
            [
                'books_title' => $paramsBook['title'],
                'books_subtitle' => $paramsBook['subtitle'],
                'books_isbn' => $paramsBook['isbn'],
                'author_id' => $paramsBook['authorId'],
            ]
        );
    }

    /**
     * Delete book from author
     * @param $id
     * @return mixed
     */
    public function deleteBook($id)
    {
        return DB::table('books')->where(['books_id' => $id])->delete();
    }

}
