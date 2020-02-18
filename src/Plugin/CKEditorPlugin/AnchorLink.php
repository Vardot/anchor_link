<?php

namespace Drupal\anchor_link\Plugin\CKEditorPlugin;

use Drupal\editor\Entity\Editor;
use Drupal\ckeditor\CKEditorPluginBase;

/**
 * Defines the "link" plugin.
 *
 * @CKEditorPlugin(
 *   id = "link",
 *   label = @Translation("CKEditor Web link"),
 *   module = "anchor_link"
 * )
 */
class AnchorLink extends CKEditorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return $this->getLibraryPath() . '/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return [
      'fakeobjects',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    $path = $this->getLibraryPath();

    return [
      'Link' => [
        'label' => $this->t('Link'),
        'image' => $path . '/icons/link.png',
      ],
      'Unlink' => [
        'label' => $this->t('Unlink'),
        'image' => $path . '/icons/unlink.png',
      ],
      'Anchor' => [
        'label' => $this->t('Anchor'),
        'image' => $path . '/icons/anchor.png',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

  /**
   * Get the CKEditor Link library path.
   */
  protected function getLibraryPath() {

    $path = DRUPAL_ROOT . ANCHOR_LINK_LIBRARY_PATH;

    // Is the library found in the root libraries path.
    $library_found = file_exists($path);

    // If library is not found, then look in the current profile libraries path.
    if (!$library_found) {
      $profile_path = drupal_get_path('profile', \Drupal::installProfile());
      $profile_path .= ANCHOR_LINK_LIBRARY_PATH;
      // Is the library found in the current profile libraries path.
      $library_found = file_exists(DRUPAL_ROOT . $profile_path);
      $path = DRUPAL_ROOT . $profile_path;
    }

    if ($library_found) {
      return $path;
    }
    else {
      return 'libraries/link';
    }
  }

}
