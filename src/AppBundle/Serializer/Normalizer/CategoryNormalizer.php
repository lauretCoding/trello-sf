<?php
namespace AppBundle\Serializer\Normalizer;
use AppBundle\Entity\Category;

class CategoryNormalizer extends AbstractNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
        ];
        return $data;
    }
    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Category;
    }


}