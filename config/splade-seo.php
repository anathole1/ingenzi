<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title and meta tags (SEO)
    |--------------------------------------------------------------------------
    |
    | You may use the SEO facade to set your page's title, description, and keywords.
    | @see https://splade.dev/docs/title-meta
    |
    */

    'defaults' => [
        'title'       => 'CBO Ingenzi',
        'description' => 'Community Based Organization Ingenzi (CBO INGENZI) is one of Local NGO formed by group of Local Community Volunteers operating in Rwanda under Rwanda Governance Board (RGB) with its head office in Kayonza District, Nyamirama Sector, Eastern Province. CBO Ingenzi has been established in 2011 and it has been officially recognized in 2023. ',
        'keywords'    => ['Community Based Organization', 'Ingenzi', 'ONG', 'NGO', 'CBO'],
    ],

    'title_prefix'    => '',
    'title_separator' => '',
    'title_suffix'    => '',

    'auto_canonical_link' => true,

    'open_graph' => [
        'auto_fill' => false,
        'image'     => null,
        'site_name' => null,
        'title'     => null,
        'type'      => null, // 'WebPage'
        'url'       => null,
    ],

    'twitter' => [
        'auto_fill'   => false,
        'card'        => null, // 'summary_large_image',
        'description' => null,
        'image'       => null,
        'site'        => null, // '@username',
        'title'       => null,
    ],

];
