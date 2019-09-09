<?php

namespace Chriha\LaravelTracking\Http\Middleware;

use Carbon\Carbon;
use Chriha\LaravelTracking\Jobs\StoreRequest;
use Closure;
use Illuminate\Http\Request;

class Tracking
{

    public function handle( Request $request, Closure $next, $guard = null )
    {
        if ( ! config( 'tracking.enabled' ) ) return $next( $request );

        if ( $request->is( config( 'tracking.ignore_paths' ) ) ) return $next( $request );

        $url     = $request->server( 'HTTP_REFERER' );
        $referer = parse_url( $url );

        $data = [
            'method'       => $request->getMethod(),
            'scheme'       => $request->getScheme(),
            'host'         => $request->getHost(),
            'path'         => $request->path(),
            'query'        => $request->getQueryString(),
            'content'      => $request->getContent(),
            'content_type' => $request->getContentType(),
            'referer'      => $referer['host'] ?? null == $request->getHost()
                    ? $referer['path'] : $url,
            'xhr'          => $request->ajax() ? 'true' : 'false',
            'user_id'      => optional( $request->user( $guard ) )->id,
            'ip'           => $request->ip(),
            'agent'        => $request->userAgent(),
            'created_at'   => Carbon::createFromTimestamp( $request->server( 'REQUEST_TIME' ) ),
        ];

        try
        {
            dispatch( new StoreRequest( $data ) )->onQueue( config( 'tracking.queue' ) );
        }
        catch ( \Exception $e )
        {
            report( $e );
        }

        return $next( $request );
    }

}
