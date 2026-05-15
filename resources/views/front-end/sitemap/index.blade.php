<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

@php
use Carbon\Carbon;
$current = Carbon::now();
@endphp

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
            <loc>{{  url('sitemap/specialities.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        <!-- <url>
            <loc>{{  url('sitemap/specialities-cities.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url> -->
        <url>
            <loc>{{  url('sitemap/articles.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        <url>
            <loc>{{  url('sitemap/doctors.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        <url>
            <loc>{{  url('sitemap/doctors-cities.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        <!-- <url>
            <loc>{{  url('sitemap/doctors-cities-area.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url> -->
        <url>
            <loc>{{  url('sitemap/hospitals.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
       <!--  <url>
            <loc>{{  url('sitemap/hospitals-cities.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url> -->
        <url>
            <loc>{{  url('sitemap/labortories.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        <url>
            <loc>{{  url('sitemap/diseases.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        <url>
            <loc>{{  url('sitemap/treatments.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        <url>
            <loc>{{  url('sitemap/surgeries.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        <!-- <url>
            <loc>{{  url('sitemap/surgeries-cities.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url> -->
        <url>
            <loc>{{  url('sitemap/tests.xml')  }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($current)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
       

</urlset>