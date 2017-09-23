<?php

namespace App;

include(app_path().'/Api/twitteroauth/autoload.php');

use Illuminate\Database\Eloquent\Model;
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter extends Model {

    /** For establishing a connection to Twitter */
    private $_consumer_key        = '';
    private $_consumer_secret     = '';
    private $_access_token        = '';
    private $_access_token_secret = '';
    private $_connection;
    private $_content;

    /**
     * Twitter constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->establish_connection();
    }

    /**
     * Connect to the Twitter API
     */
    public function establish_connection() {
        $this->_connection = new TwitterOAuth($this->_consumer_key, $this->_consumer_secret, $this->_access_token, $this->_access_token_secret);
        $this->_content = $this->_connection->get("account/verify_credentials");
    }

    /**
     * Post a status update to your Twitter account by providing a status update
     *
     * @param String $status_update
     *
     * @return array
     */
    public function post_tweet($status_update) {
        $status = $this->_connection->post(
            "status/update",
            [
                "status" => $status_update
            ]
        );

        return $status;
    }

    /**
     * Retrieves a specified number of tweets with-or-without replies
     *
     * @param integer $num_of_tweets: Max 200
     * @param boolean $exclude_replies
     *
     * @return array
     */
    public function get_tweets_from_timeline($num_of_tweets, $exclude_replies) {
        $tweets = $this->_connection->get(
            "statuses/home_timeline",
            [
                "count"           => $num_of_tweets,
                "exclude_replies" => $exclude_replies
            ]
        );

        return $tweets;
    }

    /**
     * Returns a list of tweets for a specific username
     *
     * @param String $username
     * @param integer $num_of_tweets: Max 200
     *
     * @return array
     */
    public function get_user_tweets($username, $num_of_tweets) {
        $tweets = $this->_connection->get(
            "statuses/user_timeline",
            [
                "screen_name" => $username,
                "count"       => $num_of_tweets
            ]
        );

        return $tweets;
    }

    /**
     * Returns a list of tweets based on your search parameter
     *
     * @param String $query
     *
     * @return array
     */
    public function search_for_tweets($query) {
        $tweets = $this->_connection->get(
            "search/tweets",
            [
                "q" => $query
            ]
        );

        return $tweets;
    }

    /**
     * Returns a list of tweets where the user's tweets were re-tweeted
     *
     * @param integer $num_of_tweets: Max 200
     *
     * @return array
     */
    public function get_retweets_of_me($num_of_tweets) {
        $tweets = $this->_connection->get(
            "statuses/retweets_of_me",
            [
                "count" => $num_of_tweets
            ]
        );

        return $tweets;
    }

    /**
     * Returns your account settings
     *
     * @return array
     */
    public function get_account_settings() {
        $settings = $this->_connection->get(
            "account/settings"
        );

        return $settings;
    }

    /**
     * Returns user details by specifying their user's id
     *
     * @param int $users_id
     *
     * @return array
     */
    public function get_user_info_by_id($users_id) {
        $user_info = $this->_connection->get(
            "users/lookup",
            [
                "user_id" => $users_id
            ]
        );

        return $user_info;
    }
}
