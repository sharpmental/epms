requirejs(['jquery', 'aci', 'bootstrap', 'bootstrapValidator', 'message', 'jquery-ui'],
function ($, aci) {
	
	$('#start_time').datepicker({
		dateFormat : "yy-mm-dd"
	});
	
    var validator_config = {
        message: '输入项不能为空',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            project_name: {
                validators: {
                    notEmpty: {
                        message: '请输入'
                    },
                    stringLength: {
                        min: 1,
                        max: 30,
                        message: '请为2到30个字符之间'
                    },
                }
            },
            project_des: {
                validators: {
                    notEmpty: {
                        message: '请输入'
                    },
                    stringLength: {
                        min: 1,
                        max: 128,
                        message: '请为2到128个字符之间'
                    },
                }
            },
            start_time: {
                validators: {
                    notEmpty: {
                        message: '请输入'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
                    }
                }
            },
            address: {
                validators: {
                    notEmpty: {
                        message: '请输入'
                    },
                    stringLength: {
                        min: 1,
                        max: 128,
                        message: '请为2到128个字符之间'
                    },
                }
            },
            construction: {
                validators: {
                    notEmpty: {
                        message: '请输入'
                    },
                    stringLength: {
                        min: 1,
                        max: 128,
                        message: '请为2到128个字符之间'
                    },
                }
            },
            slop: {
                validators: {
                    notEmpty: {
                        message: '请输入'
                    },
                    stringLength: {
                        min: 1,
                        max: 128,
                        message: '请为2到128个字符之间'
                    },
                }
            },
        }
    };

$('#addform').bootstrapValidator(validator_config);

});