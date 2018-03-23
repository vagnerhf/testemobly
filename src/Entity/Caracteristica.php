<?php

namespace App\Entity;

use App\Repository\CaracteristicaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracteristicaRepository")
 */
class Caracteristica extends MinhaEntidade
{

}
