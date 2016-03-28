<?php

namespace Drupal\ymca_groupex;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Url;

/**
 * Fetches and prepares Groupex data.
 *
 * @package Drupal\ymca_groupex.
 */
class GroupexScheduleFetcher {

  use GroupexRequestTrait;

  /**
   * Fetched raw data.
   *
   * @var array
   */
  private $rawData = [];

  /**
   * Enriched data.
   *
   * @var array
   */
  private $enrichedData = [];

  /**
   * Filtered data (enriched).
   *
   * @var array
   */
  private $filteredData = [];

  /**
   * Processed data (enriched).
   *
   * @var array
   */
  private $processedData = [];

  /**
   * Query parameters.
   *
   * @var array
   */
  private $parameters = [];

  /**
   * Cached schedule.
   *
   * @var array
   */
  private $schedule = [];

  /**
   * Timezone.
   *
   * @var \DateTimeZone
   */
  private $timezone = NULL;

  /**
   * ScheduleFetcher constructor.
   */
  public function __construct() {
    $this->timezone = new \DateTimeZone(\Drupal::config('system.date')->get('timezone')['default']);
    $this->parameters = self::normalizeParameters(\Drupal::request()->query->all());
    $this->getData();
    $this->enrichData();
    $this->filterData();
    $this->processData();
  }

  /**
   * Get schedule.
   *
   * @return array
   *   A schedule. It could be of 2 types:
   *    - day: all classes within classes key
   *    - week: all classes grouped by day within days key
   */
  public function getSchedule() {
    // Use cached schedule if already processed.
    if ($this->schedule) {
      return $this->schedule;
    }

    $filter_date = DrupalDateTime::createFromTimestamp($this->parameters['filter_timestamp'], $this->timezone);

    // Prepare classes items.
    $items = [];

    foreach ($this->processedData as $item) {
      $items[$item->id] = [
        '#theme' => 'groupex_class',
        '#class' => [
          'id' => trim($item->id),
          'name' => trim($item->title),
          'group' => trim($item->category),
          'description' => $item->desc,
          'address_1' => $item->address_1,
          'address_2' => trim($item->location),
          'date' => $item->date,
          'time' => $item->start,
          'duration' => sprintf('%d min', trim($item->length)),
        ],
      ];
    }

    // Pack classes into the schedule.
    $schedule = [];

    // There 3 types of schedules.
    // Day: show classes for single day.
    // Week: show classes for week grouped by day.
    // Location: show classes for 1 day grouped by location.
    $schedule['type'] = isset($this->parameters['filter_length']) ? $this->parameters['filter_length'] : 'day';
    if (!empty($this->parameters['location']) && count($this->parameters['location']) > 1) {
      $schedule['type'] = 'location';
    }

    switch ($schedule['type']) {
      case 'day':
        $schedule['classes'] = [];
        foreach ($items as $id => $class) {
          $schedule['classes'][] = $class;
          $schedule['title'] = trim($this->enrichedData[$id]->location);
        }
        // Pass 'View This Week’s PDF' href if some location selected.
        if (!empty($this->parameters['location'])) {
          $location_id = reset($this->parameters['location']);
          $category = $this->parameters['category'] == 'any' ? NULL : $this->parameters['category'];
          $schedule['pdf_href'] = self::getPdfLink($location_id, $this->parameters['filter_timestamp'], $category);
        }

        // If no location selected show date instead of title.
        if (empty($this->parameters['location'])) {
          $schedule['title'] = $filter_date->format(GroupexRequestTrait::$dateFullFormat);
        }
        break;

      case 'week':
        $schedule['days'] = [];
        foreach ($items as $id => $class) {
          $schedule['days'][$this->enrichedData[$id]->day][] = $class;
        }
        // Pass 'View This Week’s PDF' href if some location selected.
        if (!empty($this->parameters['location'])) {
          $location = reset($this->parameters['location']);
          $category = $this->parameters['category'] == 'any' ? NULL : $this->parameters['category'];
          $schedule['pdf_href'] = self::getPdfLink($location, $this->parameters['filter_timestamp'], $category);
        }

        // If no location selected show date instead of title.
        if (empty($this->parameters['location'])) {
          $schedule['day'] = $filter_date->format(GroupexRequestTrait::$dateFullFormat);
        }
        break;

      case 'location':
        $schedule['locations'] = [];
        $locations = \Drupal::config('ymca_groupex.mapping')->get('locations');
        $location_id = NULL;
        foreach ($items as $id => $class) {
          $short_location_name = trim($this->enrichedData[$id]->location);
          foreach ($locations as $location) {
            if ($location['name'] == $short_location_name) {
              $location_id = $location['geid'];
            }
          }
          $category = $this->parameters['category'] == 'any' ? NULL : $this->parameters['category'];
          $pdf_href = self::getPdfLink($location_id, $this->parameters['filter_timestamp'], $category);
          $schedule['locations'][$short_location_name]['classes'][] = $class;
          $schedule['locations'][$short_location_name]['pdf_href'] = $pdf_href;
        }
        $schedule['filter_date'] = date(GroupexRequestTrait::$dateFullFormat, $this->parameters['filter_timestamp']);
        break;
    }

    $this->schedule = $schedule;
    return $this->schedule;
  }

  /**
   * Fetch data from the server.
   */
  private function getData() {
    $this->rawData = [];

    // No request parameters - no data.
    if (empty($this->parameters)) {
      return;
    }

    // One of the 3 search parameters should be provided:
    // 1. Location.
    // 2. Class name.
    // 3. Category.
    if (
      !isset($this->parameters['location']) &&
      $this->parameters['class'] == 'any' &&
      $this->parameters['category'] == 'any') {
      return;
    }

    $options = [
      'query' => [
        'schedule' => TRUE,
        'desc' => 'true',
      ],
    ];

    // Location is optional.
    if (!empty($this->parameters['location'])) {
      $options['query']['location'] = array_filter($this->parameters['location']);
    }

    // Category is optional.
    if ($this->parameters['category'] !== 'any') {
      $options['query']['category'] = $this->parameters['category'];
    }

    // Class is optional.
    if ($this->parameters['class'] !== 'any') {
      $options['query']['class'] = self::$idStrip . $this->parameters['class'];
    }

    // Filter by date.
    $interval = 'P1D';
    if ($this->parameters['filter_length'] == 'week') {
      $interval = 'P1W';
    }
    $date = DrupalDateTime::createFromTimestamp($this->parameters['filter_timestamp'], $this->timezone);

    $options['query']['start'] = $date->getTimestamp();
    $options['query']['end'] = $date->add(new \DateInterval($interval))->getTimestamp();

    $data = $this->request($options);

    $raw_data = [];
    foreach ($data as $item) {
      $raw_data[$item->id] = $item;
    }
    $this->rawData = $raw_data;
  }

  /**
   * Enriches data.
   */
  private function enrichData() {
    $data = $this->rawData;

    foreach ($data as &$item) {
      // Get address_1.
      $item->address_1 = sprintf('%s with %s', trim($item->studio), trim($item->instructor));

      // Get day.
      $item->day = $item->date;

      // Get start and end time.
      preg_match("/(.*)-(.*)/i", $item->time, $output);
      $item->start = $output[1];
      $item->end = $output[2];

      // Get time of day.
      $datetime = new \DateTime($item->start);
      $start_hour = $datetime->format('G');
      $item->time_of_day = 'morning';
      $item->time_of_day = ($start_hour >= self::$timeAfternoon) ? "afternoon" : $item->time_of_day;
      $item->time_of_day = ($start_hour >= self::$timeEvening) ? "evening" : $item->time_of_day;

      // Add timestamp.
      $format = 'l, F j, Y';
      $datetime = DrupalDateTime::createFromFormat($format, $item->date, $this->timezone);
      $datetime->setTime(0, 0, 0);
      $item->timestamp = $datetime->getTimestamp();
    }

    $this->enrichedData = $data;
  }

  /**
   * Filter the enriched data.
   */
  private function filterData() {
    $filtered = $this->enrichedData;
    $param = $this->parameters;

    // Filter out by time of the day.
    if (!empty($param['time_of_day'])) {
      $filtered = array_filter($filtered, function($item) use ($param) {
        if (in_array($item->time_of_day, $param['time_of_day'])) {
          return TRUE;
        }
        return FALSE;
      });
    }

    // Groupex response have some redundant data. Filter it out.
    if ($param['filter_length'] == 'day') {
      // Filter out by the date. Cut off days before.
      $filtered = array_filter($filtered, function($item) use ($param) {
        if ($item->timestamp >= $param['filter_timestamp']) {
          return TRUE;
        }
        return FALSE;
      });

      // Filter out by the date. Cut off days after.
      $filtered = array_filter($filtered, function($item) use ($param) {
        if ($item->timestamp < ($param['filter_timestamp'] + 60 * 60 * 24)) {
          return TRUE;
        }
        return FALSE;
      });
    }

    $this->filteredData = $filtered;
  }

  /**
   * Process data.
   */
  private function processData() {
    $data = $this->filteredData;

    // Groupex returns invalid date for the first day of the week.
    // Example: tue, 02, Feb; wed, 27, Jan; thu, 28, Jan.
    // So, processing.
    if ($this->parameters['filter_length'] == 'week') {
      // Get current day.
      $date = DrupalDateTime::createFromTimestamp($this->parameters['filter_timestamp'], $this->timezone);
      $current_day = $date->format('N');
      $current_date = $date->format('j');

      // Search for the day equals current.
      foreach ($data as &$item) {
        $item_date = DrupalDateTime::createFromTimestamp($item->timestamp, $this->timezone);
        if ($current_date == $item_date->format('j')) {
          unset($item);
          continue;
        }

        if ($current_day == $item_date->format('N')) {
          // Set proper data.
          $item_date->sub(new \DateInterval('P7D'));
          $full_date = $item_date->format(GroupexRequestTrait::$dateFullFormat);
          $item->date = $full_date;
          $item->day = $full_date;
          $item->timestamp = $item_date->format('U');
        }

      }
    }

    // Replace <span class="subbed"> with normal text.
    foreach ($data as &$item) {
      preg_match('/<span class=\"subbed\".*><br>(.*)<\/span>/', $item->address_1, $test);
      if (!empty($test)) {
        $item->address_1 = str_replace($test[0], ' ' . $test[1], $item->address_1);
      }
    }

    $this->processedData = $data;
  }

  /**
   * Normalize parameters.
   *
   * @param array $parameters
   *   Input parameters.
   *
   * @return array
   *   Normalized parameters.
   */
  static public function normalizeParameters($parameters) {
    $normalized = $parameters;

    $timezone = new \DateTimeZone(\Drupal::config('system.date')->get('timezone')['default']);

    // The old site has a habit to provide empty filter_date. Fix it here.
    if (empty($normalized['filter_date'])) {
      $date = DrupalDateTime::createFromTimestamp(REQUEST_TIME, $timezone);
      $normalized['filter_date'] = $date->format(self::$dateFilterFormat);
    }

    // Convert date parameter to timestamp.
    // Date parameter can by with leading zero or not.
    $origin_dtz = new \DateTimeZone(date_default_timezone_get());
    $remote_dtz = new \DateTimeZone(\Drupal::config('system.date')->get('timezone')['default']);
    $origin_dt = new \DateTime('now', $origin_dtz);
    $remote_dt = new \DateTime('now', $remote_dtz);
    $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);

    // Add offset. Function strtotime() uses default timezone.
    if ($timestamp = strtotime($normalized['filter_date'])) {
      $timestamp += $offset;
    }
    else {
      $date = DrupalDateTime::createFromTimestamp(REQUEST_TIME, $timezone);
      $timestamp = $date->format('U');
    }

    // Add timestamp.
    $normalized['filter_timestamp'] = $timestamp;

    // Finally, normalize filter_date.
    $date = DrupalDateTime::createFromTimestamp($normalized['filter_timestamp'], $timezone);
    $normalized['filter_date'] = $date->format(self::$dateFilterFormat);

    return $normalized;
  }

  /**
   * Check if results are empty.
   *
   * @return bool
   *   True if schedule is empty, false otherwise.
   */
  public function isEmpty() {
    return empty($this->rawData);
  }

  /**
   * Get PDF link to location schedule.
   *
   * @param int $location
   *   Location ID.
   * @param int $timestamp
   *   Timestamp.
   * @param int $category
   *   Category.
   *
   * @return \Drupal\Core\Url
   *   Link.
   */
  static public function getPdfLink($location, $timestamp = FALSE, $category = FALSE) {
    $uri = 'http://www.groupexpro.com/ymcatwincities/print.php';

    $query = [
      'font' => 'larger',
      'account' => GroupexRequestTrait::$account,
      'l' => $location,
    ];

    if ($timestamp) {
      $query['week'] = $timestamp;
    }

    if ($category) {
      $query['c'] = $category;
    }

    return Url::fromUri($uri, ['query' => $query]);
  }

}
