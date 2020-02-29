define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product_type/index' + location.search,
                    add_url: 'product_type/add',
                    edit_url: 'product_type/edit',
                    del_url: 'product_type/del',
                    multi_url: 'product_type/multi',
                    table: 'product_type',
                }
            });

            var table = $("#table");
            // 初始化表格
            // table.bootstrapTable({
            //     url: $.fn.bootstrapTable.defaults.extend.index_url,
            //     pk: 'id',
            //     sortName: 'id',
            //     escape:false,
            //     columns: [
            //         [
            //             {checkbox: true},
            //             {field: 'id', title: __('Id')},
            //             {field: 'name', title: __('Name'), align: 'left'},
            //             {field: 'pid', title: __('Pid')},
            //             {field: 'pid2', title: __('Pid2'),classname:"arrarr"},
            //             {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
            //             {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
            //             {field: 'pid', title: __('pid'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,buttons: [
            //                     {
            //                         name: 'detail',
            //                         text: __('添加子级'),
            //                         title: __('添加子级'),
            //                         classname: 'btn btn-xs btn-primary btn-dialog',
            //                         icon: 'fa fa-angellist',
            //                         url: 'product_type/addchildren',
            //                         hidden: function (row) {
            //                             alert(row.pid)
            //                             //返回true时按钮显示,返回false隐藏
            //                             if(row.pid != 0 ){
            //                                 return true
            //                             }
            //                         }
            //                     }
            //                 ]}
            //         ]
            //     ]
            // });

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


// //或者ajax
//         Fast.api.ajax({
//             type: 'POST',
//             url: url,
//             data: temp,
//         }, function (data, ret) {
//             //成功的回调
//             console.error(data);
//             return false;
//         }, function (data, ret) {
//             console.error(data);
//             return false;
//         });
//     });
    return Controller;

});