<?php

    namespace Roots\ParentTheme\Classes;

    class Instagram {

        private $_userId;
        private $_accessToken;

        /**
         * Class constructor, expects a Instagram user id and access token.
         * @param $userId
         * @param $accessToken
         */
        public function __construct($userId, $accessToken) {
            $this->_userId = $userId;
            $this->_accessToken = $accessToken;
        }

        /**
         * Get the user feed, and return it as an array.
         * @return array
         */
        public function getFeed() {

            $data = $this->getDataObject();

            $feed = array();

            if ( !empty($data) && is_array($data) ) {
                $i = 0;
                foreach ($data as $post) {
                    $feed[$i]['id'] = $post->id;
                    $feed[$i]['created_time'] = $post->created_time;
                    $feed[$i]['image_standard'] = $post->images->standard_resolution->url;
                    $feed[$i]['image_thumbnail'] = $post->images->thumbnail->url;
                    $feed[$i]['caption'] = ( !empty($post->caption->text) ? $post->caption->text : '' );
                    $i++;
                }
            }
            return $feed;
        }

        /**
         * Use cURL to fetch the user feed.
         * @param $url
         * @return mixed
         */
        private function fetchData($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

        /**
         * Returns the user feed as an object.
         * @return bool
         */
        private function getDataObject() {

            $url = "https://api.instagram.com/v1/users/".$this->_userId."/media/recent/?access_token=".$this->_accessToken;
            $result = $this->fetchData($url);
            if ( !empty($result) ) {
                $result = json_decode($result);
                return $result->data;
            }
            return false;
        }

    }