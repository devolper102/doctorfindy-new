<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
@php
use Carbon\Carbon;
$current = Carbon::now();
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
     @foreach($locations as $location)
            <url>
                <loc>{{ URL::route("doctors-by-city", [$location->slug]) }}</loc>
                <lastmod>{{ gmdate(DateTime::W3C, strtotime($location->updated_at)) }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
    @endforeach

</urlset>