var _maxH, _maxW;
var cover_url = "";
var imgs;
var tw, th;
function preview(selection) {
    if (!selection.w || !selection.h)
        return;
    
	var width = tw;
	var height = th;

	var scaleX = _maxW / selection.w;
    var scaleY = _maxH / selection.h;
    /*
    $('#preview img').css({
        width: Math.round(scaleX * width),
        height: Math.round(scaleY * height),
        marginLeft: -Math.round(scaleX * selection.x),
        marginTop: -Math.round(scaleY * selection.y)
    });
    */
    $('#imgX').val(selection.x);
    $('#imgY').val(selection.y);
    $('#imgW').val(selection.w);
    $('#imgH').val(selection.h);
}

function setPreview(x1, y1, width, height) {
    if (!width || !height)
        return;
    
	var twidth = img.clientWidth;
	var theight = img.clientHeight;

	var scaleX = _maxW / width;
    var scaleY = _maxH / height;

    $('#preview img').css({
        width: Math.round(scaleX * twidth),
        height: Math.round(scaleY * theight),
        marginLeft: -Math.round(scaleX * x1),
        marginTop: -Math.round(scaleY * y1)
    });
}

function showPreview(coords)
{
	var rx = 100 / coords.w;
	var ry = 100 / coords.h;

	$('#preview img').css({
		width: Math.round(rx * _maxW) + 'px',
		height: Math.round(ry * _maxH) + 'px',
		marginLeft: '-' + Math.round(rx * coords.x) + 'px',
		marginTop: '-' + Math.round(ry * coords.y) + 'px'
	});
}

$(function(){
	$("#popup-cover").dialog("destroy");
	$("#popup-cover").dialog({
		width: 1024,
		modal: true,
		autoOpen: false,
		resizable: false,
		draggable: false,
		open: function(event, ui){
			if (cover_url != ""){
				$("#pcover").val(0);
				$.get(cover_url, function(data) {
					var obj = $(data);
					
					var h = obj.find("#maxH").val();
					var w = obj.find("#maxW").val();
					
					
					_maxH = h;
					_maxW = w;
					
					var imgx = parseInt(obj.find("#imgX").val());
					var imgy = parseInt(obj.find("#imgY").val());
					var imgw = parseInt(obj.find("#imgW").val());
					var imgh = parseInt(obj.find("#imgH").val());
					
					var form = obj.find('form');
					obj.find("#btnupdate").bind("click", function(){
						$.ajax({
						      type: "POST",
						      url: form.attr( 'action' ),
						      data: form.serialize(),
						      success: function( response ) {
						    	  $("#isdirty-cover").val(1);
						    	  $("#popup-cover").dialog('close');
						      }
						});
					});
					
					$("#coversetting").html(obj);
					
					$("#btnupdate").button();
					
					$('#photo').load(function(){
						imgs = document.getElementById('photo');
						tw = imgs.clientWidth;
						th = imgs.clientHeight;
						
						$('#photo').Jcrop({
							setSelect:[imgx, imgy, imgx + imgw, imgy + imgh],
							allowSelect:false,
							minSize: [ w, h ],
							aspectRatio: w / h,
							onChange: preview,
						});
						
					});
				});
			}
		},
		close: function() {
			$(".imgscrop").remove();
			openCoverDialog();
			$("#pcover").val(1);
		}
	});
});