jQuery(document).ready(function($){

    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModal').modal('show');
    });

    // CREATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var todo_id = jQuery('#todo_id').val();
        var ajaxurl = '/comment/store';
		var count = jQuery('#count').val();		
		var test = document.getElementById('test').innerHTML;
		var com_id = jQuery('#com_id').val();			
		var count = jQuery('#count').val();			
		com_id = String(parseInt(com_id) + 1);
		console.log(com_id);	

		var formData = {
			consumer_id : jQuery('#consumer_id').val(),
			hotel_id : jQuery('#hotel_id').val(),
            comment: jQuery('#comment').val(),
			id : com_id
        };

		var pic = jQuery('#pic').val();
		var name = jQuery('#name').val();
		var dt = new Date();
		var d = dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate() + " " + dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

        $.ajax({
            method: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
				var todo= "";
				if(pic)
					todo = '<li class="comment"> <div class="vcard bio col-2"> <img src="../storage/user_pic/' + pic + '" alt="Image placeholder"> </div><div class="comment-body col-10"><h3>' + name + '</h3><div class="meta"> ' + d + '</div><p>' + data.comment + '</p><p><a href="/comment/' + com_id + '" class="reply" onClick="return confirm(\'삭제할까요 ?\');">Delete</a></p></div></li>';
				else
					todo = '<li class="comment"> <div class="vcard bio col-2"> <img src="../storage/user_pic/default.png" alt="Image placeholder"> </div><div class="comment-body col-10"><h3>' + name + '</h3><div class="meta"> ' + d + '</div><p>' + data.comment + '</p><p><a href="/comment/' + com_id + '" class="reply" onClick="return confirm(\'삭제할까요 ?\');">Delete</a></p></div></li>';

                if (state == "add") {
                    jQuery('#todos-list').append(todo);
					document.getElementById('test').innerHTML = parseInt(test) + 1;
					document.getElementById('com_id').value = com_id;
                } else {
                    jQuery("#todo" + todo_id).replaceWith(todo);
					document.getElementById('test').innerHTML = parseInt(test) + 1;
					document.getElementById('com_id').value = com_id;
                }
                jQuery('#myForm').trigger("reset");
                jQuery('#formModal').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});