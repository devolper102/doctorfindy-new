<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($users as $user)
    @foreach($user->labTest as $test)
        @if($user->slug && $test->slug)
        <url>
            <loc>{{ URL::route("laboratories-city-test", [$user->slug,$test->slug]) }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($test->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        @endif
        @endforeach
    @endforeach

</urlset>