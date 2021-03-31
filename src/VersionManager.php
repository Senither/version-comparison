<?php

namespace Senither\VersionComparison;

use ErrorException;

class VersionManager
{
    /**
     * Get the current version from the version tracker, or null if
     * no git SHA is found, or the API responds with an error.
     *
     * @return \Senither\VersionComparison\Version|null
     */
    public function getCurrentVersion(): ?Version
    {
        $projectId = config('version-comparison.id');
        if ($projectId == null) {
            return null;
        }

        $latestCommitHash = $this->getLatestCommitHash();
        if ($latestCommitHash == null) {
            return null;
        }

        return cache()->remember(
            'version-manger::commit-' . $latestCommitHash,
            config('version-comparison.cache_time.version'),
            fn () => $this->fetchCommitFromApi($projectId, $latestCommitHash)
        );
    }

    /**
     * Get the latest commit hash.
     *
     * @return string|null
     */
    protected function getLatestCommitHash(): ?string
    {
        $commitHash = cache()->remember(
            'version-manger::latest-commit-hash',
            config('version-comparison.cache_time.commit_hash'),
            fn () => exec('git rev-parse HEAD')
        );

        if (mb_strlen($commitHash) !== 40) {
            return null;
        }

        return $commitHash;
    }

    /**
     * Fetch the commit object from the API using
     * the given project ID and commit hash.
     *
     * @param  string $projectId
     * @param  string $commitHash
     * @return \Senither\VersionComparison\Version|null
     */
    protected function fetchCommitFromApi($projectId, $commitHash): ?Version
    {
        try {
            $responses = file_get_contents(
                'https://vt.senither.com/api/repo/' . $projectId . '/commits/' . $commitHash
            );

            return new Version(json_decode($responses));
        } catch (ErrorException $e) {
            return null;
        }
    }
}
