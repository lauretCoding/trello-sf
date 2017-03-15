<?php
namespace AppBundle\Serializer\Normalizer;
use AppBundle\Entity\Task;

class TaskNormalizer extends AbstractNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'description' => $object->getDescription(),
            'status' => $object->getStatus(),
            'category' => $this->normalizeObject($object->getCategory(), $format, $context),
        ];
        return $data;
    }
    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Task;
    }


}