<?php

if ( ! function_exists('uuid_v4')) {
    function uuid_v4()
    {
        return \Bnb\Uuid\Uuid::v4()->full();
    }
}

if ( ! function_exists('uuid_v4_short')) {
    function uuid_v4_short()
    {
        return \Bnb\Uuid\Uuid::v4()->short();
    }
}

if ( ! function_exists('uuid_v4_base36')) {
    function uuid_v4_base36()
    {
        return \Bnb\Uuid\Uuid::v4()->base36();
    }
}

if ( ! function_exists('uuid_v4_base64')) {
    function uuid_v4_base64()
    {
        return \Bnb\Uuid\Uuid::v4()->base64();
    }
}