<?php

namespace App\tests\Entity;
use App\Entity\DirectionCentrale;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
class DirectionCentraleTest extends KernelTestCase 
{
    public function getEntity(): DirectionCentrale{
        return (new DirectionCentrale())
                ->setLibelleDirection("direction");
    }
    public function assertHasErrors(DirectionCentrale $direction, int $number = 0){
        $validator = Validation::createValidator();
        self::bootKernel();
        $errors = $validator->validate($direction);
        $this->assertCount($number, $errors);
        
    }
    public function testValidEntity()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }
    public function testInvalidBlankCodeEntity()
    {
        $this->assertHasErrors($this->getEntity()->setLibelleDirection(""), 1);
        
    }
}