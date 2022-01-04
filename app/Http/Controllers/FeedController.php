<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Post;
use Illuminate\Support\Facades\URL;

class FeedController extends Controller
{
    public function rssFeed() {
        $feed = App::make("feed");
        $posts = Post::where('is_published', true)->orderBy('updated_at', 'desc')->get();

       // set your feed's title, description, link, pubdate and language
       $feed->title = 'Your title';
       $feed->description = 'Your description';
       $feed->logo = 'http://yoursite.tld/logo.jpg';
       $feed->link = url('feed');
       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
       $feed->pubdate = $posts[0]->created_at;
       $feed->lang = 'es';
       $feed->setShortening(true); // true or false
       $feed->setTextLimit(100); // maximum length of description text

       foreach ($posts as $post)
       {
           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add(
               $post->title,
               $post->location,
               URL::to($post->url),
               $post->created,
               $post->description
            );
       }
       return $feed->render('atom');
    }
}
