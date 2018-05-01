<?php


namespace App\Services\BinaryTree;

class SearchTree
{
    private $_root;

    public function __construct()
    {
        // setup sentinal node
        $this->_root = new Node(null);
    }

    public function getRoot()
    {
        return $this->hasNode() ? $this->_root->right : null;
    }

    public function insert(Node $node)
    {
        $this->_root->insert($node);

        return $this;
    }

    public function detect(Node $node)
    {
        return $this->hasNode() ? $this->_root->detect($node) : false;
    }

    public function delete(Node $node)
    {
        return $this->hasNode() ? $this->_root->delete($node, $this->_root, 'right') : false;
    }

    public function hasNode()
    {
        return (bool)$this->_root->right;
    }

    public function printTree()
    {
        if ($this->hasNode()) {
            $current_level[] = $this->_root->right;
            $next_level = array();
            while (!empty($current_level)) {
                $node = array_shift($current_level);
                if ($node) {
                    array_push($next_level, $node->left, $node->right);
                    echo $node->val . ' ';
                }
                if (empty($current_level) && !empty($next_level)) {
                    echo "\n";
                    list($current_level, $next_level) = array($next_level, $current_level);
                }
            }
        }
    }
}