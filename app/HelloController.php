<?php

class HelloController {

    function get($params) {
        return new \Symfony\Component\HttpFoundation\Response('Hello controller ' . $params['name']);
    }
} 