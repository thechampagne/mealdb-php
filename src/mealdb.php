<?php
/**
 * TheMealDB API client
 *
 * @author  XXIV
 * @license Apache 2.0
 */
namespace XXIV\MealDB;

class MealDBException extends \Exception {}

function _getRequest($endpoint) {
  $response = @file_get_contents("https://themealdb.com/api/json/v1/1/$endpoint");
  if ($response === false) {
    throw new \Exception($http_response_header[0]);
  }
  return $response;
}

/**
 * Search meal by name.
 *
 * @param s Meal name.
 * @return Array of Meal
 * @throws MealDBException if something went wrong.
 */
function search($s) {
  try {
    $response = _getRequest("search.php?s=$s");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["meals"];
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * Search meals by first letter.
 *
 * @param c Meal letter.
 * @return Array of Meal.
 * @throws MealDBException if something went wrong.
 */
function searchByLetter($c) {
  try {
    $response = _getRequest("search.php?f=$c[0]");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["meals"];
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * Search Meal details by id.
 *
 * @param i Meal id.
 * @return Meal.
 * @throws MealDBException if something went wrong.
 */
function searchById($i) {
  try {
    $response = _getRequest("lookup.php?i=$i");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["meals"][0];
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * Search a random meal.
 *
 * @return Random meal.
 * @throws MealDBException if something went wrong.
 */
function random() {
  try {
    $response = _getRequest("random.php");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["meals"][0];
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * List the meals categories.
 *
 * @return Array of Category.
 * @throws MealDBException if something went wrong.
 */
function mealCategories() {
  try {
    $response = _getRequest("categories.php");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["categories"] || count($data["categories"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["categories"];
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * Filter by ingredient.
 *
 * @param s Ingredient name.
 * @return Array of Filter.
 * @throws MealDBException if something went wrong.
 */
function filterByIngredient($s) {
  try {
    $response = _getRequest("filter.php?i=$s");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["meals"];
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * Filter by area.
 *
 * @param s Area name.
 * @return Array of Filter.
 * @throws MealDBException if something went wrong.
 */
function filterByArea($s) {
  try {
    $response = _getRequest("filter.php?a=$s");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["meals"];
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * Filter by Category.
 *
 * @param s Category name.
 * @return Array of Filter.
 * @throws MealDBException if something went wrong.
 */
function filterByCategory($s) {
  try {
    $response = _getRequest("filter.php?c=$s");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["meals"];
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * List the categories filter.
 *
 * @return Array of String.
 * @throws MealDBException if something went wrong.
 */
function categoriesFilter() {
  try {
    $response = _getRequest("list.php?c=list");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    $arr = array();
    foreach($data["meals"] as $i) {
      array_push($arr,$i["strCategory"]);
    }
    return $arr;
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * List the ingredients filter.
 *
 * @return Array of Ingredient.
 * @throws MealDBException if something went wrong.
 */
function ingredientsFilter() {
  try {
    $response = _getRequest("list.php?i=list");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    return $data["meals"];
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}

/**
 * List the area filter.
 *
 * @return Array of String.
 * @throws MealDBException if something went wrong.
 */
function areaFilter() {
  try {
    $response = _getRequest("list.php?a=list");
    if (strlen($response) === 0) {
      throw new \Exception("no results found");
    }
    $data = json_decode($response, true);
    if (!$data["meals"] || count($data["meals"]) === 0) {
      throw new \Exception("no results found");
    }
    $arr = array();
    foreach($data["meals"] as $i) {
      array_push($arr,$i["strArea"]);
    }
    return $arr;
  } catch(\Exception $err) {
    throw new MealDBException($err->getMessage());
  }
}
?>