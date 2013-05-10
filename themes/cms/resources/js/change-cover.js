/**
 * Change cover
 */

function openCoverDialog(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	
	var dw = 0.25 * windowWidth;
	var dh = 0.02 * windowHeight;
	
	var popupWidth = windowWidth - (dw * 2);
	var popupHeight = windowHeight - (dh * 2);
	
	$("#popup").dialog({ width: popupWidth, height: popupHeight,  position: "top"});
	$("#popup").dialog('open');
}

$(function(){
	$( "#popup" ).dialog({
		modal: true,
		autoOpen: false,
		resizable: false,
		draggable: false,
		open: function(event, ui){
			$("#pcover").val(1);
			
			loadData();
		},
		close: function() {
			if ($("#isdirty-cover").val() == "1" && $("#pcover").val() == "1"){
				window.location = location.href;
			}
		}
	});
	
	function loadData(){
		$("#cover-data").html('<img id="loading" src="/css/img/loader.gif">');
		
		$.get($("#btn_editcover").attr('rel'), function(data) {
			var obj = $(data);
			
			obj.find(".a-browse-photos").bind("click", function(){
				loadPhotos($(this));
				return false;
			});
			
			$("#cover-data").html(obj);
			
			loadCovers();
		});
	}
	
	function loadAlbums(){
		$("#cover-data").html('<img id="loading" src="/css/img/loader.gif">');
		
		$.get($("#btn_editcover").attr('rel'), function(data) {
			var obj = $(data);
			
			obj.find(".a-browse-photos").bind("click", function(){
				loadPhotos($(this));
				return false;
			});
			
			$("#cover-data").html(obj);
		});
	}
	
	/**
	 * browse photos from album
	 */
	function loadPhotos(ele){
		$("#cover-data").html('<img id="loading" src="/css/img/loader.gif">');
		
		$.get(ele.attr('rel'), function(data) {
			var obj = $(data);
			
			obj.find(".return-albums").bind("click", function(){
				loadAlbums();
				return false;
			});
			
			obj.find(".a-set-cover").bind("click", function(){
				setCover($(this));
				return false;
			});
			
			$("#cover-data").html(obj);
		});
	}
	
	function setCover(ele){
		if(ele.attr('rel')){			
			$.get(ele.attr('rel'), function(data) {
				$("#isdirty-cover").val(1);
				var obj = $(data);
				obj.find(".return-albums").bind("click", function(){
					loadAlbums();
					return false;
				});
				
				$("#cover-data").html(obj);
			}).complete(function() { 
				loadCovers();
			});;
		}
	}
	
	function loadCovers(){
		$("#cover-photos").html('<img id="loading" src="/css/img/loader.gif">');
		var url = $("#url-cover").val();
		if(url){			
			$.get(url, function(data) {
				var obj = $(data);
				obj.find(".cover-edit").bind("click", function(){
					cover_url = $(this).attr("href");
					//$("#cover-data").empty();
					//$("#cover-photos").empty();
					//$("#popup").dialog("close");
					
					var windowHeight = document.documentElement.clientHeight;
					
					$("#popup-cover").dialog({ height: windowHeight - 50, position: "top"});
					$("#popup-cover").dialog('open');
					
					return false;
				});
				
				obj.find(".cover-del").bind("click", function(){
					var tmp = $(this).parent();
					var id = tmp.find(".id").val();
					
					$.post($("#del-cover").val(), { id: id },
						function(data){
							$("#isdirty-cover").val(1);
							$(tmp).remove();
						},
						"json"
					);
				});
				
				obj.find("#covers").sortable({
					delay: 300,
					cursor: 'move',
					stop: function(event, ui) {
						var jsort = $(this);
						jsort.sortable("disable");
						updateSort(jsort);
					}
				});
				
				$("#cover-photos").html(obj);
			});
		}
	}
	
	function updateSort(jsort){
		var photo_id = "";
		var sort = 0;
		var f = 0;
		$(".cover-item").each(function(){
			if (sort > parseInt($(this).attr("order"))){
				f = 1;
			}else{
				sort = parseInt($(this).attr("order"));
			}
		});
		
		if (f == 0){
			jsort.sortable("enable");
			return;
		}
		
		$(".cover-item").each(function(){
			photo_id += $(this).find(".id").val() + ",";
		});
		
		if (photo_id != ""){
			photo_id = photo_id.substring(0, photo_id.length -1);
		}
		
		$.post($("#order-cover").val(), { id: photo_id },
			function(data){
				$("#isdirty-cover").val(1);
				jsort.sortable("enable");
				loadCovers();
			},
			"json"
		);
	}
	
	/**
	 * load popup albums
	 */
	$("#btn_editcover").click(function(){
		$("#isdirty-cover").val(0);
		$("#pcover").val(1);
		
		openCoverDialog();
	});
	
});