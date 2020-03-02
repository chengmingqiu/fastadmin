define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'series/series/index' + location.search,
                    add_url: 'series/series/add',
                    edit_url: 'series/series/edit',
                    del_url: 'series/series/del',
                    multi_url: 'series/series/multi',
                    table: 'series/series',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'title', title: __('Title')},
                        {field: 'brief', title: __('Brief')},
                        {field: 'type', title: __('type') },
                        {field: 'pid', title: __('Pid')                    },
                        // {field: 'content', title: __('Content')},
                        {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'operate', title: __('Operate'), table: table ,events: Table.api.events.operate, formatter: Table.api.formatter.operate,
                        buttons: [
                                {
                                    name: 'detail',
                                    text: __('添加子级'),
                                    title: __('添加子级'),
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    icon: 'fa fa-angellist',
                                    url: 'series/series/addchildren',
                                    hidden: function (row) {
                                        if(row.pid != 0){
                                            //返回true时按钮显示,返回false隐藏
                                            return true;
                                        }
                                    }
                                }
                            ]

                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        },
         addchildren:function(){
            Controller.api.bindevent();
        },
    };
    return Controller;
});