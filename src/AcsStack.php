<?php

namespace yzh52521\Aliyun;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;

class AcsStack
{
    /** @var array Configuration settings */
    private $config = [
        'Version'          => '2016-11-01',
        'accessKeyId'      => '123456',
        'accessSecret'     => '654321',
        'signatureMethod'  => 'HMAC-SHA1',
        'signatureVersion' => '1.0',
        'dateTimeFormat'   => 'Y-m-d\TH:i:s\Z',
    ];


    public function __construct($config)
    {
        if (!empty( $config )) {
            foreach ( $config as $key => $value ) {
                $this->config[$key] = $value;
            }
        }
    }

    /**
     * Called when the middleware is handled.
     *
     * @param callable $handler
     *
     * @return \Closure
     */
    public function __invoke(callable $handler)
    {
        return function ($request,array $options) use ($handler) {
            $request = $this->onBefore( $request );
            return $handler( $request,$options );
        };
    }

    /**
     * 请求前调用
     * @param RequestInterface $request
     * @return RequestInterface
     */
    private function onBefore(RequestInterface $request)
    {
        if ($request->getMethod() == 'POST') {
            $params = [];
            parse_str( $request->getBody()->getContents(),$params );
        } else {
            $params = \GuzzleHttp\Psr7\Query::parse( $request->getUri()->getQuery() );
        }
        $params["Content-MD5"]             = base64_encode( md5( json_encode( $params ),true ) );
        $params['x-acs-version']           = $this->config['version'];
        $params['x-acs-signature-method']  = $this->config['signatureMethod'];
        $params['Date']                    = gmdate( $this->config['dateTimeFormat'] );
        $params['x-acs-signature-version'] = $this->config['signatureVersion'];
        $params['x-acs-signature-nonce']   = uniqid();
        $params['x-acs-region-id']         = $this->config['regionId'];
        $params['Accept']                  = 'application/json';
        $params['Format']                  = 'JSON';

        $signString = strtoupper( $request->getMethod() )."\n";
        if (isset( $params["Accept"] )) {
            $signString = $signString.$params['Accept'];
        }
        $signString = $signString."\n";
        if (isset( $params["Content-MD5"] )) {
            $signString = $signString.$params['Content-MD5'];
        }
        $signString = $signString."\n";
        if (isset( $params["Content-Type"] )) {
            $signString = $signString.$params['Content-Type'];
        }
        $signString = $signString."\n";
        if (isset( $params["Date"] )) {
            $signString = $signString.$params['Date'];
        }
        $signString = $signString."\n".$this->buildCanonicalHeaders( $params );

        //签名
        $params['Authorization'] = 'acs '.$this->config['accessKeyId'].':'.base64_encode( hash_hmac( 'sha1',$signString,$this->config['accessSecret'],true ) );
        $body                    = http_build_query( $params,'','&' );
        if ($request->getMethod() == 'POST') {
            $request = Utils::modifyRequest( $request,['body' => $body] );
        } else {
            $request = Utils::modifyRequest( $request,['query' => $body] );
        }
        return $request;
    }

    /**
     * Creates the Signature Base String.
     *
     * The Signature Base String is a consistent reproducible concatenation of
     * the request elements into a single string. The string is used as an
     * input in hashing or signing algorithms.
     *
     * @param RequestInterface $request Request being signed
     * @param array $params
     *
     * @return string Returns the base string
     */
    protected function createBaseString(RequestInterface $request,array $params)
    {
        // Remove query params from URL. Ref: Spec: 9.1.2.
        $url   = $request->getUri()->withQuery( '' );
        $query = http_build_query( $params,'','&',PHP_QUERY_RFC3986 );
        return strtoupper( $request->getMethod() )
            .'&'.rawurlencode( $url )
            .'&'.rawurlencode( $query );
    }


    protected function percentEncode($str)
    {
        $res = urlencode( $str );
        $res = preg_replace( '/\+/','%20',$res );
        $res = preg_replace( '/\*/','%2A',$res );
        $res = preg_replace( '/%7E/','~',$res );
        return $res;
    }

    /**
     * 构建规范 Headers
     * @param array $headers
     * @return string
     */
    private function buildCanonicalHeaders(array $headers)
    {
        $sortMap = [];
        foreach ( $headers as $headerKey => $headerValue ) {
            $key = strtolower( $headerKey );
            if (strpos( $key,'x-acs-' ) === 0) {
                $sortMap[$key] = $headerValue;
            }
        }
        ksort( $sortMap );
        $headerString = '';
        foreach ( $sortMap as $sortMapKey => $sortMapValue ) {
            $headerString = $headerString.$sortMapKey.':'.$sortMapValue."\n";
        }
        return $headerString;
    }
}