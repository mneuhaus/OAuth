<?php
namespace StasisMedia\OAuth;

use StasisMedia\OAuth\Connector;
/* 
 * OAuth 1.0 client - rfc5849
 * http://tools.ietf.org/html/rfc5849
 *
 * Uses the terminology as specified in rfc5849
 * 
 * This library will not initiate any redirection, echo output or otherwise
 * interfere with the parent application. Redirection is the responsibility
 * of the application.
 *
 * @author      Craig Mason <craig.mason@stasismedia.com>
 * @package     OAuth
 */
class Client
{
    /**
     * Connector for making requests to the Service Provider
     * @var Connector\ConnectorInterface
     */
    private $_connector;

    /**
     * Request type
     * @var Request\RequestInterface
     */
    private $_request;

    /**
     * Signature algorithm
     * @var Signature\SignatureInterface
     */
    private $_signature;

    /**
     * A unix timestamp
     * @var int
     */
    private $_timestamp;

    /**
     *
     * @param   ConnectorInterface $connector The HTTP connector to use when
     *          communicating with the Service Provider
     */
    public function __construct(Connector\ConnectorInterface $connector,
                                Request\RequestInterface $request,
                                Signature\SignatureInterface $signature)
    {
        $this->_connector = $connector;
        $this->_request = $request;
        $this->_signature = $signature;
    }

    /**
     * Generates a 64-bit one-time nonce
     *
     * @return string The unique nonce
     */
    private function _generateNonce()
    {
        return md5(uniqid(rand(), true));
    }

    /**
     * Returns the current unix timestamp
     * @return <type>
     */
    private function _generateTimestamp()
    {
        return time();
    }

    /**
     * We allow timestamps to be set, as the OAuth spec does not excplicitly
     * specify how timestamps should synhronize between Consumer and Provider.
     * Perhaps you want to use a UTC time, or perhaps your Provider needs a
     * timestamp within a specified timeframe.
     *
     * If a timestamp is set with this method, it will be used as a parameter
     * in the Request
     */
    public function setTimestamp($timestamp)
    {
        $this->_timestamp = $timestamp;
    }
}
