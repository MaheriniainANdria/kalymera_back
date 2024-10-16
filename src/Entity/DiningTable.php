<?php

namespace App\Entity;

class DiningTable
{   
    private ?int $id = null;
    private int $tableNumber;
    private string $name;
    private int $numberOfSeats;
    private string $type;
    private string $location;

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTableNumber(): ?int 
    {
        return $this->tableNumber;
    }

    public function setTableNumber(int $tableNumber): self
    {
        $this->tableNumber = $tableNumber;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getNumberOfSeats(): ?int
    {
        return $this->numberOfSeats;
    }

    public function setNumberOfSeats(int $numberOfSeats): self
    {
        $this->numberOfSeats = $numberOfSeats;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }
}
