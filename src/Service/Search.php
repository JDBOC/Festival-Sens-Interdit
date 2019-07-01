<?php
namespace App\Service;

use Fuse\Fuse as Fuse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class Search
{
    private $normalizer;
    private $gofuckyoursel;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    protected function normaliz($datas, $attributes)
    {
        $this->gofuckyoursel = [];
        $arr = [];
        foreach ($datas as $obj) {
            $objNormalized = $this->normalizer->normalize($obj, null, $attributes);
            $arr[] = $objNormalized;
        }
        return $arr;
    }

    public function filter(
        Array $data,
        Array $attributes,
        String $slug,
        Array $keys,
        Float $score = 0.6,
        Bool $isScoreInclud = false
    ) {
        if (empty($data) && empty($slug)) {
            return [];
        }
            $array = $this->normaliz($data, $attributes);

            $fuse = new Fuse($data, [
                "key" => $keys,
                "score" => $isScoreInclud,
                "threshold" => $score
                ]);
        return $fuse->search($slug);
    }
}
