<?php

namespace JokeApiWrapper\Models;

class Joke
{
    public readonly bool $error;
    public readonly string $category;
    public readonly string $type;

    public readonly ?string $joke;
    public readonly ?string $setup;
    public readonly ?string $delivery;

    public readonly JokeFlags $flags;

    public readonly int $id;
    public readonly bool $safe;
    public readonly ?string $lang;

    private function __construct($json)
    {
        $this->error = $json['error'];
        $this->category = $json['category'];
        $this->type = $json['type'];

        $this->joke = $json['joke'] ?? null;
        $this->setup = $json['setup'] ?? null;
        $this->delivery = $json['delivery'] ?? null;

        $this->flags = JokeFlags::make($json['flags']);

        $this->id = $json['id'];
        $this->safe = $json['safe'];
        $this->lang = $json['lang'];
    }

    static function make(array $data): static
    {
        return new static($data);
    }
}