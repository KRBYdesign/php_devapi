<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('CONFIG_ROOT', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'config');

/**
 * Takes a dot-seperated query string and returns the associated value. The first element of the query is the file where the config value is stored.
 *
 * Example: 'app.name' returns the value for the 'name' key within the 'config/app.php' file.
 *
 * @param string $query
 * @return mixed
 */
function config(string $query) : mixed
{
    $searchElements = explode('.', $query);

    if (!$configFiles = scandir(CONFIG_ROOT)) {
	throw new \Exception("The config directory could not be located.");
    }
    else if (!in_array("$searchElements[0].php", $configFiles)) {
	throw new \Exception("The config file ($searchElements[0].php) could not be located.");
    }
    else if (count($searchElements) < 2) {
	throw new \Exception("Please supply a config element to return.");
    }

    // get the initial list of config elements
    $contents = include CONFIG_ROOT . DIRECTORY_SEPARATOR . "$searchElements[0].php";

    array_shift($searchElements);

    return recursiveArraySearch($contents, $searchElements);
}

function recursiveArraySearch(array $contents, array $searchElements) : mixed
{
    // get the end of the array to find what the user is ultimately looking for
    $finalSearchElement = $searchElements[array_key_last($searchElements)];

    // return if the element exists at the current level
    if (array_key_exists($finalSearchElement, $contents)) {
        return $contents[$finalSearchElement];
    }
    else {
        try {
            // reset the contents array to the nested array found with the first element in the searchElements
            $contents = $contents[$searchElements[0]];
        }
        catch (\Exception) {
            throw new Exception("Error while searching for '{$searchElements[0]}' element. Please ensure that config element exists.");
        }
        // drop the first element from the search elements for the next go around
        array_shift($searchElements);

        // rerun it
        return recursiveArraySearch($contents, $searchElements);
    }
}
