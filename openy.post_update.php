<?php

/**
 * @file
 * Post update functions for Website Services Distribution.
 */

/**
 * Cleanup upgrade path message errors.
 *
 * We cannot prevent this upgrade path messages from being created.
 */
function openy_post_update_cleanup_update_path_messages(&$sandbox) {
  // Here we clean up messages that appeared in the message log during
  // last 5 minutes. These messages are generated by
  // node_post_update_configure_status_field_widget() and cannot be handled
  // by upgrade path tool, because Drupal Core automatically
  // increases weight which doesn't match database.
  // @see node_post_update_configure_status_field_widget()
  $range = strtotime("-5 minutes");
  if (!isset($sandbox['progress'])) {
    $sandbox['progress'] = 0;
    $sandbox['current'] = 0;
    $sandbox['max'] = \Drupal::entityQuery('openy_upgrade_log')
      ->accessCheck(FALSE)
      ->condition('name', 'core.entity_form_display.node', 'STARTS_WITH')
      ->condition('created', $range, '>')
      ->count()
      ->execute();

    // Limit updates for non-acquia environments.
    if (empty($_ENV['AH_SITE_ENVIRONMENT'])) {
      $sandbox['max'] = min($sandbox['max'], 20);
    }
  }

  $ids = \Drupal::entityQuery('openy_upgrade_log')
    ->accessCheck(FALSE)
    ->condition('name', 'core.entity_form_display.node', 'STARTS_WITH')
    ->condition('created', $range, '>')
    ->range(0, 20)
    ->execute();
  $storage_handler = \Drupal::entityTypeManager()->getStorage('openy_upgrade_log');
  $entities = $storage_handler->loadMultiple($ids);
  foreach ($entities as $entity) {
    $sandbox['progress']++;
    $sandbox['current'] = $entity->id();
    $entity->delete();
  }

  $sandbox['#finished'] = empty($sandbox['max']) ? 1 : ($sandbox['progress'] / $sandbox['max']);
  return t('@count Entities were deleted.', ['@count' => $sandbox['max']]);
}
