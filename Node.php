<?php


namespace App\Services\BinaryTree;

class Node
{
    public $val;
    /**@var Node $left */
    public $left = null;
    /**@var Node $right */
    public $right = null;

    function __construct($val)
    {
        $this->val = $val;
    }

    public function insert(Node $node)
    {
        if ($node->val < $this->val) {
            return $this->left ? $this->left->insert($node) : ($this->left = $node);
        }

        if ($node->val > $this->val) {
            return $this->right ? $this->right->insert($node) : ($this->right = $node);
        }

        return false;
    }

    public function detect(Node $node)
    {
        if ($node->val < $this->val) {
            return $this->left && $this->left->detect($node);
        }

        if ($node->val > $this->val) {
            return $this->right && $this->right->detect($node);
        }

        return true;
    }

    public function delete(Node $node, Node $parent = null, $left_right = '')
    {
        if ($node->val < $this->val) {
            return $this->left && $this->left->delete($node, $this, 'left');
        }

        if ($node->val > $this->val) {
            return $this->right && $this->right->delete($node, $this, 'right');
        }

        if ($this->left) {
            $parent->$left_right = $this->left;
            $this->right &&  $parent->$left_right->insert($this->right);
        } elseif ($this->right) {
            $parent->$left_right = $this->right;
            $this->left &&  $parent->$left_right->insert($this->left);
        } else {
            $parent->$left_right = null;
        }

        return true;
    }
}