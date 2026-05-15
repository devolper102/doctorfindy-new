<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($services as $service)
        <url>
            <loc>{{ URL::route("servicesDetails", [$service->slug]) }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($service->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach

    {{-- @foreach($locations as $location)
               @foreach($services as $service)
                    <url>
                        <loc>{{ URL::route("servicesDetailsLocation", [$service->slug, $location->slug]) }}</loc>
                        <lastmod>{{ gmdate(DateTime::W3C, strtotime($service->updated_at)) }}</lastmod>
                        <changefreq>daily</changefreq>
                        <priority>1.0</priority>
                    </url>
                @endforeach
            @endforeach --}}

</urlset>