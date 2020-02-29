// define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

//     var Controller = {
//         index: function () {
//             // 初始化表格参数配置
//             Table.api.init({
//                 extend: {
//                     index_url: 'product/index' + location.search,
//                     add_url: 'product/add',
//                     edit_url: 'product/edit',
//                     del_url: 'product/del',
//                     multi_url: 'product/multi',
//                     table: 'product',
//                 }
//             });

//             var table = $("#table");

//             // 初始化表格
//             table.bootstrapTable({
//                 url: $.fn.bootstrapTable.defaults.extend.index_url,
//                 pk: 'id',
//                 sortName: 'id',
//                 columns: [
//                     [
//                         {checkbox: true},
//                         {field: 'id', title: __('Id')},
//                         {field: 'name', title: __('Name')},
//                         {field: 'brief', title: __('简介')},
//                         {field: 'price', title: __('Price'), operate:'BETWEEN'},
//                         {field: 'component', title: __('Component')},
//                         {field: 'image', title: __('Image'), events: Table.api.events.image, formatter: Table.api.formatter.image},
//                         // {field: 'is_stock', title: __('存货'),formatter:function(value){
//                         //         if (value == 1) {
//                         //             return '是';
//                         //         } else if (value == 0) {
//                         //             return '否';
//                         //         }
//                         //     }},
//                         {field: 'content', title: __('Content'),formatter: function(value){return value.toString().substr(0, 20)}},
//                         {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
//                         {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
//                         {field: 'specs', title: __('Specs')},
//                         {field: 'brand.name', title: __('Brand.name')},
//                         {field: 'producttype.name', title: __('Producttype.name')},
//                         {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
//                     ]
//                 ]
//             });

//             // 为表格绑定事件
//             Table.api.bindevent(table);
//         },
//         add: function () {
//             Controller.api.bindevent();
//         },
//         edit: function () {
//             Controller.api.bindevent();
//         },
//         api: {
//             bindevent: function () {
//                 Form.api.bindevent($("form[role=form]"));
//             }
//         }
//     };
//     return Controller;
// });