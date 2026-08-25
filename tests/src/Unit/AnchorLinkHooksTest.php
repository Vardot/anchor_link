<?php

namespace Drupal\Tests\anchor_link\Unit;

use Drupal\anchor_link\Hook\AnchorLinkHooks;
use Drupal\ckeditor5\Plugin\CKEditor5PluginDefinition;
use Drupal\Tests\UnitTestCase;

/**
 * Tests the alteration of the CKEditor 5 plugin definitions.
 *
 * @coversDefaultClass \Drupal\anchor_link\Hook\AnchorLinkHooks
 *
 * @group anchor_link
 */
class AnchorLinkHooksTest extends UnitTestCase {

  /**
   * Builds a plugin definition of the arbitrary HTML support plugin.
   */
  protected function arbitraryHtmlSupportDefinition(): CKEditor5PluginDefinition {
    return new CKEditor5PluginDefinition([
      'id' => 'ckeditor5_arbitraryHtmlSupport',
      'provider' => 'ckeditor5',
      'ckeditor5' => [
        'plugins' => ['htmlSupport.GeneralHtmlSupport'],
        'config' => [
          'htmlSupport' => [
            'allow' => [['name' => '/.*/', 'attributes' => TRUE]],
          ],
        ],
      ],
      'drupal' => [
        'label' => 'Arbitrary HTML support',
        'elements' => FALSE,
      ],
    ]);
  }

  /**
   * The anchor attributes are taken away from General HTML Support.
   *
   * @covers ::ckeditor5PluginInfoAlter
   */
  public function testAnchorAttributesAreTakenFromGeneralHtmlSupport(): void {
    $definitions = [
      'ckeditor5_arbitraryHtmlSupport' => $this->arbitraryHtmlSupportDefinition(),
    ];

    AnchorLinkHooks::ckeditor5PluginInfoAlter($definitions);

    $disallowed = $definitions['ckeditor5_arbitraryHtmlSupport']
      ->toArray()['ckeditor5']['config']['htmlSupport']['disallow'];

    $this->assertContains([
      'name' => 'a',
      'attributes' => ['id', 'name'],
      'classes' => ['ck-anchor'],
    ], $disallowed);
  }

  /**
   * Definitions without the plugin are left as they came in.
   *
   * @covers ::ckeditor5PluginInfoAlter
   */
  public function testDefinitionsWithoutGeneralHtmlSupportAreLeftAlone(): void {
    $definitions = [];

    AnchorLinkHooks::ckeditor5PluginInfoAlter($definitions);

    $this->assertSame([], $definitions);
  }

}
