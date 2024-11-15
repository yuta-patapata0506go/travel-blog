<?php
if (! function_exists('add_query_param')) {
    function add_query_param($url, $params) {
        // Get the current URL query string (including existing parameters)
        $urlParts = parse_url($url);
        // Parse the query string and get the current parameters
        parse_str($urlParts['query'] ?? '', $currentParams);
        // Remove the 'page' parameter from the current query parameters
        unset($currentParams['page']);
        // Merge the existing parameters with any new parameters (without duplicating 'page')
        $params = array_merge($currentParams, $params);
        // Get the current page number or default to 1 if not present
        $currentPage = (int) request()->get('page', 1);
        // Increment the page number for next/previous page navigation
        $params['page'] = $currentPage + 1;
        // Rebuild the query string with the updated parameters
        $queryString = http_build_query($params);
        // Return the full URL with the updated query string
        return $urlParts['path'] . '?' . $queryString;
    }
}