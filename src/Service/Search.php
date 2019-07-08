<?php
namespace App\Service;

use Fuse\Fuse as Fuse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class Search
{

    public function filter(
        Array $data,
        String $slug,
        Array $keys,
        Bool $inScoreInclud = false
    ) {
        if (empty($data) || empty($slug)) {
            return [];
        }

           $fuse = new Fuse(
               $data,
               [
               "keys" => $keys,
               "includeScore" => $inScoreInclud,
               ]
           );
          $resultat = $fuse->search($slug);

        return $resultat;
    }
}
