<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/1/001
 * Time: 0:00
 */
namespace App\Http\Controllers\Common;

class CreateTreeController
{
    //创建二叉树

    public $index;//索引
    public $value;//值
    public $lChild;//左孩子
    public $rChild;//右孩子
    public $parentNode;//父节点

    /**
     * CreateTreeController constructor.初始化节点
     * @param $index
     * @param $value
     * @param $lChild
     * @param $rChild
     * @param $parentNode
     */
    public function __construct($index,$value,CreateTreeController $lChild=null,CreateTreeController $rChild=null,CreateTreeController $parentNode=null)
    {
        $this->index      = $index;
        $this->value      = $value;
        $this->lChild     = $lChild;
        $this->rChild     = $rChild;
        $this->parentNode = $parentNode;
    }

    /**
     * 搜素节点
     * @param $nodeIndex
     * @return $this|null
     *
     */
    public function searchNode($nodeIndex)
    {
        if ($this->index == $nodeIndex) {
            return $this;
        }
        //如果左孩子不为null
        if ($this->lChild != null) {
            //如果左孩子的索引等于它
            if ($this->lChild->index == $nodeIndex) {
                return $this->lChild;
            } else {
                $tempNode = $this->lChild->searchNode($nodeIndex);
                if ($tempNode != null) return $tempNode;
            }
        }
        //如果右孩子不为null
        if ($this->rChild != null) {
            if ($this->rChild->index == $nodeIndex) {
                return $this->rChild;
            } else {
                $tempNode = $this->rChild->searchNode($nodeIndex);
                if ($tempNode != null) return $tempNode;
            }
        }
        return null;
    }

    /**
     * 删除节点
     */
    public function deleteNode()
    {
        if ($this->lChild != null) {
            $this->lChild->deleteNode();
        }
        if ($this->rChild != null) {
            $this->rChild->deleteNode();
        }
        if ($this->parentNode != null) {
            if ($this->parentNode->lChild == $this) {
                $this->parentNode->lChild = null;
            } elseif ($this->parentNode->rChild == $this) {
                $this->parentNode->rChild = null;
            }
        }
        //unset($this);
    }

    /**
     * 节点前序遍历
     */
    public function PreOrderTraversal()
    {
        echo $this->value;
        if ($this->lChild != null) {
            $this->lChild->PreOrderTraversal();
        }
        if ($this->rChild != null) {
            $this->rChild->PreOrderTraversal();
        }
    }

    /**
     * 节点后序遍历
     */
    public function InOrderTraversal()
    {
        if ($this->lChild != null) {
            $this->lChild->PreOrderTraversal();
        }
        echo $this->value;
        if ($this->rChild != null) {
            $this->rChild->PreOrderTraversal();
        }
    }

    /**
     * 节点后序遍历
     */
    public function PostOrderTraversal()
    {
        if ($this->lChild != null) {
            $this->lChild->PreOrderTraversal();
        }
        if ($this->rChild != null) {
            $this->rChild->PreOrderTraversal();
        }
        echo $this->value;
    }
}