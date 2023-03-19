<a href="{{route("analytics")}}">analytics</a>
@dd($analytics->getAttributes(), $analytics->client_data ? json_decode($analytics->client_data) : '')
