<?php
$rawPostData = file_get_contents('php://input');

parse_str($rawPostData,$rr);
var_dump($rr['message']);