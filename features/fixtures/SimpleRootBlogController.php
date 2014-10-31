<?php

/**
 * Controller with no annotation simple with Rest Naming convention.
 */
class SimpleRootBlogController
{
    public function __constructor($blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function get($slug)
    {
        return $slug;
    }

    public function post($request)
    {
        return [1,2];
    }
}