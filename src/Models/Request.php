<?php

namespace Chriha\LaravelTracking\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    /** @var string */
    protected $table = 'tracking_requests';

    /** @var array */
    protected $guarded = [];

    /** @var string|null */
    const UPDATED_AT = null;

    /** @var array */
    protected $casts = [];


    public static function guardContent( string $content, bool $isJson = false ) : string
    {
        if ( empty( $content ) ) return $content;

        $guarded = config( 'tracking.guarded' );

        if ( empty( $guarded ) ) return $content;

        if ( $isJson )
        {
            $json    = json_decode( $content, true );
            $json    = self::sanitize( $json, $guarded );
            $content = json_encode( $json );
        }
        else
        {
            $params    = explode( '&', $content );

            foreach ( $params as $i => $param )
            {
                [ $key, $value ] = explode( '=', $param );

                if ( ! in_array( $key, $guarded ) ) continue;

                $params[$i] = "{$key}=***";
            }

            $content = implode( '&', $params );
        }

        return $content;
    }

    public static function sanitize( array $data, array $guard ) : array
    {
        if ( empty( $data ) ) return [];

        foreach ( $data as $key => $value )
        {
            if ( is_array( $value ) )
            {
                $data[$key] = self::sanitize( $value, $guard );
            }
            elseif ( in_array( $key, $guard ) )
            {
                $data[$key] = '***';
            }
        }

        return $data;
    }

}
