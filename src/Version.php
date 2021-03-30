<?php

namespace Senither\VersionComparison;

use Carbon\Carbon;

class Version
{
    /**
     * The JSON version response from the API.
     *
     * @var object
     */
    private $data;

    /**
     * Creates a new version instance using
     * the given JSON version response.
     *
     * @param object $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Check if there is a newere release.
     *
     * @return boolean
     */
    public function isOutdated(): bool
    {
        return $this->getVersionsBehind() > 0;
    }

    /**
     * Get the amount of versions the current version is behind.
     *
     * @return int
     */
    public function getVersionsBehind(): int
    {
        return $this->data->versions_behind;
    }

    /**
     * Get the commit hash.
     *
     * @return string
     */
    public function getHash(): string
    {
        return $this->data->hash;
    }

    /**
     * Get the commit message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->data->message;
    }

    /**
     * Get the generated commit semantic version.
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->data->version;
    }

    /**
     * Get the direct link to the commit URL.
     *
     * @return string
     */
    public function getCommitUrl(): string
    {
        return $this->data->url;
    }

    /**
     * Get the time the commit was made at.
     *
     * @return \Carbon\Carbon
     */
    public function getCommitTime(): Carbon
    {
        return new Carbon($this->data->commit_at);
    }

    /**
     * Return the semantic version when the class is cast to a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getVersion();
    }
}
