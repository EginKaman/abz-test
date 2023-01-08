<?php

namespace App\Services;

use Exception;
use Tinify\ClientException;
use Tinify\Source;
use Tinify\Tinify;

class TinifyService
{
    protected Tinify $client;

    protected string $apikey;

    /**
     * Get api key from env, fail if any are missing.
     * Instantiate API client and set api key.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->apikey = config('services.tinify.key');
        if (!$this->apikey) {
            throw new \InvalidArgumentException('Please set TINIFY_KEY in environment variables or in config.');
        }
        $this->client = new Tinify();
        $this->setKey($this->apikey);
    }

    /**
     * @param $key
     * @return null
     */
    public function setKey($key)
    {
        return $this->client->setKey($key);
    }

    public function setAppIdentifier($appIdentifier)
    {
        return $this->client->setAppIdentifier($appIdentifier);
    }

    public function getCompressionCount()
    {
        return $this->client->getCompressionCount();
    }

    public function compressionCount()
    {
        return $this->client->getCompressionCount();
    }

    public function fromFile($path)
    {
        return Source::fromFile($path);
    }

    public function fromBuffer($string)
    {
        return Source::fromBuffer($string);
    }

    public function fromUrl($string)
    {
        return Source::fromUrl($string);
    }

    public function validate()
    {
        try {
            $this->client->getClient()->request("post", "/shrink");
        } catch (ClientException $e) {
            return true;
        }
    }
}
