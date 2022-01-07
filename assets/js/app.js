var base_app="";
var id_tempat=null;
var jenis_komentar=null;

function base_url(data) {
	return base_app+data;
}

function play_video(id_video) {
	$("#konten_popUp_Video").html('	<iframe width="100%" height="600" src="https://www.youtube.com/embed/'+id_video+'?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>');
	$("#video_popUp").modal('show');
}


//comment
function get_coment(start){
	var data_start=start+3;
	$("#loading_komen").show();
	$.getJSON(base_url('web/get_coment/'+start+'/'+jenis_komentar+'/'+id_tempat), {
        format: "json"
    })
    .done(function( data ) {
        $.each(data, function(key, val) {
            $('#kontenKomentar').append('<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">'+val.nama+'</h3></div><div class="panel-body">	'+val.komen+'</div></div>');
          
        });
          $("#tombol_komen").attr("onclick","get_coment("+data_start+")");
          $('#loading_komen').hide();
        })
    .fail(function() {
          
          console.log("error");    

     });  
}

//ajax request

function load_coba() {
	$("#moreVideosTop").load(base_url('web/moreVideosTop/2'));

}


$(document).ready(function() { 

	 $('#v_search').keypress(function (e) {
	     var key = e.which;
	     if(key == 13)  // the enter key code
	      {
	        var keyword=$("#v_search").val();
	        console.log(keyword); 
	        location.replace(base_url('search/keyword/?keyword='+keyword));
	      }
	    });

	//helper close modal video spot stop
	$('#video_popUp').on('hidden.bs.modal', function (e) {
	        console.log("close_video");
	        $("#konten_popUp_Video").html('');
	  });
	$("#moreVideosTop").load(base_url('ajax/moreVideosTop/'+id_tempat));
	
	$("#moreVideosTopp").load(base_url('web/moreVideosTopp/'+id));
	//$("#moreVideosTop").load(base_url('ajax/moreVideosTop/'+id_tempat));
    $("#moreVideosBottom_detail_video_spot").load(base_url('ajax/moreVideosBottom/'+id_tempat));
    $("#moreVideosBottom_detail_video_testimoni").load(base_url('web/moreVideosBottomm/'+id));
$("#moreVideosBottom").load(base_url('ajax/moreVideosBottom/'+id_tempat));
    
    $("#moreVideosBottom_testimoni_video").load(base_url('testimoni/moreVideosBottom_testimoni_video/'+id_tempat));
    $("#video_testimoni_home").load(base_url('testimoni/get_video_home/'));
});






















// ajax("http://elecomp.sh/malangspot/baru3/web/moreVideosTop",function() {
//     if (_ajax.readyState == 4) {
        
//         _("moreVideosTop").innerHTML = "ok";
//         // spot 1
//         ajax("http://elecomp.sh/malangspot/baru3/web/moreVideosTop", "param=http://elecomp.sh/malangspot/baru3/web/moreVideosTop", function() {
   
               
//                 _("moreVideosTop").innerHTML = "ok";
               
//                 // spot 2
               
//         });
//     }
// });
