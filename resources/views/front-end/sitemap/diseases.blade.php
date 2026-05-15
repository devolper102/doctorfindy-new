<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($diseases as $disease)
        <url>
            <loc>{{ URL::route("diseasesDetails", [$disease->slug]) }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($disease->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach

    {{-- @foreach($diseases as $disease)
                @foreach($locations as $location)
                    <url>
                        <loc>{{ URL::route("diseasesDetailsLocation", [$disease->slug, $location->slug ]) }}</loc>
                        <lastmod>{{ gmdate(DateTime::W3C, strtotime($disease->updated_at)) }}</lastmod>
                        <changefreq>daily</changefreq>
                        <priority>1.0</priority>
                    </url>
                @endforeach
            @endforeach --}}

</urlset>