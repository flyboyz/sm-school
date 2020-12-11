<?php

header("HTTP/1.1 301 Moved Permanently");
header("Location: " . get_field('fields')['link']);
exit();
