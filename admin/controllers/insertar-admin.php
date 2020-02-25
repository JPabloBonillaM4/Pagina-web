<?php
    header("Content-Type: text/html;charset=utf-8");
    echo json_encode($_POST,JSON_UNESCAPED_UNICODE);