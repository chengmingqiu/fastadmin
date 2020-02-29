define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'news/index' + location.search,
                    add_url: 'news/add',
                    edit_url: 'news/edit',
                    del_url: 'news/del',
                    multi_url: 'news/multi',
                    table: 'news',
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
                        {field: 'id', title: __('新闻Id')},
                        {field: 'title', title: __('新闻标题'),formatter: function(value){return value.toString().substr(0, 10)}},
                        {field: 'text', title: __('新闻内容'),formatter: function(value){return value.toString().substr(0, 20)}},
                        {field: 'image', title: __('封面'), events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'type', title: __('类型'),formatter:function(value){
                                if (value == 1) {
                                    return '咨询';
                                } else if (value == 2) {
                                    return '热点';
                                } else if (value == 3){
                                    return '活动';
                                }
                            }},
                        {field: 'reading', title: __('阅览量')},
                        {field: 'is_show', title: __('轮播图展示'),formatter:function(value){
                                if (value == 1) {
                                    return '是';
                                } else if (value == 0) {
                                    return '否';
                                }
                            }},
                        {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
        }
    };
    return Controller;
});