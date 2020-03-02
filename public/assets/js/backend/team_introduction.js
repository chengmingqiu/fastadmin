define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'team_introduction/index' + location.search,
                    add_url: 'team_introduction/add',
                    edit_url: 'team_introduction/edit',
                    del_url: 'team_introduction/del',
                    multi_url: 'team_introduction/multi',
                    table: 'team_introduction',
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
                        {field: 'name', title: __('标题')},
                        {field: 'content', title: __('内容'),formatter: function(value){return value.toString().substr(0, 20)}},
                        {field: 'image', title: __('封面'), events: Table.api.events.image, formatter: Table.api.formatter.image},

                        {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'is_show', title: __('展示为首页'),formatter:function(value){
                                if (value == 1) {
                                    return '是';
                                } else if (value == 0) {
                                    return '否';
                                }
                            }},
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