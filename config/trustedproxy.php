<?php

return [

    /*
     * Set trusted proxy IP addresses.
     *
     * Both IPv4 and IPv6 addresses are
     * supported, along with CIDR notation.
     *
     * The "*" character is syntactic sugar
     * within TrustedProxy to trust any proxy
     * that connects directly to your server,
     * a requirement when you cannot know the address
     * of your proxy (e.g. if using ELB or similar).
     *
     */
    'proxies' => null,

    /*
     * Which headers to use to detect proxy related data (For, Host, Proto, Port)
     *
     * Options include:
     *
     * - Illuminate\Http\Request::HEADER_X_FORWARDED_FOR
     * - Illuminate\Http\Request::HEADER_X_FORWARDED_HOST
     * - Illuminate\Http\Request::HEADER_X_FORWARDED_PORT
     * - Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
     *
     * - Or, a bitmask:
     *
     * - Illuminate\Http\Request::HEADER_X_FORWARDED_FOR | Illuminate\Http\Request::HEADER_X_FORWARDED_HOST | Illuminate\Http\Request::HEADER_X_FORWARDED_PORT | Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
     *
     * @link https://symfony.com/doc/current/deployment/proxies.html
     */
    'headers' => Illuminate\Http\Request::HEADER_X_FORWARDED_FOR | Illuminate\Http\Request::HEADER_X_FORWARDED_HOST | Illuminate\Http\Request::HEADER_X_FORWARDED_PORT | Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO | Illuminate\Http\Request::HEADER_X_FORWARDED_AWS_ELB,

];
