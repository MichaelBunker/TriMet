<?php

declare(strict_types = 1);

namespace TriMet\Serializer;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TriMet\Models\Response;

class DeSerializer
{
    /**
     * This is a very simple deserializer that converts all requests to the TriMet API to a Response object.
     */
    public function convert(mixed $data): array|object
    {
        $encoders    = [new JsonEncoder()];
        $normalizers = [new ArrayDenormalizer(), new ObjectNormalizer(null, null, null, new PhpDocExtractor())];
        $serializer  = new Serializer($normalizers, $encoders);

        return $serializer->deserialize(json_encode($data), Response::class, 'json');
    }
}
