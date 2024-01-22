<?php

namespace Drupal\event_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for event_module routes.
 */
class EventModuleController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
