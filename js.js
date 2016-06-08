
var slide_positions=new Array();
var slide_counts=new Array();
function prev(_id, is_next){
	if (!slide_positions[_id]) slide_positions[_id]=0;
	if (is_next)
		slide_positions[_id]++;
	else
		slide_positions[_id]--;
	if (slide_positions[_id]<0) slide_positions[_id]=0;

	var c= $('#'+_id+' > div > div.slider_content > div').length;


	var max=c-slide_counts[_id];
//	alert(max);
	if (max<0) {		$(s='#'+_id+' .buttons').hide();
		//return;	}

	if (slide_positions[_id]>max) slide_positions[_id]=max;


	  $(s='#'+_id+' > div > div.slider_content >  div').css( "display", "none" );



    for (i=1; i<=slide_counts[_id]; i++){
   		 $(s="#"+_id+" > div > div.slider_content > div.slider"+(i+slide_positions[_id])).css( "display", "block" );
    }


}

function init(_id, _count){
	slide_counts[_id]=_count;



	var c= $('#'+_id+' > div > div.slider_content > div').length;

	prev(_id, 0);


}

function go(url){	window.location.href=url;}