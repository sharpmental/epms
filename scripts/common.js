var SITE_URL = "/";
require.config({
	baseUrl: '/scripts',
    paths: {
        "jquery": "lib/jquery", 
        "jquery-ui": "lib/jquery-ui", 
		"jquery-ui-dialog-extend": "lib/jquery-ui-dialog-extend", 
        "underscore": "lib/underscore",
        "bootstrap": "lib/bootstrap", 
		"validationEngine": "lib/jquery.validationEngine", 
		"validationEngineLang": "lib/jquery.validationEngine-zh_CN", 
		"bootstrapValidator": "lib/bootstrapValidator", 
		"formValidation": "lib/formValidation.min", 
		"aci":"lib/aci",
		"message":"lib/sco.message",
		"confirm":"lib/sco.confirm",
		"modal":"lib/sco.modal",
		"headroom":"lib/headroom.min",
        "cookie":"lib/jquery.cookie"
    },
    shim: {
        "jquery-ui": {
            exports: "$",
            deps: ['jquery']
        },
        "cookie": {
            exports: "$",
            deps: ['jquery']
        },
        "underscore": {
            exports: "_"
        },
        "bootstrapValidator": {
            exports: "$",
            deps: [ "jquery"]
        },
        "bootstrap": ['jquery'],
		"validationEngine": ['validationEngineLang'],
		"jquery-ui-dialog-extend": ['jquery-ui'],
		"aci": ['jquery'],
		"message": {
            exports: "$",
            deps: ['jquery']
        },
		"confirm": {
            exports: "$",
            deps: ['jquery']
        },
		"modal": {
            exports: "$",
            deps: ['jquery']
        },
		"headroom": {
            exports: "$",
            deps: ['jquery']
        },
    }

});

