<?php


namespace App\Mapper;


use Exception;

class AutoMapper
{
    public static function Map($source, $target)
    {
        $targetProperties = get_object_vars($target);
        $sourceProperties = get_object_vars($source);

        foreach ($targetProperties as $name => $value)
        {

            $matchingSourcePropertyExists = array_key_exists($name, $sourceProperties);
            if ($matchingSourcePropertyExists)
            {
               $target->{$name} =$source->{$name};
                continue;
            }

            $sourceMethods = get_class_methods(get_class($source));
            $getterName = "get" . self::convertToPascalCase($name);
            $matchingGetAccessorExists = in_array($getterName, $sourceMethods);
            if ($matchingGetAccessorExists)
            {
                $target->{$name} = $source->{$getterName}();
                continue;
            }

            //
            // if we ever fail to map an entity on the target, throw
            //

            $className = get_class($target);
            throw new Exception("Could not auto-map property $name on $className.");
        }
        return $target;
    }

    /**
     * Converts this_kind_of_string into ThisKindOfString.
     * @param $value string
     * @return string
     */
    private static function convertToPascalCase($value)
    {
        $value[0] = strtoupper($value[0]);
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-z])/', $func, $value);
    }
}