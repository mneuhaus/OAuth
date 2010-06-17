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
}
