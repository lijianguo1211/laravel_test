<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/1/001
 * Time: 0:33
 */
namespace App\Http\Controllers\Common;

class CreateTreeRootController
{
    /**
     * 二叉树节点类
     */

    protected $root;

    /**
     * CreateTreeRootController constructor.创建树初始化根节点
     * @param $index
     * @param $value
     */
    public function __construct($index,$value)
    {
        $tree = new CreateTreeController($index,$value);
        $this->root = $tree;
    }

    /**
     * 搜素节点
     */
    public function SearchNode($nodeIndex)
    {
        return $this->root->searchNode($nodeIndex);
    }

    /**
     * 添加节点
     * @param $nodeIndex 要添加的节点
     * @param $direction 0左节点，1右节点
     * @param $node 父节点
     * @return bool
     */
    public function AddNode($nodeIndex,$direction,CreateTreeController $node)
    {
        $searchResult = $this->root->SearchNode($nodeIndex);
        if($searchResult != null){
            if($direction == 0){
                $searchResult->lChild = $node;
                $searchResult->lChild->parentNode = $searchResult;
            }elseif($direction == 1){
                $searchResult->rChild = $node;
                $searchResult->rChild->parentNode = $searchResult;
            }
        }else{
            return false;
        }
    }

    /**
     * 删除节点
     */
    public function DeleteNode($nodeIndex)
    {
        if($this->searchNode($nodeIndex) != null){
            $this->searchNode($nodeIndex)->DeleatNode();
        }
    }

    /**
     * 前序遍历
     */
    public function PreOrderTraversal()
    {
        $this->root->PreOrderTraversal();
    }

    /**
     * 中序遍历
     */
    public function InOrderTraversal()
    {
        $this->root->InOrderTraversal();
    }

    /**
     * 后序遍历
     */
    public function PostOrderTraversal()
    {
        $this->root->PostOrderTraversal();
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        //unset($this);
    }

}