requirejs([ 'jquery', 'bootstrap' ], function($, aci) {
	$('#btn-delete').click(
			function(e) {
				if (confirm("确定要删除？")) {
					location.href = SITE_URL + folder_name
							+ "/project/delete_project/" + project_id;
				}
				
				return false;
			});

});
