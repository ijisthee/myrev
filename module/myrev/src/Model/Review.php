<?php

namespace myrev\Model;


class Review
{
    public $review_id;
    public $user_id;
    public $place_id;
    public $feeling_id;
    public $timestamp;

    public function exchangeArray(array $data)
    {
        $this->review_id    = !empty($data['review_id'])    ? $data['review_id']    : null;
        $this->user_id      = !empty($data['user_id'])      ? $data['user_id']      : null;
        $this->place_id     = !empty($data['place_id'])     ? $data['place_id']     : null;
        $this->feeling_id   = !empty($data['feeling_id'])   ? $data['feeling_id']   : null;
        $this->timestamp    = !empty($data['timestamp'])    ? $data['timestamp']    : null;
    }
}