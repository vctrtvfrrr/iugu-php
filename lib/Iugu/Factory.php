<?php

declare(strict_types=1);

class Iugu_Factory
{
    public static function createFromResponse($object_type, $response)
    {
        // Should i send fetch to here?
        $object_type = str_replace(' ', '', ucwords(str_replace('_', ' ', $object_type)));
        $class_name = 'Iugu_'.$object_type;

        if (! class_exists($class_name)) {
            return;
        }

        if (is_object($response) && (isset($response->items)) && (isset($response->totalItems))) {
            $results = [];

            foreach ($response->items as $item) {
                $results[] = self::createFromResponse($object_type, $item);
            }

            return new Iugu_SearchResult($results, $response->totalItems);
        }

        if (is_array($response)) {
            $results = [];

            foreach ($response as $item) {
                $results[] = self::createFromResponse($object_type, $item);
            }

            return new Iugu_SearchResult($results, count($results));
        }

        if (is_object($response)) {
            return new $class_name((array) $response);
        }
    }
}
