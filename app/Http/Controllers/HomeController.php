<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Qualification;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;

class HomeController extends Controller
{
    public function __invoke()
    {
        $user = User::select(
            'id',
            'name',
            'email',
            'phone',
            'address',
            'job',
            'degree',
            'profile_pic',
            'birth_day',
            'experience'
        )->where('id', 1)->first();

        $experiences = Qualification::where('type', 'Work')
            ->orderBy('id', 'desc')
            ->get();

        $educations = Qualification::where('type', 'Education')
            ->orderBy('id', 'desc')
            ->get();

        $skills = Skill::orderBy('id', 'desc')->get();
        $services = Service::take(6)->get();
        $categories = Category::all();
        $reviewers = Review::orderBy('id', 'desc')->get();
        $portfolios = Portfolio::with('category')->orderBy('id', 'desc')->get();

        // SAFE fallback (VERY IMPORTANT)
        $setting = Setting::first() ?? new Setting();

        return view('home', compact(
            'user',
            'experiences',
            'educations',
            'skills',
            'services',
            'categories',
            'portfolios',
            'setting',
            'reviewers'
        ));
    }
}