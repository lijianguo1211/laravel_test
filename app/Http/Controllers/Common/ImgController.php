<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27/027
 * Time: 20:06
 */
namespace App\Http\Common;
Class ImgController
{
    //画图

    /*
     * 概念：
     *
     * 树（tree）是包含n（n>0）个结点的有穷集
     * 【树是又根节点和若干子树构成的，树是由一个集合以及该集合上定义的一种关系构成的；集合中的元素称为树的节点
     * ，所定义的关系称为父子树，父子关系在树的节点之间建立了一种层的结构，在这种层次结构中有一个结点具有特殊的地位，这个结点称为该树的根结点，或称为树根。】
     *
     * 每个元素称为节点 node
     *
     * 有一个特定的节点称之为根节点或树根root
     *
     * 除根节点之外的所有数据元素被分为m【m >= 0】个互不相交的集合T1，T2， 。。。T（m-1）,其中每一个集合
     * 也是一棵树【Ti（0<i<m）】,被称为原树的子树
     *
     * 节点的度【一个节点含有子树的个数称为节点的度】
     * 叶节点或终端节点【度为0的节点称为终端节点】
     * 非终端节点或分支节点【度不为0的节点】
     * 双亲节点或父节点【若一个节点含有子节点，那么该节点就是这个子节点的父节点】
     * 孩子节点或子节点【一个节点含有子树的根节点，称为该节点的子节点】
     * 兄弟节点【具有相同父节点的节点称为兄弟节点】
     * 树的度【一棵树中，最大的节点的度称为树的度】
     * 节点的层次【从根开始定义起，根为第1层，根的子节点为第2层，以此类推】
     * 树的高度或深度【树中节点的最大层次】
     * 堂兄弟节点【双亲在同一层的节点互为堂兄弟】
     * 节点的祖先【从根到该节点所经分支上的所有节点】
     * 子孙【以某节点为根的子树中任一节点都称为该节点的子孙】
     * 森林【由m（m>=0）棵互不相交的树的集合称为森林】
     * */

    //树相关设置
    //每层之间的间隔高度
    private $level_high = 100;
    //最底层叶子结点之间的宽度
    private $leaf_width = 50;
    //结点圆的半径
    private $rad = 20;
    //根节点离边框顶端距离
    private $leave = 20;
    //树（保存树对象的引用）
    private $tree;
    //树的层数
    private $level;
    //完全二叉树中最底层叶子结点数量（计算图像宽度时用到，论如何实现图片大小自适应）
    private $maxCount;

    //图像相关设置
    //画布宽度
    private $width;
    //画布高度
    private $height;
    //画布背景颜色（RGB）
    private $bg = array(
        220, 220, 220
    );
    //节点颜色（搜索二叉树和平衡二叉树时用）
    private $nodeColor = array(
        255, 192, 203
    );
    //图像句柄
    private $image;

    /**
     * 构造函数，类属性初始化
     * @param $tree 传递一个树的对象
     * @return null
     */
    public function __construct($tree)
    {
        $this->tree = $tree;
        $this->level = $this->getLevel();
        $this->maxCount = $this->GetMaxCount($this->level);
        $this->width = ($this->rad * 2 * $this->maxCount) + $this->maxCount * $this->leaf_width;
        $this->height = $this->level * ($this->rad * 2) + $this->level_high * ($this->level - 1) + $this->leave;
        //1.创建画布
        $this->image = imagecreatetruecolor($this->width, $this->height); //新建一个真彩色图像，默认背景是黑色
        //填充背景色
        $bgcolor = imagecolorallocate($this->image, $this->bg[0], $this->bg[1], $this->bg[2]);
        imagefill($this->image, 0, 0, $bgcolor);
    }

    /**
     * 返回传进来的树对象对应的完全二叉树中最底层叶子结点数量
     * @param $level 树的层数
     * @return 结点数量
     */
    function GetMaxCount($level)
    {
        return pow(2, $level - 1);
    }

    /**
     * 获取树对象的层数
     * @param null
     * @return 树的层数
     */
    function getLevel()
    {
        return $this->tree->Depth();
    }

    /**
     * 显示二叉树图像
     * @param null
     * @return null
     */
    public function show()
    {
        $this->draw($this->tree->root, 1, 0, 0);
        header("Content-type:image/png");
        imagepng($this->image);
        imagedestroy($this->image);
    }

    /**
     * （递归）画出二叉树的树状结构
     * @param $root，根节点（树或子树） $i，该根节点所处的层 $p_x，父节点的x坐标 $p_y,父节点的y坐标
     * @return null
     */
    private function draw($root, $i, $p_x, $p_y)
    {
        if ($i <= $this->level) {
            //当前节点的y坐标
            $root_y = $i * $this->rad + ($i - 1) * $this->level_high;
            //当前节点的x坐标
            if (!is_null($parent = $root->parent)) {
                if ($root == $parent->left) {
                    $root_x = $p_x - $this->width / (pow(2, $i));
                } else {
                    $root_x = $p_x + $this->width / (pow(2, $i));
                }
            } else {
                //根节点
                $root_x = (1 / 2) * $this->width;
                $root_y += $this->leave;
            }

            //画结点（确定所画节点的类型（平衡、红黑、排序）和方法）
            $method = 'draw' . get_class($this->tree) . 'Node';
            $this->$method($root_x, $root_y, $root);

            //将当前节点和父节点连线（黑色线）
            $black = imagecolorallocate($this->image, 0, 0, 0);
            if (!is_null($parent = $root->parent)) {
                imageline($this->image, $p_x, $p_y, $root_x, $root_y, $black);
            }

            //画左子节点
            if (!is_null($root->left)) {
                $this->draw($root->left, $i + 1, $root_x, $root_y);
            }
            //画右子节点
            if (!is_null($root->right)) {
                $this->draw($root->right, $i + 1, $root_x, $root_y);
            }
        }
    }

    /**
     * 画搜索二叉树结点
     * @param $x，当前节点的x坐标 $y，当前节点的y坐标 $node，当前节点的引用
     * @return null
     */
    private function drawBstNode($x, $y, $node)
    {
        //节点圆的线颜色
        $black = imagecolorallocate($this->image, 0, 0, 0);
        $nodeColor = imagecolorallocate($this->image, $this->nodeColor[0], $this->nodeColor[1], $this->nodeColor[2]);
        //画节点圆
        imageellipse($this->image, $x, $y, $this->rad * 2, $this->rad * 2, $black);
        //节点圆颜色填充
        imagefill($this->image, $x, $y, $nodeColor);
        //节点对应的数字
        imagestring($this->image, 4, $x, $y, $node->key, $black);
    }

    /**
     * 画平衡二叉树结点
     * @param $x，当前节点的x坐标 $y，当前节点的y坐标 $node，当前节点的引用
     * @return null
     */
    private function drawAvlNode($x, $y, $node)
    {
        $black = imagecolorallocate($this->image, 0, 0, 0);
        $nodeColor = imagecolorallocate($this->image, $this->nodeColor[0], $this->nodeColor[1], $this->nodeColor[2]);
        imageellipse($this->image, $x, $y, $this->rad * 2, $this->rad * 2, $black);
        imagefill($this->image, $x, $y, $nodeColor);
        imagestring($this->image, 4, $x, $y, $node->key . '(' . $node->bf . ')', $black);
    }

    /**
     * 画红黑树结点
     * @param $x，当前节点的x坐标 $y，当前节点的y坐标 $node，当前节点的引用
     * @return null
     */
    private function drawRbtNode($x, $y, $node)
    {
        $black = imagecolorallocate($this->image, 0, 0, 0);
        $gray = imagecolorallocate($this->image, 180, 180, 180);
        $pink = imagecolorallocate($this->image, 255, 192, 203);
        imageellipse($this->image, $x, $y, $this->rad * 2, $this->rad * 2, $black);
        if ($node->IsRed == TRUE) {
            imagefill($this->image, $x, $y, $pink);
        } else {
            imagefill($this->image, $x, $y, $gray);
        }
        imagestring($this->image, 4, $x, $y, $node->key, $black);
    }
}