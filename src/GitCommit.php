<?php

declare(strict_types=1);

namespace Symplify\GitWrapper;

use DateTime;
use DateTimeImmutable;
use Symplify\GitWrapper\Exception\GitException;

final class GitCommit
{
    private string $hash;

    private string $author;

    private DateTimeImmutable $authorDate;

    private string $committer;

    private DateTimeImmutable $committerDate;

    private string $subject;

    private string $body;

    /**
     * @param array<string, string> $data
     */
    public function __construct(array $data)
    {
        $this->hash = $data['hash'];
        $this->author = $data['author'];
        $authorDate = DateTimeImmutable::createFromFormat(DateTime::ISO8601, $data['authorDate']);

        if (! $authorDate) {
            throw new GitException('Could not parse author date.');
        }

        $this->authorDate = $authorDate;
        $this->committer = $data['committer'];

        $commiterDate = DateTimeImmutable::createFromFormat(DateTime::ISO8601, $data['committerDate']);
        if (! $commiterDate) {
            throw new GitException('Could not parse commiter date.');
        }

        $this->committerDate = $commiterDate;
        $this->subject = $data['subject'];
        $this->body = $data['body'];
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getAuthorDate(): DateTimeImmutable
    {
        return $this->authorDate;
    }

    public function getCommitter(): string
    {
        return $this->committer;
    }

    public function getCommitterDate(): DateTimeImmutable
    {
        return $this->committerDate;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
