<?php
namespace StasisMedia\OAuth\Request;

use StasisMedia\OAuth\Credential\Consumer;
/**
 * OAuth 1.0 Temporary Credentials request
 * http://tools.ietf.org/html/rfc5849#section-2.1
 *
 * Used for requesting temporary credentials. Stage 1 in the workflow.
 *
 *
 * @author      Craig Mason <craig.mason@stasismedia.com>
 * @package     OAuth
 * @subpackage  Request
 */
class TemporaryCredentials extends Request implements RequestInterface
{
    /**
     * A Consumer credential containing key and secret
     * @var Consumer
     */
    private $_consumerCredentials;

    /**
     * The callback URL the Provider will call
     * @var string
     */
    private $_callbackUrl;

    /**
     * Set up the required OAuth parameters
     */
    public function __construct()
    {
        parent::__construct();

        $this->addRequiredOAuthParameters(array(
            'oauth_callback'
        ));
    }

    /**
     * Set the Consumer Credential
     * @param Consumer $consumerCredentials
     */
    public function setConsumerCredentials(Consumer $consumerCredentials)
    {
        $this->_consumerCredentials = $consumerCredentials;

        $this->setParameters(array(
            'oauth_consumer_key' => $this->_consumerCredentials->getKey()
        ));
    }

    /**
     * The callback URL the Provider will call
     * 
     * @param <type> $callbackUrl
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->_callbackUrl = $callbackUrl;
        
        $this->setParameter('oauth_callback', $this->_callbackUrl);
    }
}
