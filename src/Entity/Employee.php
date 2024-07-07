<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 50, unique: true)]
    private ?string $employeeId = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $userName = null;

    #[ORM\Column(type: Types::STRING, length: 10, nullable: true)]
    private ?string $namePrefix = null;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private ?string $firstName = null;

    #[ORM\Column(type: Types::STRING, length: 1, nullable: true)]
    private ?string $middleInitial = null;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private ?string $lastName = null;

    #[ORM\Column(type: Types::STRING, length: 10)]
    private ?string $gender = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $timeOfBirth = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $ageInYrs = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfJoining = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $ageInCompany = null;

    #[ORM\Column(type: Types::STRING, length: 20)]
    private ?string $phoneNo = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $placeName = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $county = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private ?string $city = null;

    #[ORM\Column(type: Types::STRING, length: 20)]
    private ?string $zip = null;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private ?string $region = null;
    
    
    // Getters and Setters...
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployeeId(): ?string
    {
        return $this->employeeId;
    }

    public function setEmployeeId(string $employeeId): static
    {
        $this->employeeId = $employeeId;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getNamePrefix(): ?string
    {
        return $this->namePrefix;
    }

    public function setNamePrefix(?string $namePrefix): static
    {
        $this->namePrefix = $namePrefix;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleInitial(): ?string
    {
        return $this->middleInitial;
    }

    public function setMiddleInitial(?string $middleInitial): static
    {
        $this->middleInitial = $middleInitial;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): static
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getTimeOfBirth(): ?\DateTimeInterface
    {
        return $this->timeOfBirth;
    }

    public function setTimeOfBirth(\DateTimeInterface $timeOfBirth): static
    {
        $this->timeOfBirth = $timeOfBirth;

        return $this;
    }

    public function getAgeInYrs(): ?int
    {
        return $this->ageInYrs;
    }

    public function setAgeInYrs(int $ageInYrs): static
    {
        $this->ageInYrs = $ageInYrs;

        return $this;
    }

    public function getDateOfJoining(): ?\DateTimeInterface
    {
        return $this->dateOfJoining;
    }

    public function setDateOfJoining(\DateTimeInterface $dateOfJoining): static
    {
        $this->dateOfJoining = $dateOfJoining;

        return $this;
    }

    public function getAgeInCompany(): ?int
    {
        return $this->ageInCompany;
    }

    public function setAgeInCompany(int $ageInCompany): static
    {
        $this->ageInCompany = $ageInCompany;

        return $this;
    }

    public function getPhoneNo(): ?string
    {
        return $this->phoneNo;
    }

    public function setPhoneNo(string $phoneNo): static
    {
        $this->phoneNo = $phoneNo;

        return $this;
    }

    public function getPlaceName(): ?string
    {
        return $this->placeName;
    }

    public function setPlaceName(string $placeName): static
    {
        $this->placeName = $placeName;

        return $this;
    }

    public function getCounty(): ?string
    {
        return $this->county;
    }

    public function setCounty(string $county): static
    {
        $this->county = $county;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): static
    {
        $this->zip = $zip;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;

        return $this;
    }

}
