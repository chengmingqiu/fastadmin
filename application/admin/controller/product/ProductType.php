<?php

namespace app\admin\controller\product;

use app\common\controller\Backend;
use think\Db;
use fast\Tree;

/**
 * 产品分类
 *
 * @icon fa fa-circle-o
 */
class ProductType extends Backend
{
    
    /**
     * ProductType模型对象
     * @var \app\admin\model\ProductType
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\ProductType;

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = false;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField'))
            {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {
                $row->visible(['id','name','pid','create_time','update_time']);
                
            }
            $list = collection($list)->toArray();
            Tree::instance()->init($list);
            $this->newstypelist = Tree::instance()->getTreeList(Tree::instance()->getTreeArray(0), 'name');
            $result = array("total" => $total, "rows" => $this->newstypelist);

            return json($result);
        }
        return $this->view->fetch();
    }
    
    public function addchildren($ids = null){
        $row = $this->model->get($ids);
        if ($this->request->isAjax()) {
            $params = $this->request->post("row/a");
            $params['pid'] = $ids;
            Db::startTrans();
            try{
                $result = $this->model->data($params,true)->isUpdate(false)->save();
                Db::commit();
            } catch (ValidateException $e) {
                Db::rollback();
                $this->error($e->getMessage());
            }
            if ($result !== false) {
                $this->success();
            } else {
                $this->error(__('No rows were inserted'));
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }
}
