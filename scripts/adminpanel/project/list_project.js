requirejs([ 'jquery', 'bootstrap', 'bootstrap-tree' ], function($, aci) {
	$('#btn-delete').click(
			function(e) {
				if (confirm("确定要删除？")) {
					location.href = SITE_URL + folder_name
							+ "/project/delete_project/" + project_id;
				}

				return false;
			});
	
	$('#treeview1').treeview({
		color : "#000000",
		enableLinks : true,
		data : defaultData
	});
});
