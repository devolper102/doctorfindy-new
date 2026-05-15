<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
@php
use Carbon\Carbon;
$current = Carbon::now();
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($areas as $area)
            <url>
                <loc>{{ URL::route("doctors-location-area", [$area->location->slug, $area->slug]) }}</loc>
                <lastmod>{{ gmdate(DateTime::W3C, strtotime($area->updated_at)) }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
    @endforeach

</urlset>