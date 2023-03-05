<?php

namespace mvm\less1\Person;
use \DateTimeImmutable;

class Person
{
    public function __construct(private Name $name, private DateTimeImmutable $registeredOn) 
    {
        $this->name = $name;
        $this->registeredOn = $registeredOn;
    }

    public function __toString()
    {
        return $this->name . ' (на сайте с ' . $this->registeredOn->format('Y-m-d') . ')';
    }
}