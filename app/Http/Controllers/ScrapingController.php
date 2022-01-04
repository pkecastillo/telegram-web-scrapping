<?php

namespace App\Http\Controllers;

use Goutte\Client;
use App\Post;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class ScrapingController extends Controller{

    public function scraping(Client $client){

        // Para extraer por pagina
        for ($i=1; $i <=3 ; $i++) {
        $crawler = $client->request('GET', "https://www.computrabajo.com.ar/trabajo-de-desarrollador-en-mendoza?p1=$i");
        $this->extractPosts($crawler);
        }
        // Para extraer solo la primera pagina
        // $crawler = $client->request('GET', "https://www.computrabajo.com.ar/trabajo-de-desarrollador-en-mendoza");
        // $this->extractPosts($crawler);
        return back();
    }

    public function extractPosts(Crawler $crawler){
    //  dd($crawler);

    // Get the latest post in this category and display the titles
        $crawler->filter('article')->each(function (Crawler $node) {


            $title = $node->filter("[class='js-o-link fc_base']")->first()->text();
            $location = $node->filter("[class='fs16 fc_base mt5 mb10']")->first()->text();
            $description = $node->filter("[class='fc_aux t_word_wrap mb10 hide_m']")->first()->text();
            $url = $node->filter("[class='js-o-link fc_base']")->first()->attr('href');

            // Datos analizados del HTML del sitio a scrapear
            // title <a class="js-o-link fc_base"
            // <p class="fs16 fc_base mt5 mb10">
            // <p class="fc_aux t_word_wrap mb10 hide_m">
            // <h1 class="fs18 fwB"><a class="js-o-link fc_base" href=

            Post::create([
                'title' => $title,
                'location' => $location,
                'description' => $description,
                'url' => "https://www.computrabajo.com.ar".$url,
            ]);
        });
    }
}
