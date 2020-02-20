<?php

namespace Drupal\anchor_link\Plugin\CKEditorPlugin;

use Drupal\editor\Entity\Editor;
use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\anchor_link\Library\AnchorLinkLibrary;

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
    static $library_path;

    // Return early if we've already looked it up.
    if ($library_path) {
      return $library_path;
    }

    $path = AnchorLinkLibrary::PATH;

    // Is the library found in the root libraries path.
    $library_found = file_exists(DRUPAL_ROOT . $path);

    // If library is not found, then look in the current profile libraries path.
    if (!$library_found) {
      $profile_path = drupal_get_path('profile', \Drupal::installProfile());
      $profile_path .= AnchorLinkLibrary::PATH;
      // Is the library found in the current profile libraries path.
      $library_found = file_exists(DRUPAL_ROOT . $profile_path);
      $path = $profile_path;
    }

    if ($library_found) {
      $library_path = $path;
    }
    else {
      $library_path = 'libraries/link';
    }

    return $library_path;
  }

}
