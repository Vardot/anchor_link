<?php

namespace Drupal\anchor_link\Hook;

use Drupal\ckeditor5\Plugin\CKEditor5PluginDefinition;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Hook\Attribute\Hook;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Hook implementations for anchor_link.
 */
class AnchorLinkHooks {
  use StringTranslationTrait;

  /**
   * Implements hook_help().
   */
  #[Hook('help')]
  public function help($route_name, RouteMatchInterface $route_match) {
    switch ($route_name) {
      // Main module help for the entity_link module.
      case 'help.page.anchor_link':
        $output = '';
        $output .= '<h3>' . $this->t('About') . '</h3>';
        $output .= '<p>' . $this->t('This plugin module adds the better link dialog and anchor related features to CKEditor in Drupal 9') . '</p>';
        $output .= '<p><ul>';
        $output .= '  <li>Dialog to insert links and anchors with some properties.</li>';
        $output .= '  <li>Context menu option to edit or remove links and anchors.</li>';
        $output .= '  <li>Ability to insert a link with the URL using multiple protocols, including an external file if a file manager is integrated.</li>';
        $output .= '</ul></p>';
        return $output;

      default:
    }
  }

  /**
   * Implements hook_ckeditor5_plugin_info_alter().
   */
  #[Hook('ckeditor5_plugin_info_alter')]
  public static function ckeditor5PluginInfoAlter(array &$plugin_definitions): void {
    $plugins_to_override = [
      'ckeditor5_arbitraryHtmlSupport',
    ];
    foreach ($plugins_to_override as $plugin_id) {
      if (!isset($plugin_definitions[$plugin_id])) {
        return;
      }
      $plugin_definition = $plugin_definitions[$plugin_id]->toArray();
      // Make plugin-specific alterations. Disallow the General HTML Support
      // plugin from controlling links with the attributes handled by the
      // Anchor plugin.
      $plugin_definition['ckeditor5']['config']['htmlSupport']['disallow'][] = [
        'name' => 'a',
        'attributes' => [
          'id',
          'name',
        ],
        'classes' => [
          'ck-anchor',
        ],
      ];
      // Update plugin definitions.
      $plugin_definitions[$plugin_id] = new CKEditor5PluginDefinition($plugin_definition);
    }
  }

}
