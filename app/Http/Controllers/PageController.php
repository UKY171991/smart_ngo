<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\News;
use App\Models\Activity;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function campaigns()
    {
        $campaigns = Campaign::where('is_active', true)->paginate(9);
        return view('pages.campaigns', compact('campaigns'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function mission()
    {
        return view('pages.mission');
    }

    public function news()
    {
        $news = News::where('is_active', true)->latest()->paginate(10);
        return view('pages.news', compact('news'));
    }

    public function newsDetail($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $recentNews = News::where('id', '!=', $news->id)->where('is_active', true)->latest()->limit(5)->get();
        return view('pages.news-detail', compact('news', 'recentNews'));
    }

    public function privacy()
    {
        return view('pages.policy', ['title' => 'Privacy Policy']);
    }

    public function terms()
    {
        return view('pages.policy', ['title' => 'Terms of Service']);
    }

    public function cookies()
    {
        return view('pages.policy', ['title' => 'Cookie Policy']);
    }
}
