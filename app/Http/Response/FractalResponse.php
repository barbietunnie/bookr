<?php

namespace App\Http\Response;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use League\Fractal\Serializer\SerializerAbstract;

class FractalResponse
{
  /**
   * @var Manager
   */
  private $manager;

  /**
   * @var SerializerAbstract
   */
  private $serializer;

  public function __construct(Manager $manager, SerializerAbstract $serializer)
  {
      $this->manager = $manager;
      $this->serializer = $serializer;
      $this->manager->setSerializer($serializer);
  }

  public function item($data, TransformerAbstract $transformer, $resourceKey = null)
  {
      $resource = new Item($data, $transformer, $resourceKey);

      return $this->manager->createData($resource)->toArray();
  }
}