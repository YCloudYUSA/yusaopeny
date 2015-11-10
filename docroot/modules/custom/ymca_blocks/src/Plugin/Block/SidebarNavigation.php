<?php

/**
 * @file
 * Contains YMCA SidebarNavigation block.
 */

namespace Drupal\ymca_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\draggableviews\DraggableViews;
use Drupal\node\Entity\Node;
use Drupal\views\Views;

/**
 * Provides SidebarNavigation block.
 *
 * @Block(
 *   id = "sidebar_navigation_block",
 *   admin_label = @Translation("Sidebar Navigation"),
 * )
 */
class SidebarNavigation extends BlockBase {

  /**
   * Draggableviews object.
   *
   * @var DraggableViews $draggableviews
   */
  public $draggableviews = NULL;

  /**
   * Context node.
   *
   * @var Node $context
   */
  public $context = NULL;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->context = \Drupal::request()->attributes->get('node');

    $view = Views::getView('draggabletest');
    $view->preview('page_1');
    $this->draggableviews = new DraggableViews($view);
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Get a flat list of items with id and parent_id.
    $list = [];
    foreach ($this->draggableviews->view->result as $index => $item) {
      $list[] = [
        '#markup' => \Drupal::l($item->_entity->label(), Url::fromRoute('entity.node.canonical', ['node' => $item->nid])),
        'id' => $item->nid,
        'parent_id' => (int) $item->draggableviews_structure_parent,
      ];
    }

    // Get an ancestor for the current context.
    $nid = $this->context->id();
    $parent = $this->getParent($nid);
    $ancestor = $this->getAncestor($nid);
    $depth = $this->getDepth($nid);

    // The list will be filtered by series of callbacks.
    // Filter out children of another branches.
    $filter = function($element) use ($ancestor) {
      if ($this->getAncestor($element['id']) != $ancestor && $this->getDepth($element['id']) > 0) {
        return FALSE;
      }
      return TRUE;
    };
    $list = array_filter($list, $filter);

    // Filter out children with depth grater then depth of context.
    $filter = function($element) use ($depth) {
      if ($this->getDepth($element['id']) > ($depth + 1)) {
        return FALSE;
      }
      return TRUE;
    };
    $list = array_filter($list, $filter);

    // Filter out siblings with another parent.
    $filter = function($element) use ($ancestor, $depth, $nid, $parent) {
      static $siblings = [];
      // Check if the element if sibling.
      if ($this->getAncestor($element['id']) == $ancestor && $this->getDepth($element['id']) == $depth && $element['id'] != $nid) {
        $siblings[] = $element['id'];
        // Another parent? Goodbye!
        if ($parent != $element['parent_id']) {
          return FALSE;
        }
      }
      // Element's parent is sibling? Goodbye!
      if (in_array($element['parent_id'], $siblings)) {
        return FALSE;
      }
      return TRUE;
    };
    $list = array_filter($list, $filter);

    // Finally generate the tree.
    $tree = $this->buildTree($list);

    return [
      '#theme' => 'item_list',
      '#items' => $tree,
    ];
  }

  /**
   * Get element ancestor.
   */
  protected function getAncestor($nid) {
    return $this->draggableviews->getValue('nid', $this->draggableviews->getAncestor($this->draggableviews->getIndex('nid', $nid)));
  }

  /**
   * Get element depth.
   */
  protected function getDepth($nid) {
    return $this->draggableviews->getDepth($this->draggableviews->getIndex('nid', $nid));
  }

  /**
   * Get element depth.
   */
  protected function getParent($nid) {
    return $this->draggableviews->getParent($this->draggableviews->getIndex('nid', $nid));
  }

  /**
   * Helper function to build a tree of elements.
   */
  protected function buildTree(array $elements, $parent_id = 0) {
    $branch = array();

    foreach ($elements as $element) {
      if ($element['parent_id'] == $parent_id) {
        $children = $this->buildTree($elements, $element['id']);
        if ($children) {
          $element['children'] = $children;
        }
        $branch[$element['id']] = $element;
      }
    }

    return $branch;
  }

}
