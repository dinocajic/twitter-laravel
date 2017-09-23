<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Twitter;

class TwitterController extends Controller
{
    public function index() {
        $twitter_model = new Twitter();

        //$twitter['timeline_tweets']   = $this->twitter_model->get_tweets_from_timeline(1, false);
        //$twitter['search_for_tweets'] = $this->twitter_model->search_for_tweets("dinocajic");
        //$twitter['account_settings']  = $this->twitter_model->get_account_settings();
        //$twitter['get_user_tweets']   = $this->twitter_model->get_user_tweets("dinocajic", 2);
        $twitter['retweets_of_me']    = $twitter_model->get_retweets_of_me(10);
        $twitter['user_info']         = $twitter_model->get_user_info_by_id(1313798149);

        $twitter['title']         = 'Twitter API Test';
        $twitter['description']   = 'Use the Twitter API in Laravel';

        return view('twitter.twitter', compact('twitter'));
    }
}
