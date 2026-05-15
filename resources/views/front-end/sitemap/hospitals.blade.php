<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
@php
use Carbon\Carbon;
$current = Carbon::now();
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($locations as $key => $location)
        <url>
            <loc>{{ URL::route("hospitals-by-city", [$location->slug]) }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach


</urlset>