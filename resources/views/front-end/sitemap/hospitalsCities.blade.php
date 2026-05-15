<!-- <?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($hospitals as $key => $hospital)
    @php
   if(count($hospital->specialities)>0)
    $speciality= $hospital->specialities[0]->slug;
   @endphp
        <url>
            <loc>{{ URL::route("hospitals-speciality-city", [$hospital->location->slug,  $hospital->slug]) }}</loc>
            <lastmod>{{ gmdate(DateTime::W3C, strtotime($hospital->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach

    {{--@foreach($locations as $location)
        @if($location->parent === 0)

            <url>
                <loc>{{ URL::route("hospitals-by-city", [$location->slug]) }}</loc>
                <lastmod>{{ gmdate(DateTime::W3C, strtotime($location->updated_at)) }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
        @endif
    @endforeach

    @foreach($locations as $location)
        @php $areas = \App\Location::where('parent', $location->id)->get(); @endphp
        @foreach($areas as $area)
            <url>
                <loc>{{ URL::route("hospitals-location-area", [$location->slug, $area->slug]) }}</loc>
                <lastmod>{{ gmdate(DateTime::W3C, strtotime($location->updated_at)) }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
        @endforeach
    @endforeach

    @foreach($specialities as $speciality)
        @foreach($locations as $location)
            <url>
                <loc>{{ URL::route("hospitals-speciality-city", [$location->slug, $area->slug]) }}</loc>
                <lastmod>{{ gmdate(DateTime::W3C, strtotime($location->updated_at)) }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>1.0</priority>
            </url>
        @endforeach
    @endforeach--}}

</urlset> -->