<?php

interface FizzBuzzitorInterface
{
  public function toString();
}

class FizzFizzBuzzitor implements FizzBuzzitorInterface
{
  public function toString()
  {
    return "Fizz";
  }
}

class BuzzFizzBuzzitor implements FizzBuzzitorInterface
{
  public function toString()
  {
    return "Buzz";
  }
}

class FizzBuzzFizzBuzzitor implements FizzBuzzitorInterface
{
  public function toString()
  {
    return "FizzBuzz";
  }
}

class NumberFizzBuzzitor implements FizzBuzzitorInterface
{
  public function __construct(private $i)
  {
  }

  public function toString()
  {
    return $this->i;
  }
}

class FizzBuzzitorFactory
{
  /*
   * Check the condition
   */
  public function create(int $i): FizzBuzzitorInterface
  {
    if ($i % 15 == 0) {
      return new FizzBuzzFizzBuzzitor();
    }
    if ($i % 3 == 0) {
      return new FizzFizzBuzzitor();
    }
    if ($i % 5 == 0) {
      return new BuzzFizzBuzzitor();
    }
    return new NumberFizzBuzzitor($i);
  }
}

class FizzBuzz
{
  private FizzBuzzitorFactory $fizzBuzzitorFactory;

  public function __construct()
  {
    $this->fizzBuzzitorFactory = new FizzBuzzitorFactory();
  }

  public function printNumbers(): void
  {
    for($i = 1; $i <= 100; $i++) {
      $fizzBuzzitor = $this->fizzBuzzitorFactory->create($i);
      echo $fizzBuzzitor->toString() . '<br>';
    }
  }
}

$fizzBuzz = new FizzBuzz();
$fizzBuzz->printNumbers();
