<?php
namespace Drupal\first_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\node\Entity\Node;

class NodeController extends ControllerBase
{
    public function dataList()
    {
        $query = \Drupal::entityQuery('node')
            ->condition('type', 'artist') // Specify the content type
            ->condition('status', 1);
        $artistNids = $query->execute();
        \Drupal::service('cache_tags.invalidator')->invalidateTags(['node_list:artist']);

        $artists = \Drupal\node\Entity\Node::loadMultiple($artistNids);
        $data = [];
        foreach ($artists as $artist) {
            $data[] = [
                'id' => $artist->id(),
                'name' => $artist->field_name->value,
                'profession' => $artist->field_profession->value,
                'email' => $artist->field_email->value,

            ];
        }
        // print_r($data);
        // die;

        return array(
            '#theme' => 'node_template',
            '#artists' => $data,
        );
    }



    public function deleteEntry($id = false)
    {
        // Load the node by its ID.
        $node = Node::load($id);

        // Check if the node exists and has the correct content type.
        if ($node && $node->getType() == 'artist') {
            // Delete the node.
            $node->delete();
            \Drupal::messenger()->addMessage(t('Node deleted successfully.'));
        } else {
            \Drupal::messenger()->addError(t('Node not found or invalid content type.'));
        }

        // Redirect to some page.
        return $this->redirect('first_module.nodeData');
    }

}
?>