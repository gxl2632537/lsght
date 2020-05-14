define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'store/index' + location.search,
                    add_url: 'store/add',
                    edit_url: 'store/edit',
                    del_url: 'store/del',
                    multi_url: 'store/multi',
                    table: 'store',
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
                        {field: 'manage_name', title: __('Manage_name')},
                        {field: 'description', title: __('Description')},
                        {field: 'logo_img', title: __('Logo_img'),events: Table.api.events.image,formatter:Table.api.formatter.image,function (value, row, index) {
                                value = value ? value : '/assets/img/blank.gif';
                                var classname = typeof this.classname !== 'undefined' ? this.classname : 'img-sm img-center';
                                return '<a href="javascript:"><img class="' + classname + '" src="' + Fast.api.cdnurl(value) + '" /></a>';
                            }},
                        {field: 'manage_status', title: __('经营状态'),formatter:function (val) {
                            if(val == 1){
                                return '营业中';
                            }else {
                                return '休息中';
                            }
                            }},
                        {field: 'manage_time', title: __('Manage_time')},
                        {field: 'longitude', title: __('Longitude')},
                        {field: 'dimension', title: __('Dimension')},
                        {field: 'city', title: __('省市区')},
                        {field: 'detail', title: __('Detail')},
                        {field: 'manage_contacts', title: __('Manage_contacts')},
                        {field: 'manage_tel', title: __('Manage_tel')},
                        {field: 'manage_notice', title: __('Manage_notice')},
                        {field: 'head_contacts', title: __('Head_contacts')},
                        {field: 'head_tel', title: __('Head_tel')},
                        {field: 'status', title: __('状态'),formatter:function (val) {
                                if(val == 1){
                                    return '正常';
                                }else {
                                    return '关闭';
                                }
                            }},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        recyclebin: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    'dragsort_url': ''
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: 'store/recyclebin' + location.search,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {
                            field: 'deletetime',
                            title: __('Deletetime'),
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Table.api.formatter.datetime
                        },
                        {
                            field: 'operate',
                            width: '130px',
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'Restore',
                                    text: __('Restore'),
                                    classname: 'btn btn-xs btn-info btn-ajax btn-restoreit',
                                    icon: 'fa fa-rotate-left',
                                    url: 'store/restore',
                                    refresh: true
                                },
                                {
                                    name: 'Destroy',
                                    text: __('Destroy'),
                                    classname: 'btn btn-xs btn-danger btn-ajax btn-destroyit',
                                    icon: 'fa fa-times',
                                    url: 'store/destroy',
                                    refresh: true
                                }
                            ],
                            formatter: Table.api.formatter.operate
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
        }
    };
    return Controller;
});