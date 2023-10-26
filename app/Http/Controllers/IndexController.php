<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Blog, Category, Feedback, Faq, Service, ChooseUs, AdditionalService, File, Event, CaseStudy, CaseCategory};

class IndexController extends Controller
{
    public function index()
    {
        $addServices = AdditionalService::where('is_active', 1)->orderBy('id', 'desc')->with('image')->get();
        $chooseUs = ChooseUs::get();
        $services = Service::where('is_active', 1)->where('is_featured', 1)->orderBy('id', 'desc')->with('image')->latest()->take(2)->get();
        $blogs = Blog::where('is_active', 1)->where('is_featured', 1)->orderBy('id', 'desc')->with('image')->latest()->take(5)->get();
        foreach ($blogs as $blog) {
            $ids = json_decode($blog->category_id);
            $categories = Category::whereIn('id', $ids)->get();
            $blog->categories = $categories;
        }
        $feedbacks = Feedback::where('is_active', 1)->get();
        $iamgesAll = File::get();
        $images = $iamgesAll->chunk(ceil($iamgesAll->count() / 2));
        $faqData = Faq::where('is_active', 1)->get();
        $faqs = $faqData->chunk(ceil($faqData->count() / 2));
        return view('dashboard.index')->with('title', 'Home')->with(compact('feedbacks', 'faqs', 'chooseUs', 'addServices', 'services', 'blogs', 'images'));
    }
    public function about()
    {
        return view('dashboard.about-us')->with('title', 'About Us');
    }
    public function blog()
    {
        $categoriesAll = Category::get();
        $blogs = Blog::where('is_active', 1)->orderBy('id', 'desc')->with('image')->get();
        foreach ($blogs as $blog) {
            $ids = json_decode($blog->category_id);
            $categories = Category::whereIn('id', $ids)->get();
            $blog->categories = $categories;
        }
        return view('dashboard.blog')->with('title', 'Blog')->with(compact('blogs', 'categories', 'categoriesAll'));
    }
    public function blogInner($slug)
    {
        $blogs = Blog::where('is_active', 1)->where('is_featured', 1)->orderBy('id', 'desc')->with('image')->latest()->take(3)->get();
        $blogDetail = Blog::where('slug', $slug)->orderBy('id', 'asc')->with('detailImage')->first();
        return view('dashboard.blog-inner')->with('title', 'Blog Inner')->with(compact('blogDetail', 'blogs'));
    }
    public function capabilityStatement()
    {
        return view('dashboard.capability-statement')->with('title', 'Capability Statement');
    }
    public function caseStudy()
    {
        $caseCategories = CaseCategory::get();
        $caseStudies = CaseStudy::where('is_active', 1)
            ->orderBy('id', 'desc')
            ->with('image')
            ->get();
        $all = CaseStudy::where('is_active', 1)
            ->orderBy('id', 'desc')
            ->with('image')
            ->get();
        return view('dashboard.case-study')
            ->with('title', 'Case Study')
            ->with(compact('caseStudies', 'caseCategories', 'all'));
    }
    public function caseInner($slug)
    {
        $caseStudies = CaseStudy::where('slug', $slug)->orderBy('id', 'desc')->with('image')->first();
        return view('dashboard.case-inner')->with('title', $caseStudies->title)->with(compact('caseStudies'));
    }
    public function contact()
    {
        return view('dashboard.contact-us')->with('title', 'Contact Us');
    }
    public function eventPage()
    {
        $events = Event::where('is_active', 1)->orderBy('id', 'desc')->with('image')->get();
        return view('dashboard.event-page')->with('title', 'Event Page')->with(compact('events'));
    }
    public function projectHeimdall()
    {
        return view('dashboard.project-heimdall')->with('title', 'Project Heimdall');
    }
    public function quiz()
    {
        return view('dashboard.quiz')->with('title', 'Quiz');
    }
    public function service()
    {
        $services = Service::where('is_active', 1)->orderBy('id', 'desc')->with('image')->get();
        return view('dashboard.service-main')->with('title', 'Service')->with(compact('services'));
    }
    // public function servicePage($slug){
    //     $service  = Service::where('slug',$slug)->orderBy('id','asc')->first();
    //     return view('dashboard.service-page-2')->with('title','Service Page')->with(compact('service'));
    // }
    public function servicePage()
    {
        return view('dashboard.service-page-2')->with('title', 'Service Page');
    }
    public function servicePageOne()
    {
        return view('dashboard.service-page-1')->with('title', 'Service Page');
    }
}