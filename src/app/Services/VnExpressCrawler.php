<?php

namespace App\Services;

use Goutte\Client;

class VnExpressCrawler
{
    public function crawler()
    {
        $client  = new Client();
        $crawler = $client->request('GET', 'http://vnexpress.net/tin-tuc/thoi-su/ap-thap-nhiet-doi-kha-nang-thanh-bao-huong-hai-phong-nghe-an-3613765.html');


        $data['title'] = $crawler->filterXPath('//*[@id="box_details_news"]/div/div/div[1]/div[1]/div[3]/h1')->text();
        $data['content'] = $crawler->filterXPath('//*[@id="left_calculator"]/div[1]')->html();

        return $data;
    }
}
