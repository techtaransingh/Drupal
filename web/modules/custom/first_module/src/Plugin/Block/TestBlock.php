<?php

namespace Drupal\first_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a custom block.
 *
 * @Block(
 *   id = "first_module_test_block",
 *   admin_label = @Translation("Test Block"),
 * )
 */
class TestBlock extends BlockBase
{

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            '#markup' => $this->t('Hello, this is my custom block!'),
        ];
    }

}