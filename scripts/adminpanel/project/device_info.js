requirejs([ 'jquery', 'bootstrap', 'bootstrap-tree'  ], function($) {
	$('#treeview1').treeview({
        color: "#000000",
        enableLinks: true,
        data: defaultData
      });
});

