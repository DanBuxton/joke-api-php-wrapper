<?php

namespace JokeApiWrapper\Models;

class JokeFlags
{
    public readonly bool $nsfw;
    public readonly bool $religious;
    public readonly bool $political;
    public readonly bool $racist;
    public readonly bool $sexist;
    public readonly bool $explicit;

    /**
     * @param bool $nsfw
     * @param bool $religious
     * @param bool $political
     * @param bool $racist
     * @param bool $sexist
     * @param bool $explicit
     */
    private function __construct(array $data)
    {
        $this->nsfw = $data['nsfw'] ?? false;
        $this->religious = $data['religious'] ?? false;
        $this->political = $data['political'] ?? false;
        $this->racist = $data['racist'] ?? false;
        $this->sexist = $data['sexist'] ?? false;
        $this->explicit = $data['explicit'] ?? false;
    }

    static function make(array $data): static
    {
        return new static($data);
    }
}