<?php

// Assumptions - I assume that the words in the needle string are always in the same order - city, region, country
// so, I compare only first word of needle with the first element of array
//
// In the example code you've given you used snake_case, so I went with it for this task, in all others I am using CamelCase as it is my preference.
// I am not writing this and the next task in OOP way because I think that's not the main goal of it and also because the lack of time, but we can discuss how it can be rewritten.

$needle = "London, England, uk";

$haystack = array(
  1 => array("London", "Ontario", "Canada"),
  8 => array("Greater London", "England", "UK"),
  4 => array("London", "England", "United Kingdom"),
  9 => array("London", "California", "United States")
);

function best_match($needle, $haystack) //camelCase?
{
  $max_rank = -1;
  $max_haystack = null;
  $needle_array = explode(',', $needle);

  $needle_sets = [];
  foreach($needle_array as $needle_array_element){
    $needle_element_set = [];
    foreach(str_split(strtolower($needle_array_element), 1) as $character){
      if($character >= 'a' && $character <= 'z') {
        $needle_element_set[$character] = 1;
      }
    }
    $needle_sets[] = $needle_element_set;
  }

  foreach ($haystack as $haystack_element) {
      $rank = calculate_matched_characters_for_array($needle_sets, $haystack_element);
      if($rank > $max_rank){
        $max_rank = $rank;
        $max_haystack = $haystack_element;
      }
  }

  return $max_haystack;
}

function calculate_matched_characters_for_array($needle_sets, $haystack_element): int
{
  $total_number_of_matched_characters = 0;

  for($i = 0; $i < 3; $i++) {
    $number_of_matched_characters = calculate_matched_characters(
      $needle_sets[$i], $haystack_element[$i]);
    $total_number_of_matched_characters += $number_of_matched_characters;
  }

  return $total_number_of_matched_characters;
}

function calculate_matched_characters(array $needle_set, string $haystack): int
{

  $haystack_arr = str_split(strtolower($haystack), 1);
  $matches_count = 0;
  foreach($haystack_arr as $haystack_character){
    if(array_key_exists($haystack_character, $needle_set)) {
      $matches_count += 1;
    }
  }

  return $matches_count;
}

$result = best_match($needle, $haystack);
var_dump($result);
