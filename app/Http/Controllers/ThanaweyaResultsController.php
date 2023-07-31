<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ThanaweyaResultsController extends Controller
{
    public function getNatega(Request $request)
    {
        $seatingNo = $request->input('seating_no');

        $urls = [
            "Youm7" => "https://natega.youm7.com/Home/Result",
            "Dostor" => "https://natega.dostor.org/Home/Result",
            "Elbalad" => "https://natega.elbalad.news/Home/Result",
            "ElFagr" => "https://natega.elfagr.org/Home/Result",
            "ElWatan" => "https://natega.elwatannews.com/Home/Result",
        ];

        foreach ($urls as $site => $url) {
            $response = Http::asForm()->post($url, ['seating_no' => $seatingNo]);

            if ($response->ok()) {
                break;
            }
        }

        if (!$response->ok()) {
            return response()->json(['error' => 'Result not found'], 404);
        }

        $content = $response->body();
        $crawler = new Crawler($content);
        $student = $crawler->filter('div.full-result');
        $summary = $crawler->filter('li.col.resultItem');
        $info = $student->filter('ul#pills-tab li');

        $data = [
            "name" => $info->eq(0)->filter('span')->eq(1)->text(),
            "marks" => $summary->eq(1)->filter('h1')->text(),
            "percentage" => $summary->eq(2)->filter('h1')->text(),
            "school" => $info->eq(1)->filter('span')->eq(1)->text(),
            "state" => $info->eq(4)->filter('span')->eq(1)->text(),
            "dept" => $info->eq(5)->filter('span')->eq(1)->text(),
        ];

        return response()->json($data);
    }
}